<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Eloquent\UserRepository;

use Illuminate\Support\Facades\Gate;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('super-admin', function ($user) {
            return $user->hasRole('super_admin');
        });

        Gate::define('is-admin', function ($user) {
            return $user->hasRole('admin');
        });

        Gate::define('manage-users', function ($user) {
            return $user->roles()
                ->whereIn('identifier', ['super_admin', 'admin','staff'])
                ->exists();
        });

        Gate::define('edit-users', function ($user) {
            return $user->roles()
                ->whereIn('identifier', ['super_admin', 'admin'])
                ->exists();
        });

        Gate::define('delete-users', function ($user) {
            return $user->roles()
                ->whereIn('identifier', ['super_admin'])
                ->exists();
        });
    }
}
