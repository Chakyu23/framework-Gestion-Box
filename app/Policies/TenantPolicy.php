<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Tenant;
use Illuminate\Auth\Access\HandlesAuthorization;

class TenantPolicy
{
    use HandlesAuthorization;

    /**
     * Détermine si l'utilisateur peut voir le locataire.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Tenant  $tenant
     * @return bool
     */
    public function view(User $user, Tenant $tenant)
    {
        // L'utilisateur peut voir le locataire s'il lui appartient
        return $user->id === $tenant->data_owner_id;
    }

    /**
     * Détermine si l'utilisateur peut créer un locataire.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function create(User $user)
    {
        // L'utilisateur peut créer un locataire s'il est authentifié
        return $user->is_authenticated;
    }

    /**
     * Détermine si l'utilisateur peut mettre à jour le locataire.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Tenant  $tenant
     * @return bool
     */
    public function update(User $user, Tenant $tenant)
    {
        // L'utilisateur peut modifier le locataire s'il lui appartient
        return $user->id === $tenant->data_owner_id;
    }

    /**
     * Détermine si l'utilisateur peut supprimer le locataire.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Tenant  $tenant
     * @return bool
     */
    public function delete(User $user, Tenant $tenant)
    {
        // L'utilisateur peut supprimer le locataire s'il lui appartient
        return $user->id === $tenant->data_owner_id;
    }
}
