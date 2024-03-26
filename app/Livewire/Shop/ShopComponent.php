<?php

namespace App\Livewire\Shop;

use App\Models\Shop;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Storage;

#[Title('Tiendas')]
class ShopComponent extends Component
{

    use WithFileUploads;

    public $shop;
    public $name;
    public $slogan;
    public $telefono;
    public $email;
    public $direccion;
    public $ciudad;
    public $image;
    public $imageModel;

    public function render()
    {
        //$shops = collect();
        
        // Al tener mount() no hace falta pasar parametro a la vista
        return view('livewire.shop.shop-component');
    }

    public function mount()
    {
        $this->shop = Shop::first();
    }

    public function edit()
    {
        $this->clean();

        $this->name = $this->shop->name;
        $this->slogan = $this->shop->slogan;
        $this->telefono = $this->shop->telefono;
        $this->email = $this->shop->email;
        $this->direccion = $this->shop->direccion;
        $this->ciudad = $this->shop->ciudad;

        $this->dispatch('open-modal','modalShop');
    }

    public function update()
    {
        //dump('update');
        //dump($shop);
        $rules = [
            'name' => 'required|min:5|max:255',
            'slogan' => 'max:255|nullable',
            'telefono' => 'max:255|nullable',
            'email' => 'email|nullable',
            'direccion' => 'max:255|nullable',
            'ciudad' => 'max:255|nullable',
            'image' => 'image|max:1024|nullable',
        ];
        $this->validate($rules);

        $this->shop->name = $this->name;
        $this->shop->slogan = $this->slogan;
        $this->shop->telefono = $this->telefono;
        $this->shop->email = $this->email;
        $this->shop->direccion = $this->direccion;
        $this->shop->ciudad = $this->ciudad;
        
        $this->shop->update();

        // Pregunto si hay nueva imagen
        if($this->image){
            // Pregunto si el producto tiene imagen en la relacion polimorfica
            if($this->shop->image!= null){
                // Eliminamos la imagen antigua
                Storage::delete('public/'.$this->shop->image->url);
                // Eliminamos la relacion polimorfica
                $this->shop->image()->delete();
            }
            // Genero un nombre unico y asigno la carpeta donde almacenar
            $customName = 'shops/'.uniqid().'.'.$this->image->extension();
            $this->image->storeAs('public',$customName);
            // Guardamos imagen
            // Relaciones polimorficas uno a uno -> public function image() ....
            $this->shop->image()->create(['url' =>$customName]);
        }
        
        $this->dispatch('close-modal','modalShop');
        $this->dispatch('msg','Datos actualizados');

        $this->clean();

        $this->mount();
    }

    public function clean()
    {
        $this->reset([
            'name',            
            'slogan',
            'telefono',
            'email',
            'direccion',
            'ciudad',
            'image',
            'imageModel'
        ]);

        $this->resetErrorBag(); // Limpia mensaejs validaciones
    }
}
