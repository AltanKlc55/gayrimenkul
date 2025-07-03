<?php

namespace Modules\Order\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Order\Entities\Order;
use Illuminate\Support\Str;
use Modules\Product\Entities\Productset;
use Modules\Semester\Entities\Semester;
use App\Libraries\EDMManager;
//use Modules\Product\Entities\Products;
//use App\Libraries\Cargo;
use App\Libraries\CargoConfig;
class OrderController extends Controller
{
    private $model;

    private $table = "order";

    private $page = "order";
    private $route= "order";
    private $title;
    private $multilang = false;

    private $cargo;

    public function __construct()
    {

        $this->model = Order::class;
        $this->title = ___('Orders');
        $this->button = array(
//            array(
//                'title' => 'Yeni Ekle',
//                'id' => '',
//                'class' =>'',
//                'type' => 'link', // button,link
//                'icon' => '', // button,link
//                'href' => route('semester.create'), // link ise gideceği sayfa
//                'onclick' =>'',
//                'color' =>'primary'
//            ),

        );
        $this->control = array(
//            array(
//                'type' => "control",
//                'title' => 'Sitede Gizle',
//                'before' => 0,
//                'status' => 1,
//                'table' => $this->table,
//                'column' => 'status',
//                'icon' => 'fe fe-check-circle',
//                'class' => 'btn-dark'
//            ),
            array(
                'type' => "button",
                'title' => 'Teslimat',
                'event' => 'onclick="CreateCargo(this)"',
                'table' => $this->table,
                'column' => 'status',
                'icon' => 'fe fe-truck',
                'class' => 'btn-warning'
            ),
            array(
                'type' => "button",
                'title' => 'Fatura Oluştur',
                'event' => 'onclick="Createinvoice(this)"',
                'table' => $this->table,
                'column' => 'status',
                'icon' => 'fe fe-file-text',
                'class' => 'btn-success'
            ),
             array(
                 'type' => "button",
                 'title' => 'Sipariş Düzenle',
                 'event' => 'onclick="OrderEdit(this)"',
                 'table' => $this->table,
                 'column' => 'status',
                 'icon' => 'fe fe-edit',
                 'class' => 'btn-primary'
             )
        ,
            array(
                'type' => "button",
                'title' => 'Fatura Gönder',
                'event' => 'onclick="SendInvoice(this)"',
                'table' => $this->table,
                'column' => 'status',
                'icon' => 'bi bi-receipt',
                'class' => 'btn-success'
            )
        );
        $this->datatable = array(
            'table' => $this->table,
            'select' => array(
                'order.*',
                'semester.name as donem',
                'products_set.title as product'
            ),
            'join' => array(
                array('semester', 'order.semester', '=', 'semester.id','Left'),
                array('products_set', 'order.product', '=', 'products_set.id','Left')
            ),
            'rows' => array(
                array('title' => 'ID','row' => 'id','type' => 'text'),
                array('title' => 'Ürün Seti','row' => 'product','type' => 'text'),
                array('title' => 'Dönem','row' => 'donem','type' => 'text'),
                array('title' => 'Sipariş Tarihi','row' => 'created_at','type' => 'date'),
                array('title' => 'Fatura Tarihi','row' => 'invoice_at','type' => 'date'),
                array('title' => 'Fatura No','row' => 'invoice_no','type' => 'text'),
                array('title' => 'Tutar','row' => 'price','type' => 'money'),
                array('title' => 'Ödenen Tutar','row' => 'paid_total','type' => 'money'),
                array('title' => 'İsim','row' => 'name','type' => 'text'),
                array('title' => 'TC','row' => 'idenity','type' => 'text'),
                array('title' => 'Teleofon','row' => 'phone','type' => 'text'),
                array('title' => 'E-Posta','row' => 'email','type' => 'text'),
                array('title' => 'Adres','row' => 'address','type' => 'text'),
                array('title' => 'Not','row' => 'student','type' => 'text'),
                array('title' => 'Taksit Sayısı','row' => 'installments','type' => 'text'),
                array('title' => 'Onay Kodu','row' => 'orderid','type' => 'text'),
                array('title' => 'Teslimat Tarihi','row' => 'delivery_at','type' => 'date'),
                array('title' => 'Teslimat Notu','row' => 'delivery_note','type' => 'text'),
                array('title' => 'Teslim Eden','row' => 'delivery_person','type' => 'text'),
                array('title' => 'Teslimat Kodu','row' => 'delivery_code','type' => 'text'),
                array('title' => '','type' => 'control'),
                array('title' => 'İşlemler','type' => 'button'),
            )
        );
        $this->form  = array(
            array(
                'title' => 'Ürün ',
                'name' => 'product',
                'type' => 'select',
                'child' => 'title',
                'option' => Productset::get()->toArray(),
                'class' => 'select2',
                'grid' => 'col-md-6',
                'id' => '',
                'json' => false,
                'multiple' => false,
                'required' => true,
                'validate' => "required",
                'readonly' => false,
                'disabled' => false,
                'format' => 'select'
            ),
            array(
                'title' => 'Dönem ',
                'name' => 'semester',
                'type' => 'select',
                'child' => 'name',
                'option' => Semester::get()->toArray(),
                'class' => 'select2',
                'grid' => 'col-md-6',
                'id' => '',
                'json' => false,
                'multiple' => false,
                'required' => true,
                'validate' => "required",
                'readonly' => false,
                'disabled' => false,
                'format' => 'select'
            ),
            array(
                'title' => 'Sipariş Tarihi',
                'name' => 'created_at',
                'type' => 'datetime-local',
                'class' => '',
                'grid' => 'col-md-6',
                'validate' => 'required',
                'id' => '',
                'multilang' => false,
                'attribute' => '',
                'required' => true,
                'readonly' => false,
                'disabled' => false,
                'format' => 'text'
            ),
            array(
                'title' => 'Fatura Tarihi',
                'name' => 'invoice_at',
                'type' => 'datetime-local',
                'class' => '',
                'grid' => 'col-md-6',
                'validate' => '',
                'id' => '',
                'multilang' => false,
                'attribute' => '',
                'required' => false,
                'readonly' => false,
                'disabled' => false,
                'format' => 'text'
            ),
            array(
                'title' => 'Ad Soyad',
                'name' => 'name',
                'type' => 'text',
                'class' => '',
                'grid' => 'col-md-6',
                'validate' => 'required',
                'id' => '',
                'multilang' => false,
                'attribute' => '',
                'required' => true,
                'readonly' => false,
                'disabled' => false,
                'format' => 'text'
            ),
            array(
                'title' => 'T.C.',
                'name' => 'idenity',
                'type' => 'text',
                'class' => '',
                'grid' => 'col-md-6',
                'validate' => 'required|max:11',
                'id' => '',
                'multilang' => false,
                'attribute' => '',
                'required' => true,
                'readonly' => false,
                'disabled' => false,
                'format' => 'text'
            ),
            array(
                'title' => 'Telefon.',
                'name' => 'phone',
                'type' => 'text',
                'class' => '',
                'grid' => 'col-md-6',
                'validate' => 'required',
                'id' => '',
                'multilang' => false,
                'attribute' => '',
                'required' => true,
                'readonly' => false,
                'disabled' => false,
                'format' => 'text'
            ),
            array(
                'title' => 'E-Mail',
                'name' => 'email',
                'type' => 'text',
                'class' => '',
                'grid' => 'col-md-6',
                'validate' => 'required',
                'id' => '',
                'multilang' => false,
                'attribute' => '',
                'required' => true,
                'readonly' => false,
                'disabled' => false,
                'format' => 'text'
            ),
            array(
                'title' => 'Adres',
                'name' => 'address',
                'type' => 'textarea',
                'class' => '',
                'grid' => 'col-md-12',
                'validate' => 'required',
                'id' => '',
                'multilang' => false,
                'attribute' => '',
                'required' => true,
                'readonly' => false,
                'disabled' => false,
                'format' => 'text'
            ),
            array(
                'title' => 'Öğrenci',
                'name' => 'student',
                'type' => 'text',
                'class' => '',
                'grid' => 'col-md-12',
                'validate' => 'required',
                'id' => '',
                'multilang' => false,
                'attribute' => '',
                'required' => true,
                'readonly' => false,
                'disabled' => false,
                'format' => 'text'
            ),
            array(
                'title' => 'Teslimat Tarihi',
                'name' => 'delivery_at',
                'type' => 'datetime-local',
                'class' => '',
                'grid' => 'col-md-6',
                'validate' => '',
                'id' => '',
                'multilang' => false,
                'attribute' => '',
                'required' => false,
                'readonly' => false,
                'disabled' => false,
                'format' => 'text'
            ),
            array(
                'title' => 'Teslimat Notu',
                'name' => 'delivery_note',
                'type' => 'textarea',
                'class' => '',
                'grid' => 'col-md-6',
                'validate' => 'required',
                'id' => '',
                'multilang' => false,
                'attribute' => '',
                'required' => false,
                'readonly' => false,
                'disabled' => false,
                'format' => 'text'
            ),
            array(
                'title' => 'Teslim Eden',
                'name' => 'delivery_person',
                'type' => 'text',
                'class' => '',
                'grid' => 'col-md-6',
                'validate' => 'required',
                'id' => '',
                'multilang' => false,
                'attribute' => '',
                'required' => false,
                'readonly' => false,
                'disabled' => false,
                'format' => 'text'
            ),
            array(
                'title' => 'Teslimat Kodu',
                'name' => 'delivery_code',
                'type' => 'text',
                'class' => '',
                'grid' => 'col-md-6',
                'validate' => 'required',
                'id' => '',
                'multilang' => false,
                'attribute' => '',
                'required' => false,
                'readonly' => false,
                'disabled' => false,
                'format' => 'text'
            ),
        );
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $page['title'] = $this->title.' -> Listesi';
        $page['table'] = route($this->route.'.show');
        $page['tablerow'] = $this->datatable['rows'];
        $page['button'] = $this->button;



        return view($this->page.'::index',compact('page'));
    }


    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Request $request)
    {
        $aColumns = array($this->datatable['table'].'.*');
        $iDisplayStart = $request->input('iDisplayStart', true);
        $iDisplayLength = $request->input('iDisplayLength', true);
        $sSearch = $request->input('search', true);

        $data['table']  = $this->datatable['table'];
        $data['select']  =$this->datatable['select'];
        $data['where']  =[];
        $data['join']  =  $this->datatable['join'];

        $lists = dataTable($data,$iDisplayStart,$iDisplayLength,$sSearch,$aColumns);

        $output = array();
        $output['aaData'] = array();
        if ($lists) {
            foreach ($lists as $list) {
                $row = array();
                $iEdit = route($this->route.'.edit',$list['id']);
                $iDestroy = route($this->route.'.destroy',$list['id']);




                $control = "";

                foreach ($this->control as $value){
                        if($value['type'] == "control"){
                            if($list[$value['column']] == $value['before']){
                                $control .= '<button  title="'.$value['title'].'"  data-toggle="tooltip" data-id="'.$list['id'].'" data-status="'.$value['status'].'" data-table="'.$value['table'].'"  data-column="'.$value['column'].'"  onclick="ColumnUpdate(this)"  class="btn  '.$value['class'].'  btn-smsharp mr-1 status_update"><i class="'.$value['icon'].'"></i></button>';
                            }
                        } else {

                                $control .= '<a href="javascript:void(0);"  '.$value['event'].' title="'.$value['title'].'"  data-id="'.$list['id'].'"  data-table="'.$value['table'].'"    class="btn  '.$value['class'].'  btn-smsharp mr-1 status_update"><i class="'.$value['icon'].'"></i></a>';
                        }
                }


                $button = "";
//                $button .= '<a href="' . $iEdit . '" target="_self" class="btn btn-primary  btn-smsharp mr-1" title="Düzenle" data-toggle="tooltip" ><i class="ri-edit-box-line"></i></a>';
                $button .= '<a href="' . $iDestroy . '" target="_self" class="btn btn-danger  btn-smsharp mr-1" title="Sil" data-toggle="tooltip" ><i class="ri-delete-bin-5-line"></i></a>';



                foreach ($this->datatable['rows'] as $item){
                    switch ($item['type']){
                        case 'text':
                            $row[] = $list[$item['row']];
                            break;
                            case 'money':
                            $row[] = currency($list[$item['row']]);
                            break;
                        case 'multilang':
                            $row[] =getlanguage($list[$item['row']],get_language());
                            break;
                        case 'path':
                            $row[] = $this->getParentsTree($list,getlanguage($list['name'],get_language()));
                            break;
                        case 'date':
                            $row[] = ($list[$item['row']]) ? date('Y-m-d H:i',strtotime($list[$item['row']])) : '';
                            break;
                    }
                }

                $row[] = $control;

                $row[] = $button;

                $output['aaData'][] = $row;

            }
        }

        return json_encode($output);
    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id = "")
    {
        $page['title'] = $this->title.' -> Düzenle';
        $page['action'] = route($this->route.'.update',$id);
        $page['row'] = $this->model::find($id);
        $page['multilang'] = $this->multilang;
        $page['form'] = $this->form;
        $html =  view('modalform',compact('page'))->render();
        return response()->json(['html' => $html]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {


        if (request()->isMethod('POST')) {


            // Bu alanda dizi içindeki elemanların validasyon kontrolleri yapoılmakta
            $validate = array();
            foreach ($this->form as $validate_control){
                if(isset($validate_control['validate']) and !empty($validate_control['validate'])){
                    $validate[$validate_control['name']] = $validate_control['validate'];
                }
            }
            //if($validate){  $request->validate($validate); }

            foreach ($this->form as $key => $validate_control){
                switch ($validate_control['format']){
                    case 'text':
                        $data[$validate_control['name']] = request($validate_control['name']);
                        break;
                    case 'json':
                        $data[$validate_control['name']] = json_encode(request($validate_control['name']),true);
                        break;
                    case 'json_none':
                        $data[$validate_control['name']] = json_encode($request->input($validate_control['name']),false);
                        break;
                    case 'none':
                        $data[$validate_control['name']] =  $request->input($validate_control['name']);
                        break;
                    case 'select':
                        $data[$validate_control['name']] = request($validate_control['name']) ? request($validate_control['name']): 0;
                        break;

                }
            }


            $entry = $this->model::where('id', $id)->firstOrFail();


            $update = $entry->update($data);

            if ($update) {
                $status = "success";
                $message = "İşlem Başarıyla Tamamlandı";
            } else {
                $status = "error";
                $message = "İşlem Sırasında Bir Hata Oluştu";
            }
            return redirect(route($this->route.'.index'))
                ->with('message', $message)
                ->with('message_type', $status);

        }

    }
    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $destroy = Order::destroy($id);

        if ($destroy) {
            $status = "success";
            $message = "İşlem Başarıyla Tamamlandı";
        } else {
            $status = "error";
            $message = "İşlem Sırasında Bir Hata Oluştu";
        }

        return redirect(route($this->route.'.index'))
            ->with('message', $message)
            ->with('message_type', $status);
    }

    public function EdmFatura($id='')
    {
   

        $orderData = Order::select('order.*', 'products_set.title as ps_title', 'products_set.title as ps_code' )
            ->join('products_set', 'order.product', '=', 'products_set.id',)
            ->where('order.id', $id)
            ->first();




        $edmManager = new EDMManager();
        $login = $edmManager->Login();
        if($login)
        {

            $faturabilgi = [
                'fatura_no' => 'SRM2024000000008',
                'fatura_tur' => 'SATIS',
                'fatura_yaziyla' => 'YalnızBinTl',

            ];

            $duzenleyenBilgileri = [
                "unvan" => "FONTE BİLGİ TEKNOLOJİERİ SANAYİ VE DIŞ TİCARE LİMİTED ŞİRKETİ",
                "adres" => "DİZDARİYE MAH. MEKTEP CAD. NO 1/12",
                "il" => "İSTANBUL",
                "ilce" => "BÜYÜKÇEKMECE",
                "ulkeKod" => "TR",
                "ulkeAd" => "TÜRKİYE",
                "vergiDaire" => "BÜYÜKÇEKMECE",
                "vkn" => "3230512384",
                "mersisno" => "MERSISNO",
                "hizmetno" => "HIZMETNO",
                "ticaretSicilNo" => "TICSICNO",
                "telefon" => "0288 214 04 30",
                "eposta" => "info@fonteyazilim.com",
                "website" => "www.fonteyazilim.com",
                "gibUrn" => "urn:mail:defaultgb@edmbilisim.com.tr"
            ];

            $aliciBilgileri = [
                "Person" => $orderData['name'],
                "adres" => $orderData['address'],
                "tip" => "GERCEKKISI", // TUZELKISI - GERCEKKISI
                "il" => "İSTANBUL",
                "ilce" => "İLCE",
                "ulkeKod" => "TR",
                "ulkeAd" => "TÜRKİYE",
                "vergiDaire" => "BAKIRKÖY",
                "TCKN" => $orderData['idenity'],

                "eposta" => "malicetin@privategayrimenkul.com.tr",
                "website" => "www.privategayrimenkul.com.tr",
                "gibUrn" => "urn:mail:defaultpk@privategayrimenkul.com.tr"
            ];
            $vergiBilgileri = [
                "siraNo" => 1,
                "vergiHaricTutar" => $orderData['paid_total'] - ($orderData['paid_total'] * ($orderData['vat'] / 100)),
                "vergiTutar" => ($orderData['paid_total'] * ($orderData['vat'] / 100)),
                "paraBirimKod" => "TRY",
                "vergiOran" => $orderData['vat'],
                "vergiKod" => "0015",
                "vergiAd" => "KDV GERCEK"
            ];



            $dipToplamlar = [
                "satirToplam" => $orderData['paid_total'] - ($orderData['paid_total'] * ($orderData['vat'] / 100)),
                "vergiDahilToplam" => ($orderData['paid_total'] * ($orderData['vat'] / 100)),
                "toplamIskonto" => 0,
                "yuvarlamaTutar" => 0,
                "odenecekTutar" => $orderData['paid_total']
            ];



            $faturaSatirlari = [
                [
                    "siraNo" => 1,
                    "birim" => "NIU",
                    "miktar" => 1,
                    "birimFiyat" => $orderData['paid_total'] - ($orderData['paid_total'] * ($orderData['vat'] / 100)),
                    "satirToplam" => $orderData['paid_total'] - ($orderData['paid_total'] * ($orderData['vat'] / 100)),
                    "vergiBilgileri" => [
                        "siraNo" => 1,
                        "vergiHaricTutar" => $orderData['paid_total'] - ($orderData['paid_total'] * ($orderData['vat'] / 100)),
                        "vergiTutar" => ($orderData['paid_total'] * ($orderData['vat'] / 100)),
                        "paraBirimKod" => "TRY",
                        "vergiOran" => $orderData['vat'],
                        "vergiKod" => "0015",
                        "vergiAd" => "KDV GERCEK"
                    ],
                    "urunBilgileri" => [
                        "serbestAciklama" => $orderData['ps_code'],
                        "ad" => $orderData['ps_title']
                    ]
                ]
            ];



            $sonuc = $edmManager->setEFatura($faturabilgi,$duzenleyenBilgileri,$aliciBilgileri,$vergiBilgileri,$dipToplamlar,$faturaSatirlari);

           print_r($sonuc);
           exit;
        }

    }

    public function Cargo()
    {
        $this->cargo = new CargoConfig();
        print_r($this->cargo->Aras());
    }
}
