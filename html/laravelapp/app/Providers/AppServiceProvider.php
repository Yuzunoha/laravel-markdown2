<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\UrlGenerator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(UrlGenerator $url)
    {
        // ssl化(https強制)
        $keyHttpHost = 'HTTP_HOST';
        if (array_key_exists($keyHttpHost, $_SERVER)) {
            if ('localhost' !== $_SERVER[$keyHttpHost]) {
                $url->forceScheme('https');
            }
        }
    }
}
