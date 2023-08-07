<?php

namespace App\Directives\Methods;

use App\Http\Controllers\SaiController;
use Sidevtech\Directives\Implementations\DirectivesAnswers;
use Sidevtech\Sai\Src\Helpers\SaiHelpers;

class GenerateReport implements DirectivesAnswers
{
    public function outPut($request)
    {
        return (new SaiHelpers('GetExample'))->call($request->input('message'));

    }


}
