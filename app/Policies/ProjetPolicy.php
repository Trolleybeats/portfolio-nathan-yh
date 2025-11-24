<?php

namespace App\Policies;

use App\Models\User;

class ProjetPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function manage(User $user): bool
    {
        return $user->admin === true;
    }
}
