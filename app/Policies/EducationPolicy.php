<?php

namespace App\Policies;

use App\Models\User;

class EducationPolicy
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
        return $user->admin;
    }
}
