<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Page' => 'App\Policies\PagePolicy',
        'App\Office' => 'App\Policies\OfficePolicy',
        'App\User' => 'App\Policies\UserPolicy',
        'App\Institution' => 'App\Policies\InstitutionPolicy',
        'App\Ministry' => 'App\Policies\MinistryPolicy',
        'App\Category' => 'App\Policies\CategoryPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
