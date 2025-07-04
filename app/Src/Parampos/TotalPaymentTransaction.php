<?php
namespace App\Src\Parampos;
class TotalPaymentTransaction
{
    function __construct($virtualPosIdentifier, $currency, $globalUniqueIdentifier, $cardHolderName, $cardNo, $cardExpireMonth, $cardExpireYear, $cvc, $cardHolderMobile, $error, $success, $orderId, $orderExplanation, $installment, $transactionExpense, $totalExpense, $transactionIdentifier, $IP, $refererURL,$parampos)
    {
        $this->SanalPOS_ID = $virtualPosIdentifier;
        $this->Doviz = $currency;
        $this->GUID = $globalUniqueIdentifier;
        $this->KK_Sahibi = $cardHolderName;
        $this->KK_No = $cardNo;
        $this->KK_SK_Ay = $cardExpireMonth;
        $this->KK_SK_Yil = $cardExpireYear;
        $this->KK_CVC = $cvc;
        $this->KK_Sahibi_GSM = $cardHolderMobile;
        $this->Hata_URL = $error;
        $this->Basarili_URL = $success;
        $this->Siparis_ID = $orderId;
        $this->Siparis_Aciklama = $orderExplanation;
        $this->Taksit = $installment;
        $this->Islem_Tutar = $transactionExpense;
        $this->Toplam_Tutar = $totalExpense;
        $this->Islem_Hash = null;
        $this->Islem_Guvenlik_Tip = "3D";
        $this->Islem_ID = $transactionIdentifier;
        $this->IPAdr = $IP;
        $this->Ref_URL = $refererURL;
        $this->G = new GeneralClass($parampos['CLIENT_CODE'], $parampos['CLIENT_USERNAME'], $parampos['CLIENT_PASSWORD']);
    }
}