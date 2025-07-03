<?php

namespace App\Http\Controllers;
use App\Libraries\CargoConfig;


class Test extends Controller
{
    private $payment_config;

    public function __construct()
    {
        $this->cargo = new CargoConfig();


    }

    public function index()
    {
        print_r($this->cargo->Aras());
    }
}