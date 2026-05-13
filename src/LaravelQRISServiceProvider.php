<?php

namespace FatwaKB\LaravelQRIS;

use Illuminate\Support\ServiceProvider;

class LaravelQRISServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/qris.php',
            'qris'
        );

        $this->app->singleton(
            'laravel-qris',
            function () {
                return new QRISManager();
            }
        );
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/qris.php' =>
            config_path('qris.php')
        ], 'qris-config');
    }
}
