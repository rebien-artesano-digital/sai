<?php

namespace Sidevtech\Directives;

use Sidevtech\Directives\Implementations\DirectivesAnswers;

class ResponseMethods
{
    public function response(DirectivesAnswers $output,$request)
    {
        return $output->outPut($request);
    }
}