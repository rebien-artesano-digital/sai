<?php

namespace Sidevtech\Sai\Src\Helpers\Pattern;

use Sidevtech\Sai\Src\Helpers\Pattern\Implementations\SaiPattern;

class ResponseHelpers
{
    public function response(SaiPattern $output,$request)
    {
        return $output->outPut($request);
    }
}