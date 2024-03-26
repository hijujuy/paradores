<?php

namespace App\Livewire\Sale;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Client as Cliente;

class Client extends Component
{
    public $id=0;
    public $client=1;
    public $nameClient;

    //Propiedades modelo
    public $name;
    public $identity;
    public $phone;
    public $email;
    public $business;
    public $tax_code;

    public function render()
    {
        return view('livewire.sale.client',[
            "clients" => Cliente::all()
        ]);
    }

    #[On('client_id')]
    public function client_id($id=1){
        $this->client = $id;
        $this->nameClient($id);
    }

    public function mount(){
        $this->nameClient();
    }

    public function nameClient($id=1){
        $findClient = Cliente::find($id);
        $this->nameClient = $findClient->name;
    }

    // Crear cliente
    public function store(){
        
        $rules = [
            'name' => 'required|min:5|max:255',
            'identity' => 'required|max:15|unique:clients',
            'email' => 'max:255|email|nullable'
        ];


        $this->validate($rules);

        $client = new Cliente();
        $client->name = $this->name; 
        $client->identity = $this->identity;
        $client->phone = $this->phone; 
        $client->email = $this->email; 
        $client->business = $this->business; 
        $client->tax_code = $this->tax_code; 

        $client->save(); 
        
        $this->dispatch('close-modal','modalClient');
        $this->dispatch('msg','Cliente creado correctamente.');

        $this->dispatch('client_id',$client->id);

        $this->clean();
    }

    public function openModal()
    {
        $this->dispatch('open-modal','modalClient');
    }

    public function clean(){
        $this->reset(['name','identity','phone','email','business','tax_code']);
        $this->resetErrorBag();
    }
}
