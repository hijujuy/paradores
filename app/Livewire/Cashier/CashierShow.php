<?php

namespace App\Livewire\Cashier;

use App\Models\Cashier;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\StatusCashier;
use Livewire\Attributes\Title;

#[Title('Operaciones')]
class CashierShow extends Component
{
    Use WithPagination;

    public $id;
    public $cashier;
    public $statuses;

    public function mount($cashier)
    {
        $this->id = $cashier;
        $this->cashier = Cashier::find($cashier);
    }

    public function render()
    {
        $statuses = StatusCashier::where('user_id', $this->id)->paginate(5);

        return view('livewire.cashier.cashier-show', compact('statuses'));
    }
}
