<?php

namespace App\Libraries;
use SoapClient;
use App\Src\Parampos\Auth;
use App\Src\Parampos\TotalPaymentTransaction;
use App\Src\Parampos\GeneralClass;
use App\Src\Parampos\BinCode;
use App\Src\Parampos\TotalSpecialRatio;
class PaymentConfig
{

    private $paytr_config;
    private $parampos;

    public function __construct()
    {
        $this->paytr_config = array(
            'merchant_id' => 315083,
            'merchant_key' => "4M6oEWwhE6BuwpZS",
            'merchant_salt' => "ipe2TCU753N9DdA5",
            'debug_on' => 0,
            'test_mode' => 0,
            'no_installment' => 0, // Taksit olsunmu ?
            'max_installment' => 12, // Max Taksit Sayısı
        );

        $developmentMode = true;

        switch ($developmentMode) {
            case true :
                $this->parampos['URL'] = 'https://test-dmz.param.com.tr/turkpos.ws/service_turkpos_test.asmx?wsdl';
                $this->parampos['CLIENT_USERNAME'] = 'Test';
                $this->parampos['CLIENT_CODE'] = 10738;
                $this->parampos['CLIENT_PASSWORD'] = 'Test';
                $this->parampos['GUID'] = '0c13d406-873b-403b-9c09-a5766840d98c';
                break;
            default:
                $this->parampos['GUID'] = 'DDDB71CC-3DB4-40E4-BD7D-XXXXXXXXXX';
                $this->parampos['CLIENT_USERNAME'] = 'TPXXXXXXXX';
                $this->parampos['CLIENT_PASSWORD'] = '2DTPXXXXXXXXXXXXXXXX';
                $this->parampos['CLIENT_CODE'] = 14162;
                $this->parampos['URL'] = 'https://posws.param.com.tr/turkpos.ws/service_turkpos_prod.asmx?WSDL';
        }


    }


    public function parampos($data)
    {

        ini_set("soap.wsdl_cache_enabled", "0");
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);


