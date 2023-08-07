<?php

namespace Sidevtech\Sai\Src\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;
use Sidevtech\Sai\Src\Console\Commands\SaiInstall;

class AssistentServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Publica los archivos de la librería automáticamente
        $this->publishes([
            __DIR__.'/../../config/Sai.php' => config_path('Sai.php'),
            __DIR__.'/../../app/Http/Controllers/SaiController.php' => app_path('Http/Controllers/SaiController.php'),
            __DIR__.'/../../app/Directives/Methods'=> app_path('Directives/Methods'),
            __DIR__.'/../../app/Directives/Helpers'=> app_path('Directives/Helpers'),
            __DIR__.'/../storage/images'=> storage_path('app/public/images'),
            __DIR__.'/../../app/Assistent'=> app_path('Assistent'),
        ], ['sai-config', 'sai-controllers','sai-methods','sai-helpers', 'sai-images', 'sai-assistent']);


        // Ejecuta el comando vendor:publish automáticamente
        $this->commands([
            SaiInstall::class,
        ]);

        $this->loadRoutesFrom(__DIR__.'/../routes/sai.php');
    }


    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Registra el facade del asistente virtual
        $this->app->bind('sai', function () {
            return new \Sidevtech\Sai\Sai(config('sai'));
        });

    }
}