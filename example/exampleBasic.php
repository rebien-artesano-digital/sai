<?php

use Sidevtech\Sai\Sai;

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$config = include('../config/Sai.php');
$apikey = $_ENV['OPENAI_API_KEY'];
$bussinesName = $_ENV['BUSSINES_NAME'];
$email = $_ENV['EMAIL'];
$phone = $_ENV['PHONE'];
$web = $_ENV['WEBSITE'];
$chat = new Sai($config,$apikey,$bussinesName,$phone,$web,$email);

$inputText = "Cual es tu telefono de contacto?";
$generatedText = $chat->call(new Illuminate\Http\Request(['message' => $inputText]));
echo $generatedText;
