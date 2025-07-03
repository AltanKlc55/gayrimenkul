<?php

namespace Modules\Bill\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Bill\Entities\Bill;
use Modules\Current\Entities\Current;

class BillController extends Controller
{

    private $model;
    private $table = "bill";
    private $page = "bill";
    private $routename= "bill";
    private $title;
    private $menu_id = 0;
    private $multilang = false;
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    protected $period = 0;
    protected $financegroup;

    public function __construct()
    {

        $this->form  = array(
            array(
                'title' => 'İşlem Tarihi',
                'name' => 'process_date',
                'type' => 'date',
                'class' => '',
                'grid' => 'col-md-3',
                'validate' => "",
                'id' => '',
                'value' => date('Y-m-d'),
                'attribute' => '',
                'multilang' => false,
                'required' => true,
                'readonly' => false,
                'disabled' => false,
                'format' => 'text'
            ),
//            array(
//                'title' => 'Vade Tarihi',
//                'name' => 'maturity_date',
//                'type' => 'date',
//                'class' => '',
//                'grid' => 'col-md-3',
//                'validate' => "",
//                'id' => '',
//                'attribute' => '',
//                'multilang' => false,
//                'required' => true,
//                'readonly' => false,
//                'disabled' => false,
//                'format' => 'text'
//            ),
            array(
                'title' => 'Tahsilat Türü',
                'name' => 'type',
                'type' => 'select',
                'child' => 'title',
                'option' => get_definitions('bill_type'),
                'class' => 'select2',
                'grid' => 'col-md-3',
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
                'title' => 'Tahsilat Çeşidi',
                'name' => 'variety',
                'type' => 'select',
                'child' => 'title',

                'option' => get_definitions('variety'),
                'class' => 'select2',
                'grid' => 'col-md-3',
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
                'title' => 'Cari',
                'name' => 'current_id',
                'type' => 'select',
                'child' => 'current_name',
                'option' => Current::get()->toArray(),
                'class' => 'select2',
                'grid' => 'col-md-3',
                'id' => '',
                'json' => false,
                'multiple' => false,
                'required' => false,
                'validate' => "",
                'readonly' => false,
                'disabled' => false,
                'format' => 'select'
            ),
//            array(
//                'title' => 'Çek No',
//                'name' => 'bill_no',
//                'type' => 'text',
//                'class' => '',
//                'grid' => 'col-md-4',
//                'validate' => "",
//                'id' => '',
//                'attribute' => '',
//                'multilang' => false,
//                'required' => true,
//                'readonly' => false,
//                'disabled' => false,
//                'format' => 'text'
//            ),
//            array(
//                'title' => 'Hesap No',
//                'name' => 'account_number',
//                'type' => 'text',
//                'class' => '',
//                'grid' => 'col-md-4',
//                'validate' => "",
//                'id' => '',
//                'attribute' => '',
//                'multilang' => false,
//                'required' => true,
//                'readonly' => false,
//                'disabled' => false,
//                'format' => 'text'
//            ),
            array(
                'title' => 'İşlem Tutarı',
                'name' => 'amount',
                'type' => 'text',
                'class' => 'currency',
                'grid' => 'col-md-6',
                'validate' => "",
                'id' => '',
                'attribute' => '',
                'multilang' => false,
                'required' => true,
                'readonly' => false,
                'disabled' => false,
                'format' => 'text'
            ),

//            array(
//                'title' => 'KDV Oranı',
//                'name' => 'tax',
//                'type' => 'number',
//                'class' => '',
//                'grid' => 'col-md-3',
//                'validate' => "",
//                'id' => '',
//                'attribute' => '',
//                'multilang' => false,
//                'required' => true,
//                'readonly' => false,
//                'disabled' => false,
//                'format' => 'text'
//            ),

            array(
                'title' => 'Para Birimi',
                'name' => 'unit',
                'type' => 'select',
                'child' => 'title',

                'option' => get_definitions('exchange'),
                'class' => 'select2',
                'grid' => 'col-md-6',
                'id' => '',
                'json' => false,
                'multiple' => false,
                'required' => false,
                'validate' => "",
                'readonly' => false,
                'disabled' => false,
                'format' => 'select'
            ),
//
//            array(
//                'title' => 'Gerçek Tutar',
//                'name' => 'real_amount',
//                'type' => 'text',
//                'class' => 'currency',
//                'grid' => 'col-md-4',
//                'validate' => "",
//                'id' => '',
//                'attribute' => '',
//                'multilang' => false,
//                'required' => true,
//                'readonly' => false,
//                'disabled' => false,
//                'format' => 'text'
//            ),

            array(
                'title' => 'USD',
                'name' => 'usd',
                'type' => 'text',
                'class' => 'currency',
                'grid' => 'col-md-4',
                'validate' => "",
                'id' => '',
                'value' => get_exchange('usd'),
                'attribute' => '',
                'multilang' => false,
                'required' => true,
                'readonly' => false,
                'disabled' => false,
                'format' => 'text'
            ),
            array(
                'title' => 'EURO',
                'name' => 'euro',
                'type' => 'text',
                'class' => 'currency',
                'grid' => 'col-md-4',
                'validate' => "",
                'value' => get_exchange('euro'),

                'id' => '',
                'attribute' => '',
                'multilang' => false,
                'required' => true,
                'readonly' => false,
                'disabled' => false,
                'format' => 'text'
            ),
            array(
                'title' => 'Parite',
                'name' => 'parite',
                'type' => 'text',
                'class' => 'currency',
                'grid' => 'col-md-4',
                'validate' => "",
                'id' => '',
                'value' => get_exchange('parite'),

                'attribute' => '',
                'multilang' => false,
                'required' => true,
                'readonly' => false,
                'disabled' => false,
                'format' => 'text'
            ),

//            array(
//                'title' => 'Banka',
//                'name' => 'bank',
//                'type' => 'text',
//                'class' => '',
//                'grid' => 'col-md-3',
//                'validate' => "",
//                'id' => '',
//                'attribute' => '',
//                'multilang' => false,
//                'required' => true,
//                'readonly' => false,
//                'disabled' => false,
//                'format' => 'text'
//            ),
//            array(
//                'title' => 'Şube',
//                'name' => 'branch',
//                'type' => 'text',
//                'class' => '',
//                'grid' => 'col-md-3',
//                'validate' => "",
//                'id' => '',
//                'attribute' => '',
//                'multilang' => false,
//                'required' => true,
//                'readonly' => false,
//                'disabled' => false,
//                'format' => 'text'
//            ),
//            array(
//                'title' => 'İl',
//                'name' => 'province',
//                'type' => 'text',
//                'class' => '',
//                'grid' => 'col-md-3',
//                'validate' => "",
//                'id' => '',
//                'attribute' => '',
//                'multilang' => false,
//                'required' => true,
//                'readonly' => false,
//                'disabled' => false,
//                'format' => 'text'
//            ),
//            array(
//                'title' => 'İlçe',
//                'name' => 'district',
//                'type' => 'text',
//                'class' => '',
//                'grid' => 'col-md-3',
//                'validate' => "",
//                'id' => '',
//                'attribute' => '',
//                'multilang' => false,
//                'required' => true,
//                'readonly' => false,
//                'disabled' => false,
//                'format' => 'text'
//            ),
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
                'required' => true,
                'readonly' => false,
                'disabled' => false,
                'format' => 'text'
            ),



        );

