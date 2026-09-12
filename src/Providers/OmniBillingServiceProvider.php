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
        $this->loadRoutesFrom(__DIR__ . '/../../routes/webhooks.php');

        // $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        // $this->loadViewsFrom(__DIR__.'/../../resources/views', 'innoboxrromnibilling');
        if ($this->app->runningInConsole()) {
            // $this->publishes([__DIR__.'/../../resources/views' => resource_path('views/vendor/innoboxrromnibilling'),], 'views');
            $this->publishes([__DIR__.'/../../config/omnibilling.php' => config_path('omnibilling.php')], 'config');
        }
    }

    protected function registerPaymentGateways()
    {
        $path = $this->installedJsonPath();

        // Sin el registro de Composer no hay pasarelas que descubrir, pero eso no
        // es motivo para que la aplicacion no arranque.
        if ($path === null) {
            return;
        }

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

    /**
     * El installed.json de Composer.
     *
     * Se buscaba solo en base_path('vendor'), que es donde esta en una aplicacion
     * normal, pero no cuando el vendor vive en otro sitio: un paquete probado con
     * Testbench, o un despliegue con COMPOSER_VENDOR_DIR. El propio autoloader
     * sabe donde esta su directorio, asi que se le pregunta a el.
     */
    protected function installedJsonPath(): ?string
    {
        $candidates = [base_path('vendor/composer/installed.json')];

        if (class_exists(\Composer\Autoload\ClassLoader::class)) {
            $candidates[] = dirname((new \ReflectionClass(\Composer\Autoload\ClassLoader::class))->getFileName()) . '/installed.json';
        }

        foreach ($candidates as $candidate) {
            if (is_file($candidate)) {
                return $candidate;
            }
        }

        return null;
    }

}