        if ($_POST) {
            $client = new SoapClient($this->parampos['URL']);

            $cardno = substr(str_replace(" ","",$data['cardNumber']),0,6);


            //Kart Bilgisini alıyoruz
            $bin = new BinCode($cardno,$this->parampos);
            $response = $client->BIN_SanalPos($bin);
            $bin_response = $bin->getCode($response->BIN_SanalPosResult);
            $data['cardType'] = $bin_response['BIN'];

            $transactionsValueList = [
                "cardType" => $data['cardType'],
                "spid" => $data['cardType'],
                "guid" => $this->parampos['GUID'],
                "cardHolderName" => $data['cardName'],
                "cardNo" => $data['cardNumber'],
                "monthOfExpireDate" => $data['expMonth'],
                "yearOfExpireDate" => "20" . $data['expYear'],
                "creditCardCvc" => $data['cvCode'],
                "creditCardOwnerName" => $data['creditCardOwnerName'],
                "errorUrl" => route('payment.callback','status=0'),
                "succesUrl" => route('payment.callback','status=1'),
                "orderID" => $data['orderid'],
                "paymentUrl" => $data['paymentUrl'],
                "orderExplanation" => date("d-m-Y H:i:s"),
                "installment" => $data['odemetaksit'],
                "transactionPayment" => currency($data['transactionPayment'],2,",",""),
                "totalPayment" => currency($data['totalPayment'],2,",",""),
                "transactionID" => $data['transactionID'],
                "ipAdr" => getClientIp(),
            ];



            $data = new TotalPaymentTransaction(
                $transactionsValueList["cardType"],
                "1000",
                $transactionsValueList["guid"],
                $transactionsValueList["cardHolderName"],
                $transactionsValueList["cardNo"],
                $transactionsValueList["monthOfExpireDate"],
                $transactionsValueList["yearOfExpireDate"],
                $transactionsValueList["creditCardCvc"],
                $transactionsValueList["creditCardOwnerName"],
                $transactionsValueList["errorUrl"],
                $transactionsValueList["succesUrl"],
                $transactionsValueList["orderID"],
                $transactionsValueList["orderExplanation"],
                $transactionsValueList["installment"],
                $transactionsValueList["transactionPayment"],
                $transactionsValueList["totalPayment"],
                $transactionsValueList["transactionID"],
                $transactionsValueList["ipAdr"],
                $transactionsValueList["paymentUrl"],
                $this->parampos,
            );





            $authObject = new Auth($transactionSecurityStr = $this->parampos['CLIENT_CODE'].
                $transactionsValueList["guid"].
                $transactionsValueList["installment"].
                $transactionsValueList["transactionPayment"].
                $transactionsValueList["totalPayment"].
                $transactionsValueList["orderID"],
                $this->parampos);

            $data->Islem_Hash = $client->SHA2B64($authObject)->SHA2B64Result;
            $response = $client->TP_WMD_UCD($data);
//            echo '<pre>';
//            print_r($response);
//            echo '<pre>';
            echo $response->TP_WMD_UCDResult->UCD_HTML;

//            isSucceced($response);


        }
    }
    public function paramposCart()
    {


        ini_set("soap.wsdl_cache_enabled", "0");
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);


            $client = new SoapClient($this->parampos['URL']);






           //Kart Bilgisini alıyoruz
          $bin = new BinCode("",$this->parampos);
          $response = $client->BIN_SanalPos($bin);
          $bin_response = $bin->getCode($response->BIN_SanalPosResult);
         echo '<pre>';
          print_r($bin_response);
            echo '</pre>';

    }


    public function iyzico($data){

        if (!$data['tckn']) {
            $data['tckn'] = number('11');
        }

        $request = new \Iyzipay\Request\CreateCheckoutFormInitializeRequest();
        $request->setLocale(\Iyzipay\Model\Locale::TR);
        $request->setPrice($data['total']);
        $request->setPaidPrice($data['paidtotal']);
        $request->setCurrency(\Iyzipay\Model\Currency::TL);
        $request->setBasketId($data['basketid']);
        $request->setPaymentGroup(\Iyzipay\Model\PaymentGroup::PRODUCT);
        $request->setPaymentSource("MicroCloudApp");
        $request->setCallbackUrl(site_url('odeme-sonuc?payment_company=iyzico'));
        $request->setEnabledInstallments(array(2, 3, 6, 9));

        $buyer = new \Iyzipay\Model\Buyer();
        $buyer->setId($data['basketid']);
        $buyer->setName($data['name']);
        $buyer->setSurname($data['surname']);
        $buyer->setGsmNumber($data['phone']);
        $buyer->setEmail($data['email']);
        $buyer->setIdentityNumber($data['tckn']);
        $buyer->setLastLoginDate(date('Y-m-d H:i:s'));
        $buyer->setRegistrationDate(date('Y-m-d H:i:s'));
        $buyer->setRegistrationAddress($data['address']);
        $buyer->setIp(getClientIp());
        $buyer->setCity($data['provinces']);
        $buyer->setCountry("Turkey");

        $request->setBuyer($buyer);
        $shippingAddress = new \Iyzipay\Model\Address();
        $shippingAddress->setContactName($data['name'].' '.$data['surname']);
        $shippingAddress->setCity($data['provinces']);
        $shippingAddress->setCountry("Turkey");
        $shippingAddress->setAddress($data['address']);
        $request->setShippingAddress($shippingAddress);

        $billingAddress = new \Iyzipay\Model\Address();
        $billingAddress->setContactName($data['name'].' '.$data['surname']);
        $billingAddress->setCity($data['provinces']);
        $billingAddress->setCountry("Turkey");
        $billingAddress->setAddress($data['address']);
        $request->setBillingAddress($billingAddress);

        $basketItems = array();
        if (!empty($data['delivery']) and $data['delivery'] != 0) {
            $firstBasketItem = new \Iyzipay\Model\BasketItem();
            $firstBasketItem->setId(number(12));
            $firstBasketItem->setName('Kargo Tahsilat Ücreti');
            $firstBasketItem->setItemType(\Iyzipay\Model\BasketItemType::PHYSICAL);
            $firstBasketItem->setPrice($data['delivery']);
            $firstBasketItem->setCategory1('Hizmet');
            $basketItems[0] = $firstBasketItem;
            $i = 1;
        } else {
            $i = 0;
        }
        foreach ($data['carts'] as  $order) {
            $firstBasketItem = new \Iyzipay\Model\BasketItem();
            $firstBasketItem->setId($order['id']);
            $firstBasketItem->setName($order['name'].' X'.$order['qty']);
            $firstBasketItem->setItemType(\Iyzipay\Model\BasketItemType::PHYSICAL);
            $firstBasketItem->setPrice($this->ci->cart->format_number($order['subtotal']));
            $firstBasketItem->setCategory1("Ürün");
            $basketItems[$i] = $firstBasketItem;
            $i++;
        }
        $request->setBasketItems($basketItems);

        $checkoutFormInitialize = \Iyzipay\Model\CheckoutFormInitialize::create($request, Config::options());
        $checkout_form = $checkoutFormInitialize->getCheckoutFormContent();

        if ($checkoutFormInitialize->getErrorMessage()) {
            return $checkoutFormInitialize->getErrorMessage();
        } else {
            return $checkoutFormInitialize->getCheckoutFormContent();
        }

    }
    public function paytr($data){

        $merchant_id 	=  $this->ci->paytr_config['merchant_id'];
        $merchant_key 	=  $this->ci->paytr_config['merchant_key'];
        $merchant_salt	=  $this->ci->paytr_config['merchant_salt'];

        $email = $data['email'];
        $payment_amount	= $data['paid_total'] * 100; //9.99 için 9.99 * 100 = 999 gönderilmelidir.
        $merchant_oid =$data['basketid'];
        $user_name = $data['name'].''.$data['surname'];
        $user_address = $data['address'];
        $user_phone = $data['telephone'];
        $merchant_ok_url = site_url('odeme-durum?payment_company=paytr&status=success&paymentid='.$data['basketid']);
        $merchant_fail_url = site_url('odeme-durum?payment_company=paytr&status=error');

        $basketItems = array();
        if (!empty($delivery)) {
            $basketItems[0] = array('Kargo Tahsilat Ücreti',$delivery*100,1);
            $i = 1;
        } else {
            $i = 0;
        }
        foreach ($data['carts'] as  $order) {
            $basketItems[$i] = array($order['name'].' X'.$order['qty'],$order['subtotal']*100,$order['qty']);
            $i++;
        }
        $user_basket = base64_encode(json_encode($basketItems));
        ## Kullanıcının IP adresi
        if( isset( $_SERVER["HTTP_CLIENT_IP"] ) ) {
            $ip = $_SERVER["HTTP_CLIENT_IP"];
        } elseif( isset( $_SERVER["HTTP_X_FORWARDED_FOR"] ) ) {
            $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        } else {
            $ip = $_SERVER["REMOTE_ADDR"];
        }
        $user_ip=$ip;
        $timeout_limit = "30";
        $debug_on =  $this->ci->paytr_config['debug_on'];
        $test_mode =  $this->ci->paytr_config['test_mode'];
        $no_installment	=  $this->ci->paytr_config['no_installment']; // Taksit yapılmasını istemiyorsanız, sadece tek çekim sunacaksanız 1 yapın
        $max_installment =  $this->ci->paytr_config['max_installment'];;

        $currency = "TL";
        $hash_str = $merchant_id .$user_ip .$merchant_oid .$email .$payment_amount .$user_basket.$no_installment.$max_installment.$currency.$test_mode;
        $paytr_token=base64_encode(hash_hmac('sha256',$hash_str.$merchant_salt,$merchant_key,true));
        $post_vals=array(
            'merchant_id'=>$merchant_id,
            'user_ip'=>$user_ip,
            'merchant_oid'=>$merchant_oid,
            'email'=>$email,
            'payment_amount'=>$payment_amount,
            'paytr_token'=>$paytr_token,
            'user_basket'=>$user_basket,
            'debug_on'=>$debug_on,
            'no_installment'=>$no_installment,
            'max_installment'=>$max_installment,
            'user_name'=>$user_name,
            'user_address'=>$user_address,
            'user_phone'=>$user_phone,
            'merchant_ok_url'=>$merchant_ok_url,
            'merchant_fail_url'=>$merchant_fail_url,
            'timeout_limit'=>$timeout_limit,
            'currency'=>$currency,
            'test_mode'=>$test_mode
        );

        $ch=curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://www.paytr.com/odeme/api/get-token");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1) ;
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_vals);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);

        $result = @curl_exec($ch);

        if(curl_errno($ch))
            die("PAYTR IFRAME connection error. err:".curl_error($ch));

        curl_close($ch);

        $result=json_decode($result,1);

        if($result['status']=='success')
            $token=$result['token'];
        else
            die("PAYTR IFRAME failed. reason:".$result['reason']);

        return $token;
    }
}