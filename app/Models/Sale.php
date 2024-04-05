<?php

namespace App\Models;

use App\Models\Item;
use App\Models\User;
use App\Models\Client;
use App\Models\Cashier;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sale extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function cashier(){
        return $this->belongsTo(Cashier::class);
    }

    public function items(){
        return $this->belongsToMany(Item::class)->withPivot(['quantity','day']);
    }

    public function payments(){
        return $this->hasMany(Payment::class);
    }
    
}
