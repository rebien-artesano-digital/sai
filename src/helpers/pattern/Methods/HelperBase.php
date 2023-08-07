<?php

namespace Sidevtech\Sai\Src\Helpers\Pattern\Methods;

use Sidevtech\Sai\Src\Helpers\Pattern\Implementations\SaiPattern;

abstract class HelperBase implements SaiPattern
{
    abstract function outPut($input);
}