<?php

namespace App\Livewire\Cashier;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;

use App\Models\Cashier;
use App\Models\StatusCashier;
use App\Models\User;

#[Title('Operaciones')]
class CashierShow extends Component
{
    Use WithPagination;

    public Cashier $cashier;
    public $date;
    public $time;
    public $operation;
    public $username;
    public $cash, $real_cash, $diff_cash;
    public $debits, $real_debits, $diff_debits;
    public $credits, $real_credits, $diff_credits;
    public $transfers, $real_transfers, $diff_transfers;
    public $total, $real_total, $diff_total;

    public function render()
    {
        $statuses = StatusCashier::where('cashier_id', $this->cashier->id)
            ->orderBy('id', 'desc')
            ->paginate(5);

        return view('livewire.cashier.cashier-show', compact('statuses'));
    }

    public function showById($id)
    {
        $status = StatusCashier::find($id);
        $this->date = $status->date;
        $this->time = $status->time;
        $this->operation = $status->operation;
        $this->username = $status->user->name;
        $this->cash = $status->cash;
        $this->real_cash = $status->real_cash;
        $this->diff_cash = $status->diff_cash;
        $this->debits = $status->debits;
        $this->real_debits = $status->real_debits;
        $this->diff_debits = $status->diff_debits;
        $this->credits = $status->credits;
        $this->real_credits = $status->real_credits;
        $this->diff_credits = $status->diff_credits;
        $this->transfers = $status->transfers;
        $this->real_transfers = $status->real_transfers;
        $this->diff_transfers = $status->diff_transfers;
        $this->total = $status->total;
        $this->real_total = $status->real_total;
        $this->diff_total = $status->diff_total;

        $this->dispatch('open-modal', 'modalStatusCashierShow');
    }
}
