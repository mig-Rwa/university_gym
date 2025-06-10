<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        if ($this->app->environment('production')) {
            // Force all URLs (assets, routes, etc.) to use HTTPS
            URL::forceScheme('https');
        }
    }
}
