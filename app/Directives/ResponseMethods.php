<?php

namespace Assistent\Directives;

use Assistent\Directives\Implementations\DirectivesAnswers;

class ResponseMethods
{
    public function response(DirectivesAnswers $output,$request)
    {
        return $output->outPut($request);
    }
}