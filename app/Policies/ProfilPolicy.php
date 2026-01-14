<?php

namespace App\Policies;

use App\Models\Profil;
use App\Models\User;

class ProfilPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function manage(User $user, Profil $profil): bool
    {
        return $user->admin === true || $profil->user_id === $user->id;
    }
}