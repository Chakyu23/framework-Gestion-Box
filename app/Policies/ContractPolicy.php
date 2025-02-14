<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Contract;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContractPolicy
{
    use HandlesAuthorization;

    /**
     * Détermine si l'utilisateur peut voir un contrat.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Contract  $contract
     * @return bool
     */
    public function view(User $user, Contract $contract)
    {
        // L'utilisateur peut voir un contrat s'il est lié au contrat (ex : par le biais du tenant ou du propriétaire)
        return $user->id === $contract->owner_id || $user->id === $contract->tenant_id;
    }

    /**
     * Détermine si l'utilisateur peut créer un contrat.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function create(User $user)
    {
        // L'utilisateur peut créer un contrat s'il est authentifié et a le droit de gérer des contrats
        return $user->is_authenticated; // Exemple de condition à personnaliser
    }

    /**
     * Détermine si l'utilisateur peut mettre à jour un contrat.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Contract  $contract
     * @return bool
     */
    public function update(User $user, Contract $contract)
    {
        // L'utilisateur peut modifier le contrat s'il en est le propriétaire ou le locataire
        return $user->id === $contract->owner_id || $user->id === $contract->tenant_id;
    }

    /**
     * Détermine si l'utilisateur peut supprimer un contrat.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Contract  $contract
     * @return bool
     */
    public function delete(User $user, Contract $contract)
    {
        // L'utilisateur peut supprimer un contrat s'il en est le propriétaire
        return $user->id === $contract->owner_id;
    }
}
