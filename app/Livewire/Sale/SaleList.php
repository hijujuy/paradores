<?php

namespace App\Livewire\Sale;

use App\Models\Cart;
use App\Models\Sale;
use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Title;

#[Title('Ventas')]
class SaleList extends Component
{
    use WithPagination;
   
    //Propiedades clase
    public $search='';
    public $totalRegistros=0;
    public $pagination=5;

    public $totalSales=0;
    public $startDate;
    public $endDate;

    public function render()
    {
        Cart::clear();
        
        if($this->search!=''){
            $this->resetPage();
        }

        $this->totalRegistros = Sale::count();
        
        $salesQuery = Sale::where('id','like','%'.$this->search.'%');

        if($this->startDate && $this->endDate){
            $salesQuery = $salesQuery->whereBetween('day',[$this->startDate,$this->endDate]);

            $this->totalSales = $salesQuery->sum('total');
        }else{
            $this->totalSales = Sale::sum('total');
        }

        $sales = $salesQuery
                ->orderBy('id','desc')
                ->paginate($this->pagination);

        return view('livewire.sale.sale-list',[
            "sales" => $sales
        ]);
    }

    #[On('destroySale')]
    public function destroy($id){
        
        $sale = Sale::findOrFail($id);

        foreach($sale->items as $item){
            Product::find($item->id)->increment('stock',$item->quantity);
            $item->delete();

        }

        $sale->delete();

        $this->dispatch('msg','Venta eliminada');
    }

    #[On('setDates')]
    public function setDates($startDate,$endDate)
    {
        $this->startDate = $startDate;

        $this->endDate = $endDate;
    }
}
