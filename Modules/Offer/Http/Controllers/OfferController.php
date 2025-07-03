<?php

namespace Modules\Offer\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Modules\Offer\Entities\Offers;
use Modules\Offer\Entities\OfferChild;
use Modules\Current\Entities\Current;
use Modules\Product\Entities\Products;
use Modules\Product\Entities\Productset;
use Modules\Product\Entities\ProductChild;
use Modules\Admin\Entities\User;
use Modules\Current\Entities\Address;
use Modules\Current\Entities\Person;
class OfferController extends Controller
{

    private $model;
    private $table = "offers";
    private $page = "offer";
    private $routename= "offer";
    private $title;
    private $menu_id = 0;
    private $multilang = false;

    protected $current_id;

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function __construct(Request $request)
    {
        $this->current_id = $request->route('current_id');
        $this->model = Offers::class;
        $this->title = ___('Satış');
        $this->button = array(
//            array(
//                'title' => 'Yeni Ekle',
//                'id' => '',
//                'class' =>'',
//                'type' => 'dropdown', // button,link
//                'icon' => '', // button,link
//                'href' => "", // link ise gideceği sayfa
//                'option' => $this->createlink,
//                'onclick' =>'',
//                'color' =>'primary'
//            ),
            array(
                'title' => 'Yeni Satış Oluştur',
                'id' => '',
                'class' => '',
                'type' => 'link', // button,link
                'icon' => '', // button,link
                'href' => route($this->routename.'.create'), // link ise gideceği sayfa
                'onclick' => '',
                'color' => 'primary'
            ),
        );
        $this->control = array(

        );
        $this->form  = array(
            array(
                'title' => 'Cari',
                'name' => 'current_id',
                'type' => 'select',
                'child' => 'current_name',
                'selected' => $this->current_id,
                'option' =>  Current::get()->toArray(),
                'class' => 'select2',
                'grid' => 'col-md-6',
                'id' => '',
                'json' => false,
                'multiple' => false,
                'required' => true,
                'validate' => "",
                'attribute' => 'onchange="get_address(this); get_person(this)"',
                'readonly' => false,
                'disabled' => false,
                'format' => 'select'
            ),
            array(
               'title' => 'Fatura Adres',
               'name' => 'address',
               'type' => 'select',
               'child' => 'title',
               'option' =>  array(),
               'class' => 'select2',
               'grid' => 'col-md-3',
               'id' => 'addres',
               'json' => false,
               'multiple' => false,
               'required' => true,
               'validate' => "",
               'readonly' => false,
               'disabled' => false,
               'format' => 'select'
            ),
            array(
               'title' => 'Firma Temsilci',
               'name' => 'person_id',
               'type' => 'select',
               'child' => 'title',
               'option' =>  array(),
               'class' => 'select2',
               'grid' => 'col-md-3',
               'id' => 'person',
               'json' => false,
               'multiple' => false,
               'required' => true,
               'validate' => "",
               'readonly' => false,
               'disabled' => false,
               'format' => 'select'
            ),
           
            array(
                'title' => 'Kod',
                'name' => 'offer_id',
                'type' => 'hidden',
                'value' => time(),
                'class' => '',
                'grid' => 'col-md-6',
                'validate' => '',
                'id' => '',
                'multilang' => false,
                'attribute' => '',
                'required' => true,
                'readonly' => false,
                'disabled' => false,
                'format' => 'text'
            ),
        );
        $this->repeater  = array(
            array(
                'title' => 'Ürün',
                'name' => 'product',
                'type' => 'select',
                'child' => 'title',
                'option' =>  Productset::get()->toArray(),
                'class' => 'select2 item-id',
                'grid' => 'col-md-4',
                'id' => 'product',
                'attribute' => 'onchange=get_product(this)',
                'json' => false,
                'multiple' => false,
                'required' => true,
                'validate' => "",
                'readonly' => false,
                'disabled' => false,
                'format' => 'select'
            ),
            array(
                'title' => 'Birim Miktar',
                'name' => 'qty',
                'type' => 'number',
                'class' => '',
                'grid' => 'col-md-2',
                'validate' => 'required|max:255',
                'id' => '',
                'multilang' => false,
                'attribute' => '',
                'required' => true,
                'readonly' => false,
                'disabled' => false,
                'format' => 'money'
            ),
            array(
                'title' => 'Birim Tutar',
                'name' => 'price',
                'type' => 'text',
                'class' => 'unit_price',
                'grid' => 'col-md-2',
                'validate' => '',
                'id' => 'qtyprd',
                'multilang' => false,
                'attribute' => '',
                'required' => true,
                'readonly' => false,
                'disabled' => false,
                'format' => 'money'
            ),

            array(
                'title' => 'Depo',
                'name' => 'store',
                'type' => 'select',
                'child' => 'title',
                'option' =>  get_definitions('warehouse'),
                'class' => 'select2',
                'grid' => 'col-md-2',
                'id' => '',
                'json' => false,
                'multiple' => false,
                'required' => true,
                'validate' => "",
                'readonly' => false,
                'disabled' => false,
                'format' => 'select'
            ),
        );



        $this->datatable = array(
            'table' => $this->table,
            'select' => array(
                $this->table.'.*',
                'current.current_name as current_name',
                'definitions_child.title as currency',
            ),
            'join' => array(
                array('current', 'offers.current_id', '=', 'current.id','Left'),
                array('definitions_child', 'offers.currency', '=', 'definitions_child.id','Left')
            ),
            'rows' => array(
                array('title' => 'ID','row' => 'id','type' => 'text'),
                array('title' => 'Cari','row' => 'current_name','type' => 'text'),
//                array('title' => 'Teklif Kodu','row' => 'offer_id','type' => 'text'),
//                array('title' => 'Teklif Başlık','row' => 'title','type' => 'text'),
                array('title' => 'Satış Tutar','row' => 'price','type' => 'money','prefix' => 'currency'),
                array('title' => 'Satış Tarihi','row' => 'created_at','type' => 'date'),
//                array('title' => 'Bitiş Tarihi','row' => 'due_date','type' => 'date'),
                array('title' => 'Son İşlem Tarihi','row' => 'updated_at','type' => 'datetime'),
                //array('title' => 'Kontroller','type' => 'control'),
                array('title' => 'İşlemler','type' => 'button'),
            )
        );
    }
    public function index()
    {


        $page['title'] = $this->title;
        $page['table'] = route($this->routename.'.show');
        $page['tablerow'] = $this->datatable['rows'];
        $page['button'] = $this->button;


        return view($this->page.'::index',compact('page'));
    }

