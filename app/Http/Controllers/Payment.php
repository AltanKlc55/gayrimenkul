<?php

namespace App\Http\Controllers;
use App\Libraries\PaymentConfig;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\Order\Entities\Order;
use Modules\Product\Entities\Productset;
use Modules\Product\Entities\ProductChild;
use Modules\Pos\Entities\CreditCard;
use Modules\Pos\Entities\CreditCardCommission;


class Payment extends Controller
{
    private $payment_config;
    public function __construct()
    {
        $this->payment_config = new PaymentConfig();
    }

    public function index($uri)
    {


        $page['title'] = ___('Dashboard');
        $page['row'] = Productset::where('slug',$uri)->first();
        $page['price'] =ProductChild::where('code','=',$page['row']['code'])->sum('price').' TL';
       


        return view('shop/delivery',compact('page'));

    }
    public function pos(Request $request,$id)
    {

        if (request()->isMethod('POST')) {



            $page['title'] = ___('Dashboard');
            $page['cards'] = CreditCard::get()->toArray();
            $page['row'] = Productset::where('id',$id)->first();
            $price =ProductChild::where('code','=',$page['row']['code'])->sum('price');
            $page['price'] =$price.' TL';

            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|max:255',
                'student' => 'required|string|min:3',
                'address' => 'required|string|min:10',
                'tc_no' => 'required|max:11|min:11',
            ], [
                'name.required' => 'İsim alanı zorunludur.',
                'email.required' => 'E-posta alanı zorunludur.',
                'phone.required' => 'Telefon alanı zorunludur.',
                'email.email' => 'Geçerli bir e-posta adresi giriniz.',
                'tc_no.required' => 'Kimlik alanı zorunludur',
                'student.required' => 'Öğrenci alanı zorunludur.',
                'address.required' => 'Adres alanı zorunludur.',
            ]);

        if($validatedData){

            $orderid = time();
            $postdata = array(
                'orderid' => $orderid,
                'product' => $id,
                'semester' =>  $page['row']['group'],
                'name' => request('name'),
                'email' => request('email'),
                'phone' => request('phone'),
                'idenity' => request('tc_no'),
                'student' => request('student'),
                'address' => request('address'),
                'price' => $price,
                'paid_total' => $price,
            );

            $page['orderid']  =$orderid;

            Order::create($postdata);

            return view('shop/shop',compact('page'));
        } else {
            exit();
            $message = "Girmiş olduğunu bilgiler eksik veya hatalı";
            return redirect(route('payment',$page['row']['slug']))->with('message', $message)->with('message_type', $validatedData);
        }

        }

    }
    public function return(Request $request,$id)
    {


        $page['title'] = ___('Dashboard');
        $page['order'] = Order::where('orderid',$id)->first();


        $page['row'] = Productset::where('id',$page['order']->product)->first();
        $price =$page['order']->paid_total;
        $page['price'] =$price.' TL';

        $expDate = explode("/",request('expDate'));

        $installments =  CreditCardCommission::where('card_id',request('cardType'))->where('installment',request('installments'))->first();

        $paidtotal = $price + (($price * $installments->commission) / 100);

        Order::where('orderid',$id)->update(['installments' => request('installments'),'paid_total' =>  $paidtotal]);


        $posdata  =array(
        'cardType' => "1008",
        'cardName' => request('cardName'),
        'cardNumber' => request('cardNumber'),
        'expMonth' => $expDate[0],
        'expYear' => $expDate[1],
        'cvCode' => request('cvCode'),
        'creditCardOwnerName' =>$page['order']['phone'],
        'orderid' => $id,
        'odemetaksit' => request('installments'),
        'transactionPayment' => $price,
       'totalPayment' => $price + (($price * $installments->commission) / 100),
        'transactionID' => $id,
        'paymentUrl' => route('payment.return',$id),
        );
        return $this->payment_config->parampos($posdata);
    }
    public function callback(Request $request)
    {
        $result = $_REQUEST;



        $page['order'] = Order::where('orderid',$result['orderId'])->first();
        $page['row'] = Productset::where('id',$page['order']->product)->first();
        $page['price'] =ProductChild::where('code','=',$page['row']['code'])->sum('price').' TL';

        $page['callback'] = ($result['status'] == 1) ? 'success' : 'error';
        $page['status'] = ($result['status']== 1) ? 'Ödeme Başarıyla Gerçekleşti' :"Ödeme Başarısız";

        if($result['status'] == 1){
            $update = Order::where('orderid',$result['orderId'])->update(['payment_status' => 1]);
        }

        return view('shop/return',compact('page'));

    }
    public function cart(){
        return $this->payment_config->paramposCart();

    }
    public function installments(Request $request)
    {
        $json = "";


        if (request()->isMethod('POST')) {

            $bank = request('bank');
            $product = Productset::where('id',request('id'))->first();
            $price =ProductChild::where('code','=',$product['code'])->sum('price');

            $Commission =CreditCardCommission::where('card_id',$bank)->get()->toArray();

            foreach ($Commission as $item){
                $total = $price + (($price * $item['commission']) / 100);
                $json .='<option value="'.$item['installment'].'">';
                $json .= ($item['installment'] == 1) ? 'Peşin'.' => '.currency($total).' TL' : $item['installment'].' => '.currency($total).' TL';
                $json .='</option>';;
            }


        }


        echo json_encode($json);
    }
}