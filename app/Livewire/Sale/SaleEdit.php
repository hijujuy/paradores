<?php

namespace App\Livewire\Sale;

use App\Models\Cart;
use App\Models\Item;
use App\Models\Sale;
use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Computed;

#[Title('Ventas')]
class SaleEdit extends Component
{
    use WithPagination;

    //Propiedades clase
    public $search='';
    public $pagination=5;
    public $totalRegistros=0;

    public Sale $sale;

    public $cart;

    public $loadCart = false;
    
    public function render()
    {
        if(!$this->loadCart){
            $this->getItemsToCart();
        }else{
            $this->cart = Cart::getCart();
        }
        

        return view('livewire.sale.sale-edit',[
            
            'totalArticles' => Cart::totalArticulos(),
            'total' => Cart::getTotal(),
            'products' => $this->products,
        ]);
    }

    public function editSale(){
        // dump('Editar');

        $this->sale->total = Cart::getTotal();
        $this->sale->payment = $this->sale->total;

        $this->sale->update();

        $itemsIds = [];

        foreach ($this->sale->items as $item) {
            Product::find($item->product_id)->increment('stock',$item->quantity);
            $item->delete();
        }

        foreach (Cart::getCart() as $product) {
            $item = new Item();
            $item->name = $product->name;
            $item->price = $product->price;
            $item->quantity = $product->quantity;
            $item->image = $product->associatedModel->imagen;
            $item->product_id = $product->id;
            $item->day = date('Y-m-d');
            $item->save();

            Product::find($item->product_id)->decrement('stock',$item->quantity);


            $itemsIds +=[$item->id=>["quantity"=>$product->quantity,"day"=>date('Y-m-d')]];
        }

        $this->sale->items()->sync($itemsIds);
        
        /* $this->dispatch('msg','Venta editada correctamente','success',$this->sale->id); */        
        $this->dispatch('showAlert', 'Venta creada correctamente');

    }

    public function getItemsToCart()
    {
       foreach ($this->sale->items as $item) {

            $product = Product::find($item->product_id);

            $existingItem = \Cart::session(userID())->get($item->product_id);

            if($existingItem){
                $this->cart = Cart::getCart();
                return;
            }else{
                \Cart::session(userID())->add([
                    'id' => $item->product_id,
                    'name' => $item->name,
                    'price' => $item->price,
                    'quantity' => $item->quantity,
                    'attributes' => [],
                    'associatedModel' => $product,

                ]);

            }

       }
       $this->loadCart = true;
       $this->cart = Cart::getCart();
    }

    public function mount()
    {
        // $this->cart = collect();
    }
    
    // Agregar producto al carrito
    #[On('add-product')]
    public function addProduct(Product $product){
        Cart::add($product);
    }

    // Decrementar cantidad
    public function decrement($id){
        Cart::decrement($id);
        $this->dispatch("incrementStock.{$id}");
    }

    // Incrementar cantidad
    public function increment($id){
        Cart::increment($id);
        $this->dispatch("decrementStock.{$id}");
    }

    // Eliminar item del carrito
    public function removeItem($id,$qty){
        Cart::removeItem($id);
        $this->dispatch("devolverStock.{$id}",$qty);
    }

    // Propiedad para obtener listado productos
    #[Computed()]
    public function products(){
        return Product::where('name','like','%'.$this->search.'%')
        ->orderBy('id','desc')
        ->paginate($this->pagination);
    }
    
    public function modalAddArticle()
    {
        $this->dispatch('open-modal', 'modalAddArticle');
    }
}
