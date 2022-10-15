<?php

namespace App\Providers;

use App\Extensions\Auth\UsersGuard;
use App\Extensions\Auth\UsersProvider;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Auth::extend('UsersGuard', function ($app, $name, array $config) {
            $provider = app(UsersProvider::class);
            $request = app('request');
            return new UsersGuard($provider, $request, $config);
        });
    }
}
