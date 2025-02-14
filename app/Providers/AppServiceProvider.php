<?php

namespace App\Providers;

use App\Models\Box;
use App\Models\Tenant;
use App\Policies\BoxPolicy;
use App\Policies\TenantPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{

    protected $policies = [
        Box::class => BoxPolicy::class,
        Tenant::class => TenantPolicy::class,
    ];
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
