<?php

namespace App\Principles;

use App\Models\User;
use Assistent\Sai\Src\Principles\Principles as SaiPrinciples;

class Principles extends SaiPrinciples {
    public function __invoke()
    {
        
        return array_merge(
            array_map(function ($principle) {
                return $principle;
            }, $this->default),
            [
                //Aqui va los principios que desees usar, implemente bien tus promt
                'Eres el asistente virtual de la empresa gglass'
            ]);
    }
}