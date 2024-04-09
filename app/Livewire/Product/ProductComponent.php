<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Storage;

#[Title('Productos')]
class ProductComponent extends Component
{
    use WithFileUploads;
    use WithPagination;

    //Propiedades clase
    public $search='';
    public $totalRegistros=0;
    public $pagination=5;

    //Propiedades modelo
    public $id=0;
    public $name;
    public $category_id;
    public $description;
    public $purchase_price;
    public $sale_price;
    public $barcode;
    public $stock=0;
    public $minimum_stock=10;
    public $expiration_date;
    public $active=1;
    public $image;
    public $imageModel;
    

    public function render()
    {
        
        $this->totalRegistros = Product::count();

        $products = Product::where('name','like','%'.$this->search.'%')
            ->orderBy('id','desc')
            ->paginate($this->pagination);
        
        return view('livewire.product.product-component',[
            'products' => $products
        ]);
    }

    #[Computed()]
    public function categories(){
        return Category::all();
    }

    public function create(){

        $this->id=0;

        $this->clean();

        $this->dispatch('open-modal','modalProduct');
    }

    // Crear producto
    public function store(){
        //  dump('Crear producto');

        $rules = [
            'name' => 'required|min:5|max:255|unique:products',
            'description' => 'max:255',
            'purchase_price' => 'numeric|nullable',
            'sale_price' => 'required|numeric',
            'stock' => 'required|numeric',
            'minimum_stock' => 'numeric|nullable',
            'image' => 'image|max:1024|nullable',
            'category_id' => 'required|numeric|exists:categories,id',
        ];


        $this->validate($rules);

        $product = new Product();
     
        $product->name = $this->name; 
        $product->description = $this->description;
        $product->purchase_price = $this->purchase_price;
        $product->sale_price = $this->sale_price;
        $product->stock = $this->stock;
        $product->minimum_stock = $this->minimum_stock;
        $product->barcode = $this->barcode;
        $product->expiration_date = $this->expiration_date;
        $product->category_id = $this->category_id;
        $product->active = $this->active;
        $product->save();

        if($this->image){
            $customName = 'products/'.uniqid().'.'.$this->image->extension();
            $this->image->storeAs('public',$customName);
            $product->image()->create(['url'=>$customName]);
        }

        $this->dispatch('close-modal','modalProduct');
        $this->dispatch('msg','Producto creado correctamente.');
        $this->clean();
        
    }

    public function edit(Product $product){
      
        $this->clean();

        $this->id = $product->id;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->purchase_price = $product->purchase_price;
        $this->sale_price = $product->sale_price;
        $this->stock = $product->stock;
        $this->minimum_stock = $product->minimum_stock;
        $this->imageModel = $product->imagen;
        $this->barcode = $product->barcode;
        $this->expiration_date = $product->expiration_date;
        $this->active = $product->active;
        $this->category_id = $product->category_id;

        $this->dispatch('open-modal','modalProduct');


        // dump($category);
    }

    public function update(Product $product){
        // dump($category);
        $rules = [
            'name' => 'required|min:5|max:255|unique:products,name,'.$product->id,
            'description' => 'max:255',
            'purchase_price' => 'numeric|nullable',
            'sale_price' => 'required|numeric',
            'stock' => 'required|numeric',
            'minimum_stock' => 'numeric|nullable',
            'image' => 'image|max:1024|nullable',
            'category_id' => 'required|numeric|exists:categories,id',
        ];


        $this->validate($rules);

        $product->name = $this->name;
        $product->description = $this->description;
        $product->purchase_price = $this->purchase_price;
        $product->sale_price = $this->sale_price;
        $product->stock = $this->stock;
        $product->minimum_stock = $this->minimum_stock;
        $product->barcode = $this->barcode;
        $product->expiration_date = $this->expiration_date;
        $product->active = $this->active;
        $product->category_id = $this->category_id;

        $product->update();

        if($this->image){

            if($product->image!=null){
                Storage::delete('public/'.$product->image->url);
                $product->image()->delete();
            }

            $customName = 'products/'.uniqid().'.'.$this->image->extension();
            $this->image->storeAs('public',$customName);
            $product->image()->create(['url'=>$customName]);
        }

        $this->dispatch('close-modal','modalProduct');
        $this->dispatch('msg','Producto editado correctamente.');

        $this->clean();

    }

    #[On('destroyProduct')]
    public function destroy($id){
        // dump($id);
        $product = Product::findOrfail($id);

        if($product->image!=null){
            Storage::delete('public/'.$product->image->url);
            $product->image()->delete();
        }

        $product->delete();

        $this->dispatch('msg','Producto eliminado correctamente.');
    }

    // Metodo encargado de la limpieza
    public function clean(){
        $this->reset(['id','name','image','description','purchase_price','sale_price','stock','minimum_stock','barcode','expiration_date','active','category_id']);
        $this->resetErrorBag();
    }

}
