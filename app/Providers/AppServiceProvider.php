<?php

namespace App\Providers;

use App\Models\BoxModel;
use App\Models\Locataire;
use App\Models\Site;
use App\Policies\BoxModelPolicy;
use App\Policies\LocatairePolicy;
use App\Policies\SitePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    protected $policies = [
        Locataire::class => LocatairePolicy::class,
        Site::class => SitePolicy::class,
        BoxModel::class => BoxModelPolicy::class,
    ];
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
