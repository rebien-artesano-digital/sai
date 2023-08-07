<?php

namespace Assistent\Sai\Src\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;
use Assistent\Sai\Src\Console\Commands\SaiInstall;

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
            __DIR__.'/../../app/Principles'=> app_path('Principles'),
        ], ['sai-config', 'sai-controllers','sai-methods','sai-helpers', 'sai-images', 'sai-principles']);


        // Ejecuta el comando vendor:publish automáticamente
        $this->commands([
            SaiInstall::class,
        ]);

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
            return new \Assistent\Sai\Sai(config('sai'));
        });

    }
}
