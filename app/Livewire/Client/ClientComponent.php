<?php

namespace App\Livewire\Client;

use App\Models\Client;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Title;

#[Title('Clientes')]
class ClientComponent extends Component
{   
    Use WithPagination;
    
    //Class Props
    public $totalRegistros = 0;

    public $search = '';

    public $pagination = 5;

    //Model  Props
    public $id;
    public $name;
    public $identity;
    public $tax_code;
    public $email;
    public $phone;
    public $business;

    public function render()
    {
        if ($this->search != '')
        {
            $this->resetPage();
        }
    
        $this->totalRegistros = Client::count();
    
        $clients = Client::where('name', 'like', '%'.$this->search.'%')
            ->orderBy('id', 'asc')
            ->paginate($this->pagination);

        return view('livewire.client.client-component', ['clients' => $clients]);
    }

    public function create()
    {
        $this->id = 0;

        $this->clean();

        $this->dispatch('open-modal', 'modalClient');
    }

    public function clean()
    {
        $this->reset('name', 'identity', 'tax_code', 'email', 'phone', 'business');

        $this->resetErrorBag();
    }

    public function store()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'identity' => 'required|string|numeric|digits:8|unique:clients',
            'tax_code' => 'required|string|numeric|digits:11|unique:clients',
            'email' => 'required|email|nullable',
            'phone' => 'required|string|nullable',
        ];
        
        $this->validate($rules);

        $client = Client::create([
            'name' => strtoupper($this->name),
            'identity' => $this->identity,
            'tax_code' => $this->tax_code,
            'email' => $this->email,
            'phone' => $this->phone,
            'business' => $this->business
        ]);

        $this->dispatch('close-modal', 'modalClient');

        $this->dispatch('msg', 'Cliente creado exitosamente.');
    }

    public function edit(Client $client)
    {
        $this->id = $client->id;
        
        $this->clean();
        
        $this->name  = $client->name;
        $this->identity  = $client->identity;
        $this->tax_code  = $client->tax_code;
        $this->email  = $client->email;
        $this->phone  = $client->phone;
        $this->business  = $client->business;

        $this->dispatch('open-modal', 'modalClient');
    }

    public function update(Client $client)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'identity' => 'required|string|numeric|digits:8|unique:clients,identity,'.$client->id,
            'tax_code' => 'required|string|numeric|digits:11|unique:clients,tax_code,'.$client->id,
            'email' => 'required|email|nullable',
            'phone' => 'required|string|nullable',
        ];
        
        $this->validate($rules);

        $client->update([
            'name'      => strtoupper($this->name),
            'identity'  => $this->identity,
            'tax_code'  => $this->tax_code,
            'email'     => $this->email,
            'phone'     => $this->phone,
            'business'  => $this->business
        ]);

        $this->dispatch('close-modal', 'modalClient');

        $this->dispatch('msg', 'Cliente actualizado exitosamente.');

        $this->clean();
        
    }

    #[On('destroyClient')]
    public function destroy($id)
    {
        $client = Client::find($id);

        $client->delete();

        $this->dispatch('msg', 'Client eliminado exitosamente.');
    }
}
