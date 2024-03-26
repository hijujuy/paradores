<?php

namespace App\Models;

use App\Models\Sale;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'identity', 'tax_code', 'phone', 'email', 'business'];

    public function sales(){
        return $this->hasMany(Sale::class);
    }
}
