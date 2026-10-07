<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\Products;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class ProductsPolicy
{
    public function AddProduct(User $user): bool
    {
        return $user->role=='seller'||$user->role=='admin';
    }
    public function RemovingFromOrder(User $user,Products $product)
    {
        return ($product->user->id==$user->id||$user->role=='admin');
    }
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Products $products): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Products $products): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Products $products): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Products $products): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Products $products): bool
    {
        return false;
    }
}
