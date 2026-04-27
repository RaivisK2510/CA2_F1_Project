<?php

namespace App\Providers;



use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */


    public function boot(): void
    {
        if (app()->environment('production')) {
            \URL::forceScheme('https');

            // This is the specific fix for Vite assets
            Vite::useScriptTagAttributes([
                'crossorigin' => 'anonymous',
            ]);

            // Force the asset URL to be HTTPS
            Vite::useBuildDirectory('build');
            $this->app->bind('vite.manifest', function ($app) {
                return new \Illuminate\Foundation\Vite(
                    $app->make('path.public').'/build/manifest.json',
                    'https://f1laravelprojectapp-bed5f9fwcegnh5g4.spaincentral-01.azurewebsites.net/build'
                );
            });
        }
    }
}
