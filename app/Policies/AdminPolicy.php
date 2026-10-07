<?php

namespace App\Policies;

use App\Models\User;

class AdminPolicy
{
    /**
     * Create a new policy instance.
     */
    public function IsAdmin(User $user)
    {
        return $user->role=='admin';
    }
}
