<?php
namespace App\Src\Parampos;

class Auth
{
    function __construct($text,$env)
    {
//        global $env;
        $this->Data = $text;
//        echo $env['CLIENT_CODE'];
//        echo $env['CLIENT_USERNAME'];
//        echo $env['CLIENT_PASSWORD'];
        $this->G = new GeneralClass($env['CLIENT_CODE'], $env['CLIENT_USERNAME'], $env['CLIENT_PASSWORD']);
    }
}