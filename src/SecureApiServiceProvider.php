<?php

namespace Artapamudaid\SecureApiServer;

use Illuminate\Support\ServiceProvider;

class SecureApiServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__.'/config/apikey.php', 'apikey');
        $this->publishes([
            __DIR__.'/config/apikey.php' => config_path('apikey.php'),
        ], 'config');

        $this->loadRoutesFrom(__DIR__.'/Http/routes.php');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

    public function register()
    {
        //
    }
}