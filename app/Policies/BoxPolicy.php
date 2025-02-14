<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Box;
use Illuminate\Auth\Access\HandlesAuthorization;

class BoxPolicy
{
    use HandlesAuthorization;

    /**
     * Détermine si l'utilisateur peut afficher la box.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Box  $box
     * @return bool
     */
    public function view(User $user, Box $box)
    {
        // L'utilisateur peut voir le box s'il lui appartient
        return $user->id === $box->owner_id;
    }

    /**
     * Détermine si l'utilisateur peut créer un box.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function create(User $user)
    {
        // L'utilisateur peut créer une box s'il est authentifié
        return $user->is_authenticated;
    }

    /**
     * Détermine si l'utilisateur peut mettre à jour la box.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Box  $box
     * @return bool
     */
    public function update(User $user, Box $box)
    {
        // L'utilisateur peut modifier la box s'il lui appartient
        return $user->id === $box->owner_id;
    }

    /**
     * Détermine si l'utilisateur peut supprimer la box.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Box  $box
     * @return bool
     */
    public function delete(User $user, Box $box)
    {
        // L'utilisateur peut supprimer la box s'il lui appartient
        return $user->id === $box->owner_id;
    }
}
