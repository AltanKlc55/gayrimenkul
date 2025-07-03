<?php

namespace Modules\Current\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Modules\Current\Entities\CurrentType;
use Modules\Current\Entities\Current;

class CurrentController extends Controller
{

    private $model;
    private $table = "current";
    private $page = "current::current";
    private $routename= "current";
    private $title;
    private $menu_id = 0;
    private $buyorsel;
    private $multilang = false;

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function __construct(Request $request)
    {
        $this->buyorsel = $request->route('type');

        $this->model = Current::class;
        $this->title = ___('Cariler');
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
                'title' => 'Yeni Cari Ekle',
                'id' => '',
                'class' => '',
                'type' => 'link', // button,link
                'icon' => '', // button,link
                'href' => route($this->routename.'.create','customer'), // link ise gideceği sayfa
                'onclick' => '',
                'color' => 'primary'
            ),
        );

        $this->button2 = array(
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
                'title' => 'Yeni Tedarikçi Ekle',
                'id' => '',
                'class' => '',
                'type' => 'link', // button,link
                'icon' => '', // button,link
                'href' => route($this->routename.'.create','supplier'), // link ise gideceği sayfa
                'onclick' => '',
                'color' => 'primary'
            ),
        );

        $this->control = array(

        );
        $this->form  = array(
               array(
                'title' => 'Türü',
                'name' => 'current_type',
                'type' => 'select',
                'child' => 'title',
                'option' =>  get_definitions(($this->buyorsel == 'customer' ? 'customer_type' : 'supplier_type')),
                'class' => 'select2',
                'grid' => 'col-md-2',
                'id' => '',
                'json' => false,
                'multiple' => false,
                'required' => false,
                'validate' => "",
                'readonly' => false,
                'disabled' => false,
                'format' => 'select'
            ),

            array(
                'title' => 'Kısa Ünvanı',
                'name' => 'current_name',
                'type' => 'text',
                'class' => '',
                'grid' => 'col-md-4',
                'validate' => 'required|max:255',
                'id' => '',
                'multilang' => false,
                'attribute' => '',
                'required' => false,
                'readonly' => false,
                'disabled' => false,
                'format' => 'text'
            ),
            array(
                'title' => 'Tam Ünvanı',
                'name' => 'current_title',
                'type' => 'text',
                'class' => '',
                'grid' => 'col-md-4',
                'validate' => 'required|max:255',
                'id' => '',
                'multilang' => false,
                'attribute' => '',
                'required' => false,
                'readonly' => false,
                'disabled' => false,
                'format' => 'text'
            ),
            array(
                'title' => 'Adres',
                'name' => 'current_address',
                'type' => 'text',
                'class' => '',
                'grid' => 'col-md-12',
                'validate' => 'required|max:255',
                'id' => '',
                'multilang' => false,
                'attribute' => '',
                'required' => false,
                'readonly' => false,
                'disabled' => false,
                'format' => 'text'
            ),
            array(
                'title' => 'Vergi Dairesi',
                'name' => 'tax_administration',
                'type' => 'text',
                'class' => '',
                'grid' => 'col-md-4',
                'validate' => 'required|max:255',
                'id' => '',
                'multilang' => false,
                'attribute' => '',
                'required' => false,
                'readonly' => false,
                'disabled' => false,
                'format' => 'text'
            ),
            array(
                'title' => 'Vergi No',
                'name' => 'tax_number',
                'type' => 'text',
                'class' => '',
                'grid' => 'col-md-4',
                'validate' => 'required|max:255',
                'id' => '',
                'multilang' => false,
                'attribute' => '',
                'required' => false,
                'readonly' => false,
                'disabled' => false,
                'format' => 'text'
            ),
            array(
                'title' => 'Mersis',
                'name' => 'mersis',
                'type' => 'text',
                'class' => '',
                'grid' => 'col-md-4',
                'validate' => 'required|max:255',
                'id' => '',
                'multilang' => false,
                'attribute' => '',
                'required' => false,
                'readonly' => false,
                'disabled' => false,
                'format' => 'text'
            ),
            array(
                'title' => 'E-Mail',
                'name' => 'email',
                'type' => 'text',
                'class' => '',
                'grid' => 'col-md-4',
                'validate' => 'required|max:255',
                'id' => '',
                'multilang' => false,
                'attribute' => '',
                'required' => false,
                'readonly' => false,
                'disabled' => false,
                'format' => 'text'
            ),
            array(
                'title' => 'Telefon',
                'name' => 'phone',
                'type' => 'text',
                'class' => '',
                'grid' => 'col-md-4',
                'validate' => 'required|max:255',
                'id' => '',
                'multilang' => false,
                'attribute' => '',
                'required' => false,
                'readonly' => false,
                'disabled' => false,
                'format' => 'text'
            ),
            array(
                'title' => 'Fax',
                'name' => 'fax',
                'type' => 'text',
                'class' => '',
                'grid' => 'col-md-4',
                'validate' => 'required|max:255',
                'id' => '',
                'multilang' => false,
                'attribute' => '',
                'required' => false,
                'readonly' => false,
                'disabled' => false,
                'format' => 'text'
            ),
            array(
                'title' => 'Risk Limit',
                'name' => 'risk_limit',
                'type' => 'text',
                'class' => '',
                'grid' => 'col-md-4',
                'validate' => 'required|max:255',
                'id' => '',
                'multilang' => false,
                'attribute' => '',
                'required' => false,
                'readonly' => false,
                'disabled' => false,
                'format' => 'text'
            ),
            array(
                'title' => 'Vade Gün',
                'name' => 'maturity_day',
                'type' => 'text',
                'class' => '',
                'grid' => 'col-md-4',
                'validate' => 'required|max:255',
                'id' => '',
                'multilang' => false,
                'attribute' => '',
                'required' => false,
                'readonly' => false,
                'disabled' => false,
                'format' => 'text'
            ),
            array(
                'title' => 'Vergiden Muaf',
                'name' => 'tax_free',
                'type' => 'select',
                'child' => 'name',
                'option' =>  [['name' => 'Hayır', 'id' => 1],['name' => 'Evet', 'id' => 0]],
                'class' => 'select2',
                'grid' => 'col-md-4',
                'id' => '',
                'json' => false,
                'multiple' => false,
                'required' => false,
                'validate' => "",
                'readonly' => false,
                'disabled' => false,
                'format' => 'select'
            ),
            array(
                'title' => 'Not',
                'name' => 'note',
                'type' => 'textarea',
                'class' => '',
                'grid' => 'col-md-12',
                'validate' => "",
                'id' => '',
                'attribute' => '',
                'multilang' => false,
                'required' => false,
                'readonly' => false,
                'disabled' => false,
                'format' => 'text'
            ),
            array(
                'title' => '',
                'name' => 'buyorsel',
                'value' => ($this->buyorsel == 'customer' ? 1 : 2 ),
                'type' => 'hidden',
                'class' => '',
                'grid' => 'col-md-4',
                'validate' => 'required|max:255',
                'id' => '',
                'multilang' => false,
                'attribute' => '',
                'required' => false,
                'readonly' => false,
                'disabled' => false,
                'format' => 'hidden'
            ),

        );


        $this->datatable = array(
            'table' => $this->table,
            'select' => array(
                $this->table.'.*',
            'current_type.name as currenttype',
            ),
            'join' => array(
                array('current_type', 'current.current_type', '=', 'current_type.id','Left')
            ),
            'rows' => array(
                array('title' => 'ID','row' => 'id','type' => 'text'),
                array('title' => 'Ünvanı','row' => 'current_name','type' => 'link'),
                array('title' => 'Vergi Dairesi','row' => 'tax_administration','type' => 'text'),
                array('title' => 'Vergi No','row' => 'tax_number','type' => 'text'),
                array('title' => 'Mersis No','row' => 'mersis','type' => 'text'),
                array('title' => 'E-Mail','row' => 'email','type' => 'text'),
                array('title' => 'Telefon','row' => 'phone','type' => 'text'),
                array('title' => 'Fax','row' => 'fax','type' => 'text'),
                array('title' => 'Son İşlem Tarihi','row' => 'updated_at','type' => 'date'),
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


        return view($this->page.'.index',compact('page'));
    }

    public function supplier()
    {


        $page['title'] = 'Tedarikçiler';
        $page['table'] = route($this->routename.'.show2');
        $page['tablerow'] = $this->datatable['rows'];
        $page['button'] = $this->button2;


        return view($this->page.'.index',compact('page'));
    }

    public function create($type)
    {

        $page['title'] = ($type == 1 ? 'Cari ' : 'Tedarikçi ').' -> Ekle';
        $page['action'] = route($this->routename.'.store');



        $page['form'] = $this->form;
        $page['multilang'] = $this->multilang;
        return view($this->page.'.form',compact('page'));
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
                    case 'hidden':
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


            $create = $this->model::create($data);

            if ($create) {
                $status = "success";
                $message = "İşlem Başarıyla Tamamlandı";
            } else {
                $status = "error";
                $message = "İşlem Sırasında Bir Hata Oluştu";
            }

            return redirect(route($this->routename.'.index'))->with('message', $message)->with('message_type', $status);

        }

    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */


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
        //$data['where']  = [['current.buyorsel' , '1']];
        $data['join']  =  $this->datatable['join'];

        $lists = dataTable($data,$iDisplayStart,$iDisplayLength,$sSearch,$aColumns);

        $output = array();
        $output['aaData'] = array();
        if ($lists) {
            foreach ($lists as $list) {
                $row = array();
                $iInventory = route('current_inventory.index',$list['id']);
                $iSales = route('offer.create',$list['id']);
                $iPerson = route('current_person.index',$list['id']);
                $iAddress = route('current_address.index',$list['id']);
                $iNote = route('current_note.index',$list['id']);
                $iEdit = route($this->routename.'.edit',$list['id']);
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

                $button .= '<a href="' . $iInventory . '" target="_self" class="btn btn-dark  btn-smsharp mr-1" title="Ürünler" data-toggle="tooltip" ><i class="ri-database-2-line"></i></a>';
                $button .= '<a href="' . $iSales . '" target="_self" class="btn btn-dark  btn-smsharp mr-1" title="Satışlar" data-toggle="tooltip" ><i class="ri-shopping-cart-line"></i></a>';
                $button .= '<a href="' . $iPerson . '" target="_self" class="btn btn-dark  btn-smsharp mr-1" title="Yetkililer" data-toggle="tooltip" ><i class="ri-user-line"></i></a>';
                $button .= '<a href="' . $iAddress . '" target="_self" class="btn btn-secondary btn-smsharp mr-1" title="Adresler" data-toggle="tooltip" ><i class="ri-map-pin-line"></i></a>';
				$button .= '<a href="' . $iNote . '" target="_self" class="btn btn-warning  btn-smsharp mr-1" title="Notlar" data-toggle="tooltip" ><i class="ri-file-line"></i></a>';
                $button .= '<a href="' . $iEdit . '" target="_self" class="btn btn-primary  btn-smsharp mr-1" title="Düzenle" data-toggle="tooltip" ><i class="ri-edit-box-line"></i></a>';
                $button .= '<a href="' . $iDestroy . '" target="_self" class="btn btn-danger  btn-smsharp mr-1" title="Sil" data-toggle="tooltip" ><i class="ri-delete-bin-5-line"></i></a>';



                foreach ($this->datatable['rows'] as $item){
                    switch ($item['type']){
                        case 'link':
                            $row[] = '<a href="'.route($this->routename.'.detail',$list['id']).'">'.$list['current_name'].'</a>';
                            break;
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

                if($control){
                    $row[] = $control;

                }

                $row[] = $button;

                $output['aaData'][] = $row;

            }
        }

        return json_encode($output);
    }


    public function show2(Request $request)
    {
        $aColumns = array($this->datatable['table'].'.*');
        $iDisplayStart = $request->input('iDisplayStart', true);
        $iDisplayLength = $request->input('iDisplayLength', true);
        $sSearch = $request->input('search', true);

        $data['table']  = $this->datatable['table'];
        $data['select']  =$this->datatable['select'];
        $data['where']  = [['current.buyorsel' , '2']];
        $data['join']  =  $this->datatable['join'];

        $lists = dataTable($data,$iDisplayStart,$iDisplayLength,$sSearch,$aColumns);

        $output = array();
        $output['aaData'] = array();
        if ($lists) {
            foreach ($lists as $list) {
                $row = array();
                $iPerson = route('current_person.index',$list['id']);
                $iAddress = route('current_address.index',$list['id']);
                $iNote = route('current_note.index',$list['id']);
                $iEdit = route($this->routename.'.edit',$list['id']);
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

                /*

                                $button .= '<a href="' . $iPerson . '" target="_self" class="btn btn-dark  btn-smsharp mr-1" title="Yetkililer" data-toggle="tooltip" ><i class="ri-user-line"></i></a>';
                $button .= '<a href="' . $iAddress . '" target="_self" class="btn btn-secondary btn-smsharp mr-1" title="Adresler" data-toggle="tooltip" ><i class="ri-map-pin-line"></i></a>';

                */
                $button .= '<a href="' . $iNote . '" target="_self" class="btn btn-warning  btn-smsharp mr-1" title="Notlar" data-toggle="tooltip" ><i class="ri-file-line"></i></a>';
                $button .= '<a href="' . $iEdit . '" target="_self" class="btn btn-primary  btn-smsharp mr-1" title="Düzenle" data-toggle="tooltip" ><i class="ri-edit-box-line"></i></a>';
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
        $page['multilang'] = $this->multilang;


        $page['form'] = $this->form;




        return view($this->page.'.form',compact('page'));
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

    public function detail($id){
        $page['title'] = "Müşteri Detay";
        return view($this->page.'.detail',compact('page'));
    }

}
