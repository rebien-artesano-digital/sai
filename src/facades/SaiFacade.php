<?php

namespace Assistent\Sai\Src\Facades;

use Illuminate\Support\Facades\Facade;

class SaiFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'sai';
    }
}
