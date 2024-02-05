<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Enums\UserRole;

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
        // // create a gate as accessModerator
        // Gate::define('accessModerator', function () {
        //     return auth()->check() && auth()->user()->role_id === 2;
        // });

        Gate::define('accessCourses', function () {
            return auth()->check() && in_array(auth()->user()->role_id, [UserRole::SuperAdministrator, UserRole::Moderator]);
        });
        Gate::define('accessAdmin', function () {
            return auth()->check() && in_array(auth()->user()->role_id, [UserRole::SuperAdministrator]);
        });
        Gate::define('accessStudent', function () {
            return auth()->check() && in_array(auth()->user()->role_id, [UserRole::Student]);
        });

    }
}
