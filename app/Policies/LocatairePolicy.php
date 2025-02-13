<?php

namespace App\Policies;

use App\Models\Locataire;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class LocatairePolicy
{
    public function view(User $user, Locataire $locataire)
    {
        return $user->id === $locataire->user_id;
    }

    public function update(User $user, Locataire $locataire)
    {
        return $user->id === $locataire->user_id;
    }

    public function delete(User $user, Locataire $locataire)
    {
        return $user->id === $locataire->user_id;
    }
}
