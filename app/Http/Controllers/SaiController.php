<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Assistent\Sai\Src\Sai;

class SaiController extends Controller
{

    protected $chat;
    public function __construct()
    {
        $config = config('Sai');
        $apikey = env('OPENAI_API_KEY');
        $model = env('OPENAI_MODEL');
        $max_token = env('OPENAI_MAX_TOKEN');
        $this->chat = new Sai($config,$apikey,$model,$max_token);
    }
    public function index()
    {
        $title = 'SAI (Sistema de Asistencia Inteligente)';
        $auth = auth()->user();
        return view('saiup', [
            'title' => $title,
            'auth' => $auth,
        ]);
    }

    public function history()
    {
        // Obtener los mensajes del chat desde la base de datos o cualquier otro origen
        $messages = [
        
        ];

        return response()->json($messages);
    }

    public function send(Request $request)
    {

        return $this->botSai($request);
        
    }

    public function botSai(Request $request){
        
        $response = $this->chat->call($request);
        if(is_array($response)){
            return response()->json($response);
        }
        return response()->json(['message' => $response]);
    }


}
