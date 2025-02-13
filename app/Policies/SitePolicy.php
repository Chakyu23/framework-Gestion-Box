<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Site;
use Illuminate\Auth\Access\HandlesAuthorization;

class SitePolicy
{
    use HandlesAuthorization;

    /**
     * Détermine si l'utilisateur peut visualiser un site.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Site  $site
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Site $site)
    {
        // L'utilisateur peut voir un site s'il lui appartient
        return $user->id === $site->user_id;
    }

    /**
     * Détermine si l'utilisateur peut mettre à jour un site.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Site  $site
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Site $site)
    {
        // L'utilisateur peut mettre à jour un site s'il lui appartient
        return $user->id === $site->user_id;
    }

    /**
     * Détermine si l'utilisateur peut supprimer un site.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Site  $site
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Site $site)
    {
        // L'utilisateur peut supprimer un site s'il lui appartient
        return $user->id === $site->user_id;
    }
}
