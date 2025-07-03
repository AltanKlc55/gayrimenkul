<?php
/**
 * Created by PhpStorm.
 * User: mehmetalicetin
 * Date: 3.11.2019
 * Time: 23:01
 */


namespace App\Libraries\EDM;


class Siparis
{
    private $siparisNo;
    private $siparisTarih;

    public function setSiparisNo($siparisNo){
        $this->siparisNo = $siparisNo;
    }
    public function getSiparisNo(){
        return $this->siparisNo;
    }
    public function setSiparisTarih($siparisTarih){
        $this->siparisTarih = $siparisTarih;
    }
    public function getSiparisTarih(){
        return $this->siparisTarih;
    }
    public function readXML(){
        $xmlStr = "<cac:OrderReference>";
        $xmlStr.= "<cbc:ID>".$this->siparisNo."</cbc:ID>";
        $xmlStr.= "<cbc:IssueDate>".$this->siparisTarih."</cbc:IssueDate>";
        $xmlStr.='</cac:OrderReference>';
        return $xmlStr;
    }
}