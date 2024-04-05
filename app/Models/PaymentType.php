<?php

namespace App\Models;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentType extends Model
{
    use HasFactory;

    const CASH = 1;
    const TRANSFER = 2;
    const DEBIT = 4;
    const CREDIT = 5;

    protected $fillable = ['name', 'active'];

    protected $casts = ['active' => 'boolean'];

    public function payments(){
        return $this->hasMany(Payment::class);
    }
}