        $this->model = Bill::class;
        $this->title = ___('Tahsilat Yönetimi');
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
                'title' => 'Yeni Ekle',
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
        $this->datatable = array(
            'table' => $this->table,
            'select' => array(
                $this->table.'.*',
                'current.current_name as current_name',
                'unit.title as currency',
                'variety.title as variety_text',
                'type.title as type_text',
            ),
            'join' => array(
                array('current', 'bill.current_id', '=', 'current.id','Left'),
                array('definitions_child as unit', 'bill.unit', '=', 'unit.id','Left'),
                array('definitions_child as variety', 'bill.variety', '=', 'variety.id','Left'),
                array('definitions_child as type', 'bill.type', '=', 'type.id','Left')
            ),
            'rows' => array(
                array('title' => 'İşlem Tarihi','row' => 'process_date','type' => 'date'),
                array('title' => 'Cari','row' => 'current_name','type' => 'text'),
                array('title' => 'Tahsilat Türü','row' => 'type_text','type' => 'text'),
                array('title' => 'Tahsilat Çeşidi ','row' => 'variety_text','type' => 'text'),
                array('title' => 'Tutar','row' => 'amount','type' => 'money','prefix' => 'currency'),
                array('title' => 'İşlem Notu','row' => 'note','type' => 'text'),
//                array('title' => 'Kontroller','type' => 'control'),
                array('title' => 'İşlemler','type' => 'button'),
            )
        );

    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $page['title'] = $this->title;
        $page['table'] = route($this->routename.'.show');
        $page['tablerow'] = $this->datatable['rows'];
        $page['button'] = $this->button;


