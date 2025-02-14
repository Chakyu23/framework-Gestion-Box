<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Bill;
use Illuminate\Auth\Access\HandlesAuthorization;

class BillPolicy
{
    use HandlesAuthorization;

    /**
     * Détermine si l'utilisateur peut voir une facture.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Bill  $bill
     * @return bool
     */
    public function view(User $user, Bill $bill)
    {
        // L'utilisateur peut voir la facture s'il est lié au contrat de cette facture (ex : propriétaire ou locataire)
        return $user->id === $bill->contract->owner_id || $user->id === $bill->contract->tenant_id;
    }

    /**
     * Détermine si l'utilisateur peut créer une facture.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function create(User $user)
    {
        // L'utilisateur peut créer une facture s'il est authentifié et a le droit d'accéder aux contrats
        return $user->is_authenticated; // Exemple de condition à personnaliser
    }

    /**
     * Détermine si l'utilisateur peut mettre à jour une facture.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Bill  $bill
     * @return bool
     */
    public function update(User $user, Bill $bill)
    {
        // L'utilisateur peut mettre à jour une facture s'il en est le propriétaire ou un administrateur
        return $user->id === $bill->contract->owner_id || $user->is_admin;
    }

    /**
     * Détermine si l'utilisateur peut supprimer une facture.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Bill  $bill
     * @return bool
     */
    public function delete(User $user, Bill $bill)
    {
        // L'utilisateur peut supprimer une facture s'il en est le propriétaire ou un administrateur
        return $user->id === $bill->contract->owner_id || $user->is_admin;
    }
}
