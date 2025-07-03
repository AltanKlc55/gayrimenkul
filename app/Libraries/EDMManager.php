<?php

namespace App\Libraries;

use App\Libraries\EDM\Client;
use App\Libraries\EDM\Util;
use App\Libraries\EDM\RequestHeader;
use App\Libraries\EDM\Request;
use App\Libraries\EDM\Fatura;
use App\Libraries\EDM\Cari;
use App\Libraries\EDM\Vergi;
use App\Libraries\EDM\Satir;
use App\Libraries\EDM\Urun;
//use App\Libraries\EDM\
//use App\Libraries\EDM\
class EDMManager
{
    private $client;
    public function Login()
    {
        $this->client =   new Client("https://test.private.com.tr/EFaturaEDM21ea/EFaturaEDM.svc?singleWsdl");
        $login  =   $this->client->login("private","Abc.123");
        return $login;
    }

    public function setEFatura($faturabilgi,$duzenleyenBilgileri,$aliciBilgileri,$vergiBilgileri,$dipToplamlar,$faturaSatirlari)
    {
        $faturaBilgileri = [
            "profileId" => "EARSIVFATURA",
            "id" => $faturabilgi['fatura_no'],
            "uuid" => Util::GUID(),
            "issueDate" => Util::issueDate(),
            "issueTime" => Util::issueTime(),
            "invoiceTypeCode" => $faturabilgi['fatura_tur'], //SATIS - IADE
            "note" => "Yazı İle : #".$faturabilgi['fatura_yaziyla']."#",
            "documentCurrencyCode" => "TRY",
            "lineCountNumeric" => "2"
        ];

        // Fatura oluşturuluyor
        $fatura = new Fatura();
        foreach ($faturaBilgileri as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($fatura, $method)) {
                $fatura->$method($value);
            }
        }

        // EFatura Gönderici Bilgileri Set Edildi.
        $duzenleyen = new Cari();
        foreach ($duzenleyenBilgileri as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($duzenleyen, $method)) {
                $duzenleyen->$method($value);
            }
        }
        $fatura->setDuzenleyen($duzenleyen);

        // EFatura Alıcı Carisi Oluşturulup Faturaya Eklendi
        $alici = new Cari();
        foreach ($aliciBilgileri as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($alici, $method)) {
                $alici->$method($value);
            }
        }
        $fatura->setAlici($alici);

        // Fatura Altı KDV Eklendi
        $fatura_dip_vergi = new Vergi();
        foreach ($vergiBilgileri as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($fatura_dip_vergi, $method)) {
                $fatura_dip_vergi->$method($value);
            }
        }
        $fatura->setVergi($fatura_dip_vergi);

        // Faturaya Dip Toplamlar Ekleniyor
        foreach ($dipToplamlar as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($fatura, $method)) {
                $fatura->$method($value);
            }
        }

        // Fatura Satırları Oluşturuluyor
        foreach ($faturaSatirlari as $satirBilgileri) {
            $satir = new Satir();
            foreach ($satirBilgileri as $key => $value) {
                if ($key == "vergiBilgileri") {
                    $vergi = new Vergi();
                    foreach ($value as $k => $v) {
                        $method = 'set' . ucfirst($k);
                        if (method_exists($vergi, $method)) {
                            $vergi->$method($v);
                        }
                    }
                    $satir->setVergi($vergi);
                } elseif ($key == "urunBilgileri") {
                    $urun = new Urun();
                    foreach ($value as $k => $v) {
                        $method = 'set' . ucfirst($k);
                        if (method_exists($urun, $method)) {
                            $urun->$method($v);
                        }
                    }
                    $satir->setUrun($urun);
                } else {
                    $method = 'set' . ucfirst($key);
                    if (method_exists($satir, $method)) {
                        $satir->$method($value);
                    }
                }
            }
            $fatura->addSatir($satir);
        }

        // Faturayı göndermek için
        $sonuc = $this->client->sendInvoice($fatura);
        return $sonuc;
    }

}