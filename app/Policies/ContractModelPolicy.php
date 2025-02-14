<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ContractModel;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContractModelPolicy
{
    use HandlesAuthorization;

    /**
     * Détermine si l'utilisateur peut voir le modèle de contrat.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ContractModel  $contractModel
     * @return bool
     */
    public function view(User $user, ContractModel $contractModel)
    {
        // L'utilisateur peut voir le modèle de contrat s'il est le propriétaire
        return $user->id === $contractModel->owner_id;
    }

    /**
     * Détermine si l'utilisateur peut créer un modèle de contrat.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function create(User $user)
    {
        // L'utilisateur peut créer un modèle de contrat s'il est authentifié
        return $user->is_authenticated;
    }

    /**
     * Détermine si l'utilisateur peut mettre à jour un modèle de contrat.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ContractModel  $contractModel
     * @return bool
     */
    public function update(User $user, ContractModel $contractModel)
    {
        // L'utilisateur peut modifier le modèle de contrat s'il en est le propriétaire
        return $user->id === $contractModel->owner_id;
    }

    /**
     * Détermine si l'utilisateur peut supprimer un modèle de contrat.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ContractModel  $contractModel
     * @return bool
     */
    public function delete(User $user, ContractModel $contractModel)
    {
        // L'utilisateur peut supprimer le modèle de contrat s'il en est le propriétaire
        return $user->id === $contractModel->owner_id;
    }
}
