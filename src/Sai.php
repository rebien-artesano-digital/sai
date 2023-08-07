<?php

namespace Sidevtech\Sai\src;

include_once __DIR__.'/../../../../app/Assistent/Principles.php';

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Assistent\Principles;
use Sidevtech\Directives\ResponseMethods;

class Sai
{
    private $wordsBlocks = [];
    private $apiKey = '';

    private $bussinesName = '';

    private $phone = '';

    private $web = '';

    private $email = '';

    private $principles = [];

    private $responseMethod;

    private $client;

    public function __construct($config, $apiKey = null,$bussinesName = null,$phone = null,$web = null,$email = null)
    {

        $this->wordsBlocks = $config['wordsBlocks'];
        $this->principles = new Principles();
        $this->apiKey = $apiKey;
        $this->bussinesName = $bussinesName;
        $this->phone = $phone;
        $this->web = $web;
        $this->email = $email;

        $this->client = new Client([
            'base_uri' => 'https://api.openai.com',
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer '.$this->apiKey,
            ],
        ]);;
    }

    public function call(Request $request)
    {
        $inputText = $request->input('message');


        if($this->validationWords($inputText)){
            $generatedText = 'Lo siento como asistente no puedo realizar esa funcion, desea ayuda con algo mas?';
        }else{

            $method = $this->botNatural($request);

            if(!$method){


                $data = [
                    'max_tokens' => 200,
                    'model' => 'gpt-3.5-turbo',
                ];

                $data['messages'] = array_merge(
                    array_map(function ($principle) {
                        return [
                            'role' => 'system',
                            'content' => $principle,
                        ];
                    }, $this->principles->__invoke()),
                    [
                        [
                            'role' => 'system',
                            'content' => 'Eres el asistente virtual de la plataforma '.$this->bussinesName,
                        ],
                        [
                            'role' => 'system',
                            'content' => 'Tu nombre es SIA',
                        ],
                        [
                            'role' => 'system',
                            'content' => 'El telefono de nuestra empresa es '.$this->phone,
                        ],
                        [
                            'role' => 'system',
                            'content' => isset($this->web) ? 'Nuestra pagina web es '.$this->web : 'No tenemos pagina web',
                        ],
                        [
                            'role' => 'system',
                            'content' => isset($this->email) ? 'Email de contacto '.$this->email : 'No tenemos email de contacto',
                        ],
                        [
                            'role' => 'user',
                            'content' => "Soy el usuario y mi rol es: cliente del chat",
                        ],
                        [
                            'role' => 'user',
                            'content' => $inputText,
                        ]
                    ]
                );

                $generatedText = $this->requestChatGpt($data);


            }else{
                $instacie = '\\App\\Directives\\Methods\\'.$method;
                $generatedText = (new ResponseMethods())->response(new $instacie,$request);

            };

        }

        return  $generatedText;
    }

    public function consult($input){

        $data = [
            'messages'=>[
                [
                    'role' => 'user',
                    'content' => $input,
                ]
            ],
            'max_tokens' => 200,
            'model' => 'gpt-3.5-turbo',
        ];
        return $this->requestChatGpt($data);
    }

    public function requestChatGpt($data)
    {
        $response = $this->client->post('/v1/chat/completions', [
            'json' => $data,
        ]);

        $responseBody = json_decode($response->getBody());

        $generatedText = $responseBody->choices[0]->message->content;

        return $generatedText;
    }


    public function botNatural($request)
    {
        $inputText = $request->input('message');

        $highestPercent = 0;
        $bestMethod = null;
        $sensitivity = config('Sai.sensitivity');
        $methods = config('Sai.methods');

        foreach($methods as $method){
            if(is_array($method['mensajes'])){
                foreach($method['mensajes'] as $mensaje){
                    $percent = $this->compareText($inputText, $mensaje);
                    if($percent > $highestPercent){
                        $highestPercent = $percent;
                        $bestMethod = $method['method'];
                    }
                }
            } else {
                $percent = $this->compareText($inputText, $method['mensajes']);
                if($percent > $highestPercent){
                    $highestPercent = $percent;
                    $bestMethod = $method['method'];
                }
            }
        }

        return ($highestPercent > $sensitivity) ? $bestMethod : false;
    }



    private function validationWords($input) {
        foreach ($this->wordsBlocks as $word) {
            if (Str::contains($input, $word)) {
                return true;
            }
        }
        return false;
    }

    public function compareText(string $inputText,string $compareText){
        $similarity = similar_text($inputText, $compareText, $percent);
        return $percent;
    }

}
