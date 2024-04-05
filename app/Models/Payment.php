<?php

namespace App\Models;

use App\Models\Sale;
use App\Models\PaymentType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    public function sale() {
        return $this->belongsTo(Sale::class);
    }

    public function paymentType(){
        return $this->belongsTo(PaymentType::class);
    }

    public function __construct(PaymentType $paymentType=null){
        $this->amount = 0;
        $this->reference = '';
        if (!is_null($paymentType)) {
            $this->paymentType()->associate($paymentType);
        }        
    }
}
