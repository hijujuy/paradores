<?php

namespace App\Models;

use App\Models\Image;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    
    // Relacion poliformica image
    public function image(){
        return $this->morphOne(Image::class,'imageable');
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    //Atributos
    protected function stockLabel() : Attribute
    {
        return Attribute::make(
            get: function(){
                return $this->attributes['stock'] >= $this->attributes['minimum_stock'] ? '<span class="badge badge-pill badge-success">'.$this->attributes['stock'].'</span>' : '<span class="badge badge-pill badge-danger">'.$this->attributes['stock'].'</span>'; 
            }
        );
    }
 
    protected function price() : Attribute
    {
        return Attribute::make(
            get: function(){
                return '<b>$'.number_format($this->attributes['sale_price'],2,',','.').'</b>'; 
            }
        );
    }
   
    protected function activeLabel() : Attribute
    {
        return Attribute::make(
            get: function(){
                return $this->attributes['active'] ? '<span class="badge badge-success">Activo</span>' : '<span class="badge badge-warning">Inactivo</span>'; 
            }
        );
    }  

   
    protected function imagen() : Attribute
    {
        return Attribute::make(
            get: function(){
                return $this->image ? Storage::url('public/'.$this->image->url) : asset('no-image.png'); 
            }
        );
    }  
}
