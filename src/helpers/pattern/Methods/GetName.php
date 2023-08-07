<?php

namespace Sidevtech\Sai\Src\Helpers\Pattern\Methods;

use Sidevtech\Sai\Src\Helpers\Pattern\Methods\HelperBase;

class GetName extends HelperBase
{
    public function outPut($input)
    {

        $patron = "/\b(de|del empleado)\b\s*(.*)/i";
        preg_match($patron, $input, $coincidencias);
        if (count($coincidencias) >= 2) {
            return $coincidencias[2];
        } else {
            return false;
        }

    }
}
