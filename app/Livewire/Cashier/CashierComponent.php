<?php

namespace App\Livewire\Cashier;

use App\Models\Cashier;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\StatusCashier;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Title;

#[Title('Cajas')]
class CashierComponent extends Component
{
    //Class Props
    public $totalCashiers = 0;

    public $search = '';

    public $pagination = 5;

    //Model  Props
    public $id;

    public $code = '';

    public $name = '';

    public $cash;

    public $debits;

    public $credits;

    public $transfers;

    public $total;

    #[On('list-cashiers')]
    public function render()
    {
        $this->totalCashiers = Cashier::count();

        $cashiers = Cashier::all();

        return view('livewire.cashier.cashier-component', [
            'cashiers' => $cashiers
        ]);
    }

    public function cashUpdated()
    {        
        $this->cash = number_format($this->cash, 2, '.', '');

        $this->totalUpdated();
    }

    public function totalUpdated()
    {
        /* $this->total = (float) $this->cash + (float) $this->debits + (float) $this->credits + (float) $this->transfers; */
        $this->total = (float) $this->cash;

        $this->total = number_format($this->total, 2, '.', '');
    }

    public function showCashier($id)
    {
      $last_status = StatusCashier::where(['user_id' => auth()->user()->id, 'cashier_id' => $id])
        ->orderBy('id', 'desc')
        ->first();
      
      if (!$last_status || $last_status->operation == 'close')
      {
        /* $this->reset('cash', 'debits', 'credits', 'transfers', 'total'); */
        $this->reset('cash', 'total');
      
        $cashier = Cashier::findOrFail($id);
      
        $this->id = $id;
      
        $this->code = $cashier->code;
      
        $this->name = $cashier->name;
      
        $this->resetErrorBag();
      
        $this->dispatch('open-modal', 'modalShowCashier');
      }
      else
      {          
        $cashier = Cashier::findOrFail($id);
        
        $this->id = $id;
        
        $this->code = $cashier->code;
        
        $this->name = $cashier->name;
        
        $this->cash = $cashier->cash;
        
        /* Valores que se cerraran en caja */
        /* $this->debits = $cashier->debits;
        
        $this->credits = $cashier->credits;
        
        $this->transfers = $cashier->transfers; */
        
        $this->total = $cashier->total;
        
        $this->resetErrorBag();
        
        $this->dispatch('open-modal', 'modalCloseCashier');
      
      }

    }

    public function closeCashier($id)
    {
        $rules = [
            'cash'      => 'nullable|numeric',            
            'total'     => 'nullable|numeric',
            /* 'debits'    => 'nullable|numeric',
            'credits'   => 'nullable|numeric',
            'transfers' => 'nullable|numeric', */
        ];
        $messages = [
            'cash.numeric' => 'El valor para efectivo debe ser numerico.',            
            'total.numeric' => 'El valor total debe ser numerico.',
            /* 'debits.numeric' => 'El valor en debitos debe ser numerico.',
            'credits.numeric' => 'El valor en creditos debe ser numerico.',
            'transfers.numeric' => 'El valor en transferencias debe ser numerico.', */
        ];

        $this->validate($rules, $messages);

        $cashier = Cashier::findOrFail($id);

        $status = new StatusCashier();

        $status->date_time = Carbon::now()->setTimeZone('America/Argentina/Buenos_Aires');

        $status->operation = 'close';

        $status->cash = number_format((float) $this->cash, 2, '.', '');

        /* $status->debits = number_format((float) $this->debits, 2, '.', ''); */
        $status->debits = 0;

        /* $status->credits = number_format((float) $this->credits, 2, '.', ''); */
        $status->credits = 0;

        /* $status->transfers = number_format((float) $this->transfers, 2, '.', ''); */
        $status->transfers = 0;

        $status->total = number_format((float) $this->total, 2, '.', '');
        
        $status->cashier()->associate($cashier);

        $status->user()->associate(auth()->user());

        $status->save();

        $cashier->open = false;

        $cashier->cash = 0;

        $cashier->debits = 0;

        $cashier->credits = 0;

        $cashier->transfers = 0;

        $cashier->total = 0;

        $cashier->update();

        $this->dispatch('close-modal', 'modalCloseCashier');

        $this->dispatch('msg', $cashier->name.' fué cerrada.');

        $this->reset('cash','debits', 'credits', 'transfers', 'total');
    }

    public function openCashier($id)
    {
        $rules = [            
            'cash'      => 'nullable|numeric',
            'total'     => 'nullable|numeric',
            /* 'debits'    => 'nullable|numeric',
            'credits'   => 'nullable|numeric',
            'transfers' => 'nullable|numeric', */
        ];
        $messages = [
            'cash.numeric' => 'El valor para efectivo debe ser numerico.',            
            'total.numeric' => 'El valor total debe ser numerico.',
            /* 'debits.numeric' => 'El valor en debitos debe ser numerico.',
            'credits.numeric' => 'El valor en creditos debe ser numerico.',
            'transfers.numeric' => 'El valor en transferencias debe ser numerico.', */
        ];

        $this->validate($rules, $messages);

        $cashier = Cashier::findOrFail($id);

        $status = new StatusCashier();

        $status->date_time = Carbon::now()->setTimeZone('America/Argentina/Buenos_Aires');

        $status->operation = 'open';

        $status->cash = number_format((float) $this->cash, 2, '.', '');

        /* $status->debits = number_format((float) $this->debits, 2, '.', ''); */
        $status->debits = 0;

        /* $status->credits = number_format((float) $this->credits, 2, '.', ''); */
        $status->credits = 0;

        /* $status->transfers = number_format((float) $this->transfers, 2, '.', ''); */
        $status->transfers = 0;

        $status->total = number_format((float) $this->total, 2, '.', '');
        
        $status->cashier()->associate($cashier);

        $status->user()->associate(auth()->user());

        $status->save();

        $cashier->open = true;

        $cashier->cash = $status->cash;

        $cashier->debits = $status->debits;

        $cashier->credits = $status->credits;

        $cashier->transfers = $status->transfers;

        $cashier->total = $status->total;

        $cashier->update();

        $this->dispatch('close-modal', 'modalShowCashier');

        $this->dispatch('msg', $cashier->name.' fué abierta.');

        $this->reset('cash','debits', 'credits', 'transfers', 'total');

        $this->redirect('/sale/create');
    }

    public function create()
    {
        $this->reset('code','name');

        $this->resetErrorBag();

        $this->dispatch('open-modal', 'modalCashier');
    }

    public function store()
    {
        $rules = [
            'code' => 'required|numeric',
            'name' => 'required|min:5|max:255|unique:categories'
        ];
        $messages = [
            'code.required' => 'El campo codigo es requerido',
            'code.numeric' => 'El campo codigo debe ser numerico',
            'name.required' => 'El campo nombre es requerido',
            'name.min' => 'El campo nombre debe contener al menos 5 caracteres.',
            'name.max' => 'El campo nombre no puede contener mas de 255 caracteres.',
            'name.unique' => 'El nombre ingresado ya existe.',
        ];

        $this->validate($rules, $messages);

        $cashier = new Cashier();

        $cashier->code = $this->code;

        $cashier->name = $this->name;

        $cashier->save();

        $this->dispatch('close-modal', 'modalCashier');

        $this->dispatch('msg', 'Caja creada exitosamente.');

        $this->reset('code','name');
    }
    
}
