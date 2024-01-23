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

        Gate::define('isKeuangan', function($user) {
            return $user->id_role == 1;
        });

        Gate::define('isBPAUP', function($user) {
            return $user->id_role == 2;
        });

        Gate::define('isBPAUK', function($user) {
            return $user->id_role == 3;
        });
        
        Gate::define('isBPASP', function($user) {
            return $user->id_role == 4;
        });

        Gate::define('isBPASS', function($user) {
            return $user->id_role == 5;
        });

        Gate::define('isBPAPP', function($user) {
            return $user->id_role == 6;
        });

        Gate::define('isBPAPE', function($user) {
            return $user->id_role == 7;
        });

        Gate::define('isBPAKS', function($user) {
            return $user->id_role == 8;
        });

        Gate::define('isBPAKP', function($user) {
            return $user->id_role == 9;
        });
    }
}
