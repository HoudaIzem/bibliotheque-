<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Gate::define('admin', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('editor', function (User $user) {
            return in_array($user->role, ['admin', 'editor']);
        });

        Gate::define('user', function (User $user) {
            return $user->role === 'user';
        });
    }
}
