<?php

namespace App\Models;

use App\Models\Sale;
use App\Models\StatusCashier;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cashier extends Model
{
    use HasFactory;

    /**
     * Get all of the statuses for the Cashier
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function statuses()
    {
        return $this->hasMany(StatusCashier::class);
    }

    /**
     * Get all of the sales for the Cashier
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}
