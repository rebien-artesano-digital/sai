<?php

namespace App\Assistent;

use App\Models\User;
use Sidevtech\Sai\Src\Assistent\Principles as SaiPrinciples;

class Principles extends SaiPrinciples {
    public function __invoke()
    {
        
        return array_merge(
            array_map(function ($principle) {
                return $principle;
            }, $this->default),
            [
                //Aqui va los principios que desees usar, implemente bien tus promt
            ]);
    }
}