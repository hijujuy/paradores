<?php

namespace App\Livewire\Sale;

use App\Models\Cart;
use App\Models\Item;
use App\Models\Sale;
use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use App\Models\StatusCashier;
use Livewire\Attributes\Title;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\DB;
use App\Livewire\Cashier\CashierComponent;

#[Title('Ventas')]
class SaleCreate extends Component
{
    use WithPagination;

    //Propiedades clase
    public $search='';
    public $pagination=5;
    public $totalRegistros=0;

    //Propiedades pago
    public $cashier;
    public $payment=0;
    public $change=0;
    public $updating=0;

    public $client=3;

    public function mount()
    {
        $this->setCashier();
    }

    public function render()
    {
        if($this->search!=''){
            $this->resetPage();
        }
        
        $this->totalRegistros = Product::count();

        if($this->updating==0){
            $this->payment = Cart::getTotal();
            $this->change = $this->payment - Cart::getTotal();
        }

        return view('livewire.sale.sale-create',[
            'cashier' => $this->cashier,
            'products' => $this->products,
            'cart' => Cart::getCart(),
            'total' => Cart::getTotal(),
            'totalArticles' => Cart::totalArticulos()
        ]);
    }

    // Crear venta
    public function createSale(){

        $cart = Cart::getCart();

        if(count($cart)==0){
            $this->dispatch('msg','No hay productos',"danger");
            return;
        }

        if($this->payment<Cart::getTotal()){
            $this->payment = Cart::getTotal();
            $this->change=0;
        }

        DB::transaction(function () {
            $sale = new Sale();
            $sale->total = Cart::getTotal();
            $sale->payment = $this->payment;
            $sale->user_id = userID();
            $sale->client_id = $this->client;
            $sale->cashier_id = $this->cashier->id;
            $sale->day = date('Y-m-d');
            $sale->save();

            // global $cart;

            //agregar items a la venta
            foreach(\Cart::session(userID())->getContent() as $product){
                $item = new Item();
                $item->name = $product->name;
                $item->price = $product->price;
                $item->quantity = $product->quantity;
                $item->image = $product->associatedModel->imagen;
                $item->product_id = $product->id;
                $item->day = date('Y-m-d');
                $item->save();

                $sale->items()->attach($item->id,['quantity'=>$product->quantity,'day'=>date('Y-m-d')]);

                Product::find($product->id)->decrement('stock',$product->quantity);

            }

            /* Actualizacion de estado de caja abierta */
            $this->cashier->cash += $sale->total;
            $this->cashier->total += $sale->total;
            $this->cashier->update();

            Cart::clear();
            $this->reset(['payment','change','client']);
            $this->dispatch('showAlert', 'Venta creada correctamente');
            //$this->dispatch('msg','','success',$sale->id);
        });
        
    }

    // Eschuchar evento para establecer id de cliente
    #[On('client_id')]
    public function client_id($id=1){
        $this->client = $id;
    }

    // detectar cuando se edite el input pago
    public function updatingPago($value){
        $this->updating=1;
        $this->payment = $value;
        $this->change = (int)$this->payment - Cart::getTotal();
    }
    
    // Agregar producto al carrito
    #[On('add-product')]
    public function addProduct(Product $product){
        $this->updating=0;
        //dump($product);
        Cart::add($product);
        $this->dispatch('close-modal', 'modalAddArticle');
    }

    // Decrementar cantidad
    public function decrement($id){
        $this->updating=0;
        Cart::decrement($id);
        $this->dispatch("incrementStock.{$id}");
    }

    // Incrementar cantidad
    public function increment($id){
        $this->updating=0;
        Cart::increment($id);
        $this->dispatch("decrementStock.{$id}");
    }

    // Eliminar item del carrito
    public function removeItem($id,$qty){
        $this->updating=0;
        Cart::removeItem($id);
        $this->dispatch("devolverStock.{$id}",$qty);
    }
   
    // Cancelar venta
    public function clear(){
        Cart::clear();
        $this->payment=0;
        $this->change=0;
        $this->dispatch('showAlert','Venta cancelada');
        $this->dispatch('refreshProducts');
        
    }

    // Recibir valor del pago desde currency
    #[On('setPago')]
    public function setPago($valor){
        $this->updating=1;
        $this->payment = $valor;
        $this->change = round($this->payment-Cart::getTotal(), 2);
    }

    // Recibir valor del pago desde currency
    #[On('closeCashier')]
    public function closeCashier(){
        $this->redirect('/cashiers');
    }

    // Propiedad para obtener listado productos
    #[Computed()]
    public function products(){
        return Product::where('name','like','%'.$this->search.'%')
        ->orderBy('id','desc')
        ->paginate($this->pagination);
    }

    /** 
     * Propiedad para obtener caja abierta por usuario
     * Si el cashier es null, se devuelve false
     */
    public function setCashier()
    {
        $status = StatusCashier::where([
            'user_id' => userID()
        ])->orderBy('id','desc')
        ->first();

        if (is_null($status) || ($status->operation == 'close'))
        {
            $this->cashier = false;
        }
        else
        {
            $this->cashier = $status->cashier;
        }

    }

    public function modalAddArticle()
    {
        $this->dispatch('open-modal', 'modalAddArticle');
    }
}
