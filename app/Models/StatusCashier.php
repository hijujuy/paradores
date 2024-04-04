<?php

namespace App\Models;

use App\Models\User;
use App\Models\Cashier;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use DateTime;

class StatusCashier extends Model
{
    const OPENING = 'open';
    const CLOSING = 'close';

    use HasFactory;

    /**
     * Get the cashier that owns the StatusCashier
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cashier()
    {
        return $this->belongsTo(Cashier::class);
    }

    /**
     * Get the user that owns the StatusCashier
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected function date() : Attribute
    {
        return Attribute::make(
            get: function(){                
                $date = new DateTime($this->attributes['date_time']);
                return $date->format('d/m/Y');
            }
        );
    }

    protected function time(): Attribute
    {
        return Attribute::make(
            get: function(){
                $hour = new DateTime($this->attributes['date_time']);
                return $hour->format('H:i');
            }
        );
    }
}
