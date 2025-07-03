<?php
/**
 * Created by PhpStorm.
 * User: Mehmet Ali ÇETİN
 * Date: 19.04.2017
 * Time: 11:09
 */


namespace App\Libraries\EDM;


class Request
{
    public $hataMesaj;
    public $hataKod;
    public function send($func_name,$param){
        try{
            $this->hataKod = "0";
            $this->hataMesaj = "0";
            $istemci    =   new \SoapClient(Util::$service_url, array('trace' => 1));
            $sonuc =  $istemci->__soapCall($func_name, [$param]);
            return $sonuc;
        }catch (\SoapFault $hata){
            $this->hataKod = $hata->faultcode;
            $this->hataMesaj = $hata->faultstring;
			print_r($hata);
            trigger_error("Soap Hata : ".$hata->faultstring,E_USER_ERROR);
        }
    }
}