        return view($this->page.'::index',compact('page'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $page['title'] = $this->title.' -> Ekle';
        $page['action'] = route($this->routename.'.store');


        $page['form'] = $this->form;
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

            $name = (request('name')) ?  Str::slug(request('name')) : time();


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
                $iEdit = route($this->routename.'.edit',$list['id']);
                $iDestroy = route($this->routename.'.destroy',$list['id']);


                $control = "";

                foreach ($this->control as $item){
                    foreach ($item as $value){
                        if($list[$value['column']] == $value['before']){
                            $control .= '<button  title="'.$value['title'].'"  data-toggle="tooltip" data-id="'.$list['id'].'" data-status="'.$value['status'].'" data-table="'.$value['table'].'"  data-column="'.$value['column'].'"  onclick="ColumnUpdate(this)"  class="btn  '.$value['class'].'  btn-smsharp mr-1 status_update"><i class="'.$value['icon'].'"></i></button>';
                        }
                    }
                }

                /*
                  if ($list['status'] == 0) {
                     $control .= '<button  title="Aktif"  data-toggle="tooltip" data-id="'.$list['id'].'" data-status="1" data-table="'.$this->table.'"  data-column="status"  onclick="ColumnUpdate(this)"  class="btn  btn-light  btn-smsharp mr-1 status_update"><i class="fe fe-check-circle"></i></button>';
                 } else {
                     $control .= '<button  title="Pasif"  data-toggle="tooltip" data-id="'.$list['id'].'" data-status="0" data-table="'.$this->table.'"  data-column="status"  onclick="ColumnUpdate(this)"  class="btn  btn-dark  btn-smsharp mr-1 status_update"><i class="fe fe-check-circle"></i></button>';
                 }
                 if ($list['listening'] == 0) {
                     $control .= '<button  title="Listelemede Göste"  data-toggle="tooltip" data-id="'.$list['id'].'" data-status="1" data-table="'.$this->table.'"  data-column="listening"  onclick="ColumnUpdate(this)"  class="btn  btn-light  btn-smsharp mr-1 status_update"><i class="fe fe-check-circle"></i></button>';
                 } else {
                     $control .= '<button  title="Listelemede Gösterme"  data-toggle="tooltip" data-id="'.$list['id'].'" data-status="0" data-table="'.$this->table.'"  data-column="listening"  onclick="ColumnUpdate(this)"  class="btn  btn-dark  btn-smsharp mr-1 status_update"><i class="fe fe-check-circle"></i></button>';
                 }
                 */


                $button = "";
                $button .= '<a href="' . $iEdit . '" target="_self" class="btn btn-primary  btn-smsharp mr-1" title="Düzenle" data-toggle="tooltip" ><i class="ri-edit-box-line"></i></a>';
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

                            $menu =  Menu::where('id',$list[$item['row']])->get()->first();

                            $row[] = $this->getParentsTree($menu,getlanguage($menu->name,get_language()));
                            break;
                        case 'date':
                            $row[] = date('Y-m-d H:i',strtotime($list[$item['row']]));
                            break;
                    }
                }

//                $row[] = $control;
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

        $this_element = json_decode($page['row']['this_elements'],true);



        $page['form'] = $this->form;




        return view($this->page.'::form',compact('page'));
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

            $name = (request('name')) ?  Str::slug(request('name')) : time();
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
}
