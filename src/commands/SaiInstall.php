<?php

namespace Assistent\Sai\Src\Console\Commands;

use Illuminate\Console\Command;

class SaiInstall extends Command
{
    protected $signature = 'sai:install';

    protected $description = 'Instalar la librería Sai.';

    public function handle()
    {
        $this->call('vendor:publish', [
            '--tag' => ['sai-config', 'sai-controllers','sai-nav', 'sai-methods','sai-helpers','sai-images','sai-assistent'],
            '--force' => true,
        ]);

        // Borra los archivos de la librería automáticamente
        $filesToDelete = [
            __DIR__.'/../../config/',
            __DIR__.'/../../app/Http/',
            __DIR__.'/../../app/Directives/Methods/',
            __DIR__.'/../../app/Directives/Helpers/',
            __DIR__.'/../storage/images/',
            __DIR__.'/../../app/Assistent/',
        
        ];

        foreach ($filesToDelete as $file) {
            if (file_exists($file)) {
                if (is_dir($file)) {
                    // Eliminar directorio y sus contenidos
                    $this->deleteDirectory($file);
                } else {
                    // Eliminar archivo
                    unlink($file);
                }
            }
        }
    }

    private function deleteDirectory($dir)
    {
        if (!file_exists($dir)) {
            return true;
        }
    
        if (!is_dir($dir)) {
            return unlink($dir);
        }
    
        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }
    
            if (!$this->deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
                return false;
            }
    
        }
    
        return rmdir($dir);

        
    }

    
}
