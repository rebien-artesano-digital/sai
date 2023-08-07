<?php

namespace App\Directives\Methods;

use Assistent\Directives\Implementations\DirectivesAnswers;

class GetFunctions implements DirectivesAnswers
{
    public function outPut($input)
    {
        return [
            "message" =>[
            "1. puedes preguntarme por tus datos, tu nombre, tu identificación, tu email, o tu fecha de creación - estado:Terminada",
            "2. Actualizar contreña de usuario - estado: En desarrollo",
            "3. Actualizar email de usuario - estado: En desarrollo",
            ]
        ];
    }
}