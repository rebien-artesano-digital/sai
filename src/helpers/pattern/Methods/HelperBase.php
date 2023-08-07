<?php

namespace Assistent\Sai\Src\Helpers\Pattern\Methods;

use Assistent\Sai\Src\Helpers\Pattern\Implementations\SaiPattern;

abstract class HelperBase implements SaiPattern
{
    abstract function outPut($input);
}