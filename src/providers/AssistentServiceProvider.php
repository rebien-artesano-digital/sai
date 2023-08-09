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
            __DIR__.'/../../config/sai.php' => config_path('sai.php'),
            __DIR__.'/../../app/Services/SaiServices.php' => app_path('Services/SaiServices.php'),
            __DIR__.'/../../resources/views/assistent/assistent.blade.php'=> resource_path('views/assistent/assistent.blade.php'),
            __DIR__.'/../../app/Directives/Methods'=> app_path('Directives/Methods'),
            __DIR__.'/../../app/Directives/Helpers'=> app_path('Directives/Helpers'),
            __DIR__.'/../storage/images'=> storage_path('app/public/images'),
            __DIR__.'/../../app/Principles'=> app_path('Principles'),
        ], ['sai-config', 'sai-services','sai-views','sai-methods','sai-helpers', 'sai-images', 'sai-principles']);


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
            return new \Assistent\Sai\Sai(config('sai'));
        });

    }
}
