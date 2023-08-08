<?php

namespace App\Services;

use Illuminate\Http\Request;
use Assistent\Sai\Src\Sai;
use Illuminate\Http\JsonResponse;

class SaiServices
{

    protected $chat;

    protected $request;

    public function __construct(Request $request)
    {
        $config = config('sai');
        $apikey = env('OPENAI_API_KEY');
        $model = env('OPENAI_MODEL');
        $max_token = env('OPENAI_MAX_TOKEN');
        $this->chat = new Sai($config,$apikey,$model,$max_token);
        $this->request = $request;

    }

    public function __invoke(): JsonResponse
    {

        $response = $this->chat->call($this->request);
        if(is_array($response)){
            return response()->json($response);
        }
        return response()->json(['message' => $response]);

    }

}
