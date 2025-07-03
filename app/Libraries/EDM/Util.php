<?php
/**
 * Created by PhpStorm.
 * User: Mehmet Ali ÇETİN
 * Date: 19.04.2017
 * Time: 10:10
 */

namespace App\Libraries\EDM;



class Util
{
    public static $service_url = "";
    public static function GUID()
    {
        if (function_exists('com_create_guid') === true)
        {
            return trim(com_create_guid(), '{}');
        }

        return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
    }
    public static function actionDate(){
        return date("Y-m-d")."T".date("H:i:s");
    }
    public static function issueDate(){
        return date("Y-m-d");
    }
    public static function issueTime(){
        return date("H:i:s");
    }
    public static function formatDecimal($sayi,$basamak=3){
        return number_format($sayi,$basamak,".","");
    }
    public static function invoiceStatus($statusCode){
        $statusCode = str_replace(" ","",$statusCode);
        $durum = array(
            "PACKAGE-PROCESSING"                    =>  array("aciklama"=>"Zarflama yapılıyor","yap"=>"BEKLE","renk" => "#00529B"),
            "PACKAGE-FAIL"                          =>  array("aciklama"=>"Zarflamada Hata Alındı","yap"=>"IPTALRESEND", "renk" => "#EEB11D"),
            "SEND-PROCESSING"                       =>  array("aciklama"=>"Gönderim İşlemi Devam Ediyor","yap" => "BEKLE","renk" => "#00529B"),
            "SEND-WAIT_GIB_RESPONSE"                =>  array("aciklama"=>"Gönderim İşlemi Devam Ediyor","yap" => "BEKLE","renk" => "#00529B"),
            "SEND-WAIT_SYSTEM_RESPONSE"             =>  array("aciklama"=>"Gönderim İşlemi Devam Ediyor","yap" => "BEKLE","renk" => "#00529B"),
            "SEND-FAILED"                           =>  array("aciklama"=>"Gönderim işlemi Hatalı Bitti, Gönderilemedi","yap" => "REGONDER", "renk" => "#EEB11D"),
            "SEND-SUCCEED"                          =>  array("aciklama"=>"Temel Fatura Alıcısı Tarafından Onaylandı, Temel Fatura İçin Bu Durum Son Durumdur.","yap" => "KABULISARET","renk" =>"#4C7B28" ),
            "SEND-WAIT_APPLICATION_RESPONSE"        =>  array("aciklama"=>"Alıcısından Yanıt Bekleniyor","yap" => "BEKLE","renk" => "#00529B"),
            "ACCEPTED-SUCCEED"                      =>  array("aciklama"=>"Ticari Fatura Yanıtı Geldi. Onaylandı.","yap" => "KABULISARET", "renk" => "#EEB11D"),
            "REJECTED-SUCCEED"                      =>  array("aciklama"=>"Ticari Fatura Yanıtı Geldi. Red Edildi.","yap" => "REDISARET", "renk" => "#EEB11D"),
            "UNKNOWN-UNKNOWN"                       =>  array("aciklama"=>"Belirsiz Durum - İşlem Devam Ediyor","yap" => "BEKLE","renk" => "#00529B"),
            "RECEIVE-WAIT_SYSTEM_RESPONSE"          =>  array("aciklama"=>"Sistem Tarafından Sistem Yanıtı Gönderimi Bekleniyor","yap" => "BEKLE","renk" => "#00529B"),
            "RECEIVE-SUCCEED"                       =>  array("aciklama"=>"Temel Fatura Başarı İle Alındı","yap" => "ICERIAL", "renk" => "#5DA423"),
            "RECEIVE-WAIT_APPLICATION_RESPONSE"     =>  array("aciklama"=>"Alınan Ticari Faturaya Kabul veya Red Yanıtı Bekleniyor","yap"=>"KABULRED", "renk" => "#EEB11D"),
            "ACCEPT-PROCESSING"                     =>  array("aciklama"=>"Göndericisine KABUL Yanıtı Gönderimi Başladı ve Devam Ediyor","yap"=>"BEKLE","renk" => "#00529B"),
            "ACCEPT-WAIT_GIB_RESPONSE"              =>  array("aciklama"=>"Göndericisine KABUL Yanıtı Gönderimi Başladı ve Devam Ediyor","yap"=>"BEKLE","renk" => "#00529B"),
            "ACCEPT-WAIT_SYSTEM_RESPONSE"           =>  array("aciklama"=>"Göndericisine KABUL Yanıtı Gönderimi Başladı ve Devam Ediyor","yap"=>"BEKLE","renk" => "#00529B"),
            "ACCEPT-SUCCEED"                        =>  array("aciklama"=>"KABUL Yanıtı Başarılı. EFaturayı Programa Kaydedin","yap"=>"ICERIAL", "renk" => "#EEB11D"),
            "ACCEPT-FAILED"                         =>  array("aciklama"=>"KABUL Yanıtı İletilemedi. Yeniden Gönder","yap"=>"REKABUL", "renk" => "#EEB11D"),
            "REJECT-PROCESSING"                     =>  array("aciklama"=>"Göndericisine RED Yanıtı Gönderimi Başladı ve Devam Ediyor. Bekleyin","yap"=>"BEKLE","renk" => "#00529B"),
            "REJECT-WAIT_GIB_RESPONSE"              =>  array("aciklama"=>"Göndericisine RED Yanıtı Gönderimi Başladı ve Devam Ediyor. Bekleyin","yap"=>"BEKLE","renk" => "#00529B"),
            "REJECT-WAIT_SYSTEM_RESPONSE"           =>  array("aciklama"=>"Göndericisine RED Yanıtı Gönderimi Başladı ve Devam Ediyor. Bekleyin","yap"=>"BEKLE","renk" => "#00529B"),
            "REJECT-SUCCEED"                        =>  array("aciklama"=>"RED Yanıtı Başarılı. Faturayı İptal Edin","yap"=>"FATURAIPTAL","renk" => "#EEB11D"),
            "REJECT-FAILED"                         =>  array("aciklama"=>"RED Yanıtı İletilemedi. Yeniden Gönderin","yap"=>"RERED", "renk" => "#EEB11D")
        );
        return $durum[trim($statusCode)];
    }
    public static function localInvoiceStatus($statusCode){
        $durum = array(
            "0" =>  "EFatura Aktif Değil",
            "1" =>  "Gönderim Bekliyor",
            "2" =>  "Gönderildi.Giden Kutusuna Bakın"
        );
        return $durum[$statusCode];
    }
    public static function UBLClear($xmlStr){
        $xmlStr =   preg_replace("/<Invoice ([a-z][a-z0-9]*)[^>]*?(\/?)>/i", " <Invoice>", $xmlStr);
        $xmlStr =   str_replace(array("cbc:","cac:","ext:","ds:","xades:"),array("","","","",""),$xmlStr);
        return $xmlStr;
    }
}