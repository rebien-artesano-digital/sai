<?php

namespace Sidevtech\Sai\Src\Helpers;

include(__DIR__.'/pattern/ResponseHelpers.php');
include(__DIR__.'/pattern/Methods/HelperBase.php');

use Sidevtech\Sai\Src\Helpers\Pattern\ResponseHelpers;

class SaiHelpers
{
    protected $type;

    public function __construct(String $type)
    {
        $this->type = $type;

    }

    public function call(String $input)
    {
        $instancie = '\\Sidevtech\\Sai\\Src\\Helpers\\Pattern\\Methods\\'.$this->type;


        if (!class_exists($instancie)) {
            $instancie = '\\App\\Directives\\Helpers\\'.$this->type;
        }


        return (new ResponseHelpers())->response(new $instancie,$input);
    }
}
