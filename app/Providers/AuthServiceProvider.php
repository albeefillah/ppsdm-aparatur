<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('isKapus', function($user) {
            return $user->id_role == 1;
        });

        Gate::define('isSuperadmin', function($user) {
            return $user->id_role == 2;
        });

        Gate::define('isBPAU', function($user) {
            return $user->id_role == 3;
        });
        
        Gate::define('isBPAS', function($user) {
            return $user->id_role == 4;
        });

        Gate::define('isBPAP', function($user) {
            return $user->id_role == 5;
        });

        Gate::define('isBPAK', function($user) {
            return $user->id_role == 6;
        });
    }
}