    public function create()
    {

        $page['title'] = $this->title.' -> Oluştur';
        $page['action'] = route($this->routename.'.store');


        $page['form'] = $this->form;
        $page['repeater'] = $this->repeater;
        $page['multilang'] = $this->multilang;
        return view($this->page.'::form',compact('page'));
    }

    public function store(Request $request)
    {

        if (request()->isMethod('POST')) {


            // Bu alanda dizi içindeki elemanların validasyon kontrolleri yapoılmakta
            $validate = array();
            foreach ($this->form as $validate_control){
                if(isset($validate_control['validate']) and !empty($validate_control['validate'])){
                    $validate[$validate_control['name']] = $validate_control['validate'];
                }
            }
            if($validate){  $request->validate($validate); }

            $name = Str::slug(request('name'));


            foreach ($this->form as $key => $validate_control){
                switch ($validate_control['format']){
                    case 'text':
                        $data[$validate_control['name']] = request($validate_control['name']);
                        break;
                    case 'json':
                        $data[$validate_control['name']] = json_encode(request($validate_control['name']),true);
                        break;
                    case 'json_none':
                        $data[$validate_control['name']] = json_encode($request->input($validate_control['name']),true);
                        break;
                    case 'none':
                        $data[$validate_control['name']] =  $request->input($validate_control['name']);
                        break;
                    case 'money':
                        $data[$validate_control['name']] =  floatvalue($request->input($validate_control['name']));
                        break;
                    case 'select_json':
                        $data[$validate_control['name']] = request($validate_control['name']) ? json_encode(request($validate_control['name'])): "";
                        break;
                    case 'select':
                        $data[$validate_control['name']] = request($validate_control['name']) ? request($validate_control['name']): 0;
                        break;
                    case 'file':
                        if(request()->hasFile($validate_control['name'])){
                            $image = request()->file($validate_control['name']);
                            $imageName = $name.$key.'.'.$image->extension();
                            $image->move(public_path('./'.$validate_control['path']), $imageName);
                            $data[$validate_control['name']] = $imageName;
                        }
                        break;
                }
            }

            $data['auth'] = auth('manager')->user()->id;

            $create = $this->model::create($data);

            if ($create) {

                if ($request->items){
                    $childs = array();
                    foreach ($request->items as $item){
                        $prd = Productset::where('id',$item['product'])->first();
                        $childs[] = array(
                            'offer_id' => $request->offer_id,
                            'product' => $item['product'],
                            'title' => getlanguage($prd['title'],get_language()),
//                            'vat' =>$prd['vat'],
//                            'currency' =>$item['currency'],
//                            'delivery_at' =>$item['delivery_at'],
                            'qty' => $item['qty'],
                            'store' => $item['store'],
                            'price' => floatvalue($item['price']),
//                            'workmanship_price' => $item['workmanship_price'],
//                            'workmanship_currency' => $item['workmanship_currency'],
                        );
                    }
                }
                OfferChild::insert($childs);


                $total = OfferChild::selectRaw('SUM(price) as total')->where('offer_id','=',$request->offer_id)->pluck('total')->first();
                $totalupdate = array();
                $totalupdate['price'] = floatval($total);
                $entry =  Offers::where('offer_id', $request->offer_id)->firstOrFail();
                $entry->update($totalupdate);
            }
            $status = "success";
            $message = "İşlem Başarıyla Tamamlandı";
        } else {
            $status = "error";
            $message = "İşlem Sırasında Bir Hata Oluştu";
        }
        return redirect(route($this->routename.'.index'))->with('message', $message)->with('message_type', $status);

    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
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
//                $iPerson = route('current_person.index',$list['id']);
//                $iAddress = route('current_address.index',$list['id']);
                $iEdit = route($this->routename.'.edit',$list['id']);
                $iPrint = route($this->routename.'.print',$list['id']);
                $iDestroy = route($this->routename.'.destroy',$list['id']);



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
                $button .= '<a href="' . $iEdit . '" target="_self" class="btn btn-primary  btn-smsharp mr-1" title="Düzenle" data-toggle="tooltip" ><i class="ri-edit-box-line"></i></a>';
//                $button .= '<a href="' . $iPrint . '" target="_blank" class="btn btn-info  btn-smsharp mr-1" title="Düzenle" data-toggle="tooltip" ><i class="ri-printer-line"></i></a>';
                $button .= '<a href="' . $iDestroy . '" target="_self" class="btn btn-danger  btn-smsharp mr-1" title="Sil" data-toggle="tooltip" ><i class="ri-delete-bin-5-line"></i></a>';

                foreach ($this->datatable['rows'] as $item){
                    switch ($item['type']){
                        case 'text':
                            $row[] = $list[$item['row']];
                            break;
                        case 'money':
                            $row[] = currency($list[$item['row']]).' '.$list[$item['prefix']];
                            break;
                        case 'multilang':
                            $row[] =getlanguage($list[$item['row']],get_language());
                            break;
                        case 'path':
                            $row[] = $this->getParentsTree($list,getlanguage($list['name'],get_language()));
                            break;
                        case 'date':
                            $row[] = ($list[$item['row']]) ? date('Y-m-d',strtotime($list[$item['row']])) : '';
                            break;
                        case 'datetime':
                            $row[] = ($list[$item['row']]) ? date('Y-m-d H:i',strtotime($list[$item['row']])) : '';
                            break;
                    }
                }

                if($control){
                    $row[] = $control;
                }

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
    public function edit($id)
    {
        $page['title'] = $this->title.' -> Düzenle';
        $page['action'] = route($this->routename.'.update',$id);
        $page['row'] = $this->model::find($id);
        $row = $this->model::find($id);
        $page['childs'] = OfferChild::where('offer_id',$page['row']->offer_id)->get()->toArray();
        $page['multilang'] = $this->multilang;
        $page['form'] = $this->form;
        $page['repeater'] = $this->repeater;


        return view($this->page.'::form',compact('page','row'));
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
            if($validate){  $request->validate($validate); }

            $name = Str::slug(request('name'));
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
                    case 'money':
                        $data[$validate_control['name']] =  floatvalue($request->input($validate_control['name']));
                        break;
                    case 'select':
                        $data[$validate_control['name']] = request($validate_control['name']) ? request($validate_control['name']): 0;
                        break;
                    case 'select_json':
                        $data[$validate_control['name']] = request($validate_control['name']) ? json_encode(request($validate_control['name'])): "";
                        break;
                    case 'file':
                        if(request()->hasFile($validate_control['name'])){
                            $image = request()->file($validate_control['name']);
                            $imageName = $name.$key.'.'.$image->extension();
                            $image->move(public_path('./'.$validate_control['path']), $imageName);
                            $data[$validate_control['name']] = $imageName;
                        }
                        break;
                }
            }
            $entry = $this->model::where('id', $id)->firstOrFail();
            $update = $entry->update($data);
            if ($update) {

                OfferChild::where('offer_id', $request->offer_id)->delete();
                if ($request->items){
                    $childs = array();
                    foreach ($request->items as $item){
                        $prd = Productset::where('id',$item['product'])->first();

                        $childs[] = array(
                            'offer_id' => $request->offer_id,
                            'product' => $item['product'],
                            'title' => getlanguage($prd['title'],get_language()),
//                            'vat' =>$prd['vat'],
//                            'currency' =>$item['currency'],
//                            'delivery_at' =>$item['delivery_at'],
                            'qty' => $item['qty'],
                            'price' => floatvalue($item['price']),
                            'store' => $item['store'],
//                            'workmanship_price' => $item['workmanship_price'],
//                            'workmanship_currency' => $item['workmanship_currency'],
                        );
                    }
                    OfferChild::insert($childs);


                }
                $total = OfferChild::selectRaw('SUM(price) as total')->where('offer_id','=',$request->offer_id)->pluck('total')->first();
                $totalupdate = array();
                $totalupdate['price'] = floatval($total);
                $entry =  Offers::where('id', $id)->firstOrFail();
                $entry->update($totalupdate);

                $status = "success";
                $message = "İşlem Başarıyla Tamamlandı";
            } else {
                $status = "error";
                $message = "İşlem Sırasında Bir Hata Oluştu";
            }
            return redirect(route($this->routename.'.index'))
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
        $destroy = $this->model::destroy($id);

