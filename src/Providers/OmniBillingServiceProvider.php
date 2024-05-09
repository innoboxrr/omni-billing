<?php

namespace Innoboxrr\OmniBilling\Providers;

use Illuminate\Support\ServiceProvider;

class OmniBillingServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->registerPaymentGateways();
        $this->mergeConfigFrom(__DIR__ . '/../../config/omnibilling.php', 'omnibilling');
    }

    public function boot()
    {
        // $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        // $this->loadViewsFrom(__DIR__.'/../../resources/views', 'innoboxrromnibilling');
        if ($this->app->runningInConsole()) {
            // $this->publishes([__DIR__.'/../../resources/views' => resource_path('views/vendor/innoboxrromnibilling'),], 'views');
            $this->publishes([__DIR__.'/../../config/omnibilling.php' => config_path('omnibilling.php')], 'config');
        }
    }

    protected function registerPaymentGateways()
    {
        $path = base_path('vendor/composer/installed.json');
        $installed = json_decode(file_get_contents($path), true);
        $packages = $installed['packages'] ?? $installed;

        foreach ($packages as $package) {
            if (isset($package['extra']['omni-billing'])) {
                foreach ($package['extra']['omni-billing'] as $processor => $adapterClass) {
                    $this->app->bind("omni-billing.$processor", function ($app, $params) use ($adapterClass) {
                        return new $adapterClass(...$params);
                    });
                }
            }
        }
    }
    
}