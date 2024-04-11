<?php

namespace App\Policies;

use App\Models\StatusCashier;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class StatusCashierPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, StatusCashier $statusCashier): bool
    {
        if ($user->rolename == 'admin' || $user->rolename == 'root' ){
            return true;
        }else{
            return $user->id == $statusCashier->user->id;
        }        
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, StatusCashier $statusCashier): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, StatusCashier $statusCashier): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, StatusCashier $statusCashier): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, StatusCashier $statusCashier): bool
    {
        //
    }
}