        if ($destroy) {
            $status = "success";
            $message = "İşlem Başarıyla Tamamlandı";
        } else {
            $status = "error";
            $message = "İşlem Sırasında Bir Hata Oluştu";
        }
        return redirect(route($this->routename.'.index'))
            ->with('message', $message)
            ->with('message_type', $status);
    }

    public function print($id)
    {

        $page['title'] = ___('Çıktı Al');

        $result = $this->model::find($id);

        if(!$result){
            return redirect(route($this->routename.'.index'));
        }
        $buyyer = User::where('id',$result->current_id)->first()->toArray();

        $childs = array();
        $childs['select'] = array(
            'offer_child.*',
            'definitions_child.title as unit',
            'brand.title as brand'
        );
        $childs['join'] = array(
            array('products','offer_child.product','=','products.id','Left'),
            array('definitions_child','products.unit','=','definitions_child.id','Left'),
            array('definitions_child as brand','products.brand','=','brand.id','Left')
        );

        $childs['whereNull'] = "offer_child.deleted_at";


        $page['childs'] = getQuery('offer_child',$childs);

        $tax = array();

        $sumchilds = array();
        $sumchilds['selectRaw'] = array(
            'COALESCE(SUM((price * qty) * (1+vat/100)),0) as total',
            'COALESCE(SUM(price * qty),0) as sub_total',
            'currency',
            'vat',
            'definitions_child.title as get_currency',
        );
        $sumchilds['join'] = array(
            array('definitions_child','offer_child.currency','=','definitions_child.id','Left'),
        );
        $sumchilds['whereNull'] = "definitions_child.deleted_at";
        $sumchilds['groupBy'] = array('vat','currency');
        $sumtotal = getQuery('offer_child',$sumchilds);
        $total = 0;
        $sub_total = 0;
        foreach ($sumtotal as $item) {
            $tax[$item['get_currency']]['total'] = 0;
            $tax[$item['get_currency']]['sub_total'] = 0;
        }
        foreach ($sumtotal as $item) {
            if($item['sub_total'] > 0) {
                $tax[$item['get_currency']]['childs'][$item['vat']][] = $item;
                $tax[$item['get_currency']]['total'] += $item['total'];
                $tax[$item['get_currency']]['sub_total'] += $item['sub_total'];
            }
        }


        $sumworkchilds = array();
        $sumworkchilds['selectRaw'] = array(
            'COALESCE(SUM((workmanship_price * qty) * (1+vat/100)),0) as total',
            'COALESCE(SUM(workmanship_price * qty),0) as sub_total',
            'currency',
            'vat',
            'definitions_child.title as get_currency',
        );

        $sumworkchilds['join'] = array(
            array('definitions_child','offer_child.currency','=','definitions_child.id','Left'),
        );

        $sumworkchilds['whereNull'] = "definitions_child.deleted_at";
        $sumworkchilds['groupBy'] = array('vat','workmanship_currency');
        $sumwork = getQuery('offer_child',$sumworkchilds);

        foreach ($sumwork as $item) {
            if($item['sub_total'] > 0){

                $tax[$item['get_currency']]['childs'][$item['vat']][] = $item;

                $tax[$item['get_currency']]['total'] += $item['total'];
                $tax[$item['get_currency']]['sub_total'] += $item['sub_total'];
            }
        }
//      echo '<pre>';
//        print_r($tax);
//      echo '</pre>';

        return view($this->page.'::print',compact('page','result','buyyer','tax'));

    }

    public function get_product(Request $request)
    {
        $json = array();
        if (request()->isMethod('POST')) {

            $product = Productset::where('id',$request->product)->first();
//            $price = ProductChild::where('code','=',$product->code)->sum('total');

            $total_cm = ProductChild::selectRaw('SUM(qty * price) as total')->where('unit',28)->where('code','=',$product->code)->pluck('total')->first();
            $total_adet = ProductChild::selectRaw('SUM(qty * price) as total')->where('unit',27)->where('code','=',$product->code)->pluck('total')->first();


            $json['unit'] = $product['currency'];
            $json['price'] = number_format((($total_cm / 100) + $total_adet) * get_currency_exchange($request->currency),2,".","");

        }
        echo json_encode($json);
    }

    public function get_product_unit(Request $request)
    {
        $json = array();
        if (request()->isMethod('POST')) {

            $product = Productset::where('id',$request->product)->first();
            $product_unit = get_definition($product->currency,"value");
            $unit = get_definition($request->unit,"value");



            $json['price'] = number_format(exchange_convert($product['total'],$product_unit,$unit),2,".","");

        }
        echo json_encode($json);
    }

    public function get_address(Request $request)
    {
        $childs = Address::where('current_id',$request->id)->get()->toArray();
        $json = "";

        foreach ($childs as $child){
            $selected =  "";
            if(isset($request->selected)){
                $selected = ($child['id'] == $request->selected) ? 'selected' : '';
            }
            $json .= '<option value="'.$child['id'].'" '.$selected.'>'.$child['title'].'</option>';
        }

        echo json_encode($json);
    }
    public function get_person(Request $request)
    {
        $childs = Person::where('current_id',$request->id)->get()->toArray();
        $json = "";

        foreach ($childs as $child){
            $selected =  "";
            if(isset($request->selected)){
                $selected = ($child['id'] == $request->selected) ? 'selected' : '';
            }
            $json .= '<option value="'.$child['id'].'" '.$selected.'>'.$child['name'].' '.$child['surname'].'</option>';
        }

        echo json_encode($json);
    }

}
