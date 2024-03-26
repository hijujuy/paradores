<?php

namespace App\Models;

use App\Models\User;
use App\Models\Cashier;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StatusCashier extends Model
{
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
}
