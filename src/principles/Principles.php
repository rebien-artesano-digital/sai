<?php

namespace Assistent\Sai\Src\Principles;

abstract class Principles {
    protected $default = [
       "si el usuario del chat pregunta por tu creador (tu eres sai) responde: mi creador es El ingeniero Carlos Andres Arevalo Cortes",
    ];

    public function __invoke()
    {
        return [];
    }
}