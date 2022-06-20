<?php

namespace App\Providers;

use App\Interfaces\PermissionInterface;
use App\Interfaces\RoleInterface;
use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PermissionInterface::class, PermissionRepository::class);
        $this->app->bind(RoleInterface::class, RoleRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
