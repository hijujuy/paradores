<?php

namespace App\Livewire\Cashier;

use App\Models\Cashier;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\StatusCashier;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Title;

use DateTime;

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
    public $operation;
    public $date_time;
    public $username;
    public $cash, $real_cash, $diff_cash;
    public $debits, $real_debits, $diff_debits;
    public $credits, $real_credits, $diff_credits;
    public $transfers, $real_transfers, $diff_transfers;
    public $total, $real_total, $diff_total;
    public StatusCashier $status;
    public Cashier $cashier;
    
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

    public function realTotalUpdated()
    {
        $this->real_total = $this->formatDecimal($this->real_cash + $this->real_debits + $this->real_credits + $this->real_transfers);
    }

    public function diffTotalUpdated()
    {
        $this->diff_total = $this->formatDecimal($this->diff_cash + $this->diff_debits + $this->diff_credits + $this->diff_transfers);
    }

    public function totalUpdated()
    {
        $this->total = $this->formatDecimal($this->cash + $this->debits + $this->credits + $this->transfers);

        /* $this->total = number_format($this->total, 2, '.', '');
        $this->total = number_format($this->total, 2, '.', '');
        $this->total = number_format($this->total, 2, '.', ''); */
    }

    public function diffCashChange()
    {
        $this->diff_cash = $this->formatDecimal($this->real_cash - $this->cash);
        $this->real_cash = $this->formatDecimal($this->real_cash);
    }

    public function diffDebitsChange()
    {
        $this->diff_debits = $this->formatDecimal($this->real_debits - $this->debits);
        $this->real_debits = $this->formatDecimal($this->real_debits);
    }

    public function diffCreditsChange()
    {
        $this->diff_credits = $this->formatDecimal($this->real_credits - $this->credits);
        $this->real_credits = $this->formatDecimal($this->real_credits);
    }

    public function diffTransfersChange()
    {
        $this->diff_transfers = $this->formatDecimal($this->real_transfers - $this->transfers);
        $this->real_transfers = $this->formatDecimal($this->real_transfers);
    }

    public function diffTotalChange()
    {
        $this->diff_total = $this->formatDecimal($this->real_total - $this->total);
        $this->real_total = $this->formatDecimal($this->real_total);
    }

    public function formatDecimal($value)
    {
        return number_format($value, 2, '.', '');
    }

    public function realUpdated($column)
    {
        switch ($column) {
            case 'cash':
                $this->diffCashChange();
                break;
            case 'debits':
                $this->diffDebitsChange();
                break;
            case 'credits':
                $this->diffCreditsChange();
                break;
            case 'transfers':
                $this->diffTransfersChange();
                break;
            case 'total':
                $this->diffTotalChange();
                break;
        }
        $this->diffTotalUpdated();
        $this->realTotalUpdated();
    }

    public function showCashier($id)
    {
      $last_status = StatusCashier::where(['cashier_id' => $id])
        ->latest('id')
        ->first();
    
      $this->id = $id;

      if (!$last_status || $last_status->operation == 'close')
      {
        $this->reset('cash', 'total');
        $this->resetErrorBag();      
        $this->dispatch('open-modal', 'modalStatusCreate');
      }
      else
      {          
        $cashier = Cashier::find($id);
        $this->id = $id;
        $this->code = $cashier->code;
        $this->name = $cashier->name;
        $this->operation = StatusCashier::CLOSING;
        $this->date_time = Carbon::now()->setTimeZone('America/Argentina/Buenos_Aires')->format('d/m/Y - H:i');        
        $this->username = auth()->user()->name;
        /* Valores que se cerraran en caja */
        $this->cash = $cashier->cash;
        $this->real_cash = $cashier->cash;
        $this->diff_cash = $this->formatDecimal(0);

        $this->debits = $cashier->debits;
        $this->real_debits = $cashier->debits;
        $this->diff_debits = $this->formatDecimal(0);
        
        $this->credits = $cashier->credits;
        $this->real_credits = $cashier->credits;
        $this->diff_credits = $this->formatDecimal(0);
        
        $this->transfers = $cashier->transfers;
        $this->real_transfers = $cashier->transfers;
        $this->diff_transfers = $this->formatDecimal(0);
        
        $this->total = $cashier->total;
        $this->real_total = $cashier->total;
        $this->diff_total = $this->formatDecimal(0);
        
        $this->resetErrorBag();        
        $this->dispatch('open-modal', 'modalStatusClose');      
      }
    }

    public function closeCashier($id)
    {
        $rules = [
            'cash'           => 'required|numeric',
            'total'          => 'required|numeric',
            'debits'         => 'required|numeric',
            'credits'        => 'required|numeric',
            'transfers'      => 'required|numeric',
            'total'          => 'required|numeric',
            'real_cash'      => 'required|numeric',
            'real_total'     => 'required|numeric',
            'real_debits'    => 'required|numeric',
            'real_credits'   => 'required|numeric',
            'real_transfers' => 'required|numeric',
            'real_total'     => 'required|numeric',
            'diff_cash'      => 'required|numeric',
            'diff_total'     => 'required|numeric',
            'diff_debits'    => 'required|numeric',
            'diff_credits'   => 'required|numeric',
            'diff_transfers' => 'required|numeric',
            'diff_total'     => 'required|numeric',
        ];

        $this->validate($rules);

        $cashier = Cashier::find($id);

        $status = new StatusCashier();

        $status->date_time = Carbon::now()->setTimeZone('America/Argentina/Buenos_Aires');

        $status->operation = StatusCashier::CLOSING;

        $status->cash = number_format((float) $this->cash, 2, '.', '');
        $status->real_cash = $this->real_cash;
        $status->diff_cash = $this->diff_cash;

        $status->debits = number_format((float) $this->debits, 2, '.', '');        
        $status->real_debits = $this->real_debits;
        $status->diff_debits = $this->diff_debits;

        $status->credits = number_format((float) $this->credits, 2, '.', '');
        $status->real_credits = $this->real_credits;
        $status->diff_credits = $this->diff_credits;

        $status->transfers = number_format((float) $this->transfers, 2, '.', '');
        $status->real_transfers = $this->real_transfers;
        $status->diff_transfers = $this->diff_transfers;

        $status->total = number_format((float) $this->total, 2, '.', '');
        $status->real_total = $this->real_total;
        $status->diff_total = $this->diff_total;
        
        $status->cashier()->associate($cashier);
        $status->user()->associate(auth()->user());
        $status->save();

        /* Aqui va el codigo de traspaso de los fondos de caja, 
           hacia otro concepto de acumulacion.
        */

        $cashier->open = false;
        $cashier->cash = 0;
        $cashier->debits = 0;
        $cashier->credits = 0;
        $cashier->transfers = 0;
        $cashier->total = 0;
        $cashier->update();

        $this->dispatch('close-modal', 'modalStatusClose');
        $this->dispatch('msg', $cashier->name.' fué cerrada.');
        $this->reset(
            'cash','debits', 'credits', 'transfers', 'total',
            'real_cash','real_debits', 'real_credits', 'real_transfers', 'real_total',
            'diff_cash','diff_debits', 'diff_credits', 'diff_transfers', 'diff_total',
        );
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

        $cashier = Cashier::find($id);
        $status = new StatusCashier();
        $status->date_time = Carbon::now()->setTimeZone('America/Argentina/Buenos_Aires');
        $status->operation = StatusCashier::OPENING;
        $status->cash = number_format((float) $this->cash, 2, '.', '');
        $status->debits = 0;
        $status->credits = 0;
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

        $this->dispatch('close-modal', 'modalStatusCreate');

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
