<?php

namespace Modules\Invoice\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Modules\Current\Entities\Current;
use Modules\Invoice\Entities\Invoice;

class InvoiceController extends Controller
{

    private $model;
    private $table = "invoice";
    private $page = "invoice";
    private $routename= "invoice";
    private $title;
    private $menu_id = 0;
    private $multilang = false;

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function __construct()
    {
        $this->model = Invoice::class;
        $this->title = ___('Faturalar');
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
        $this->form  = array(
            array(
                'title' => 'Cari',
                'name' => 'current_id',
                'type' => 'select',
                'child' => 'current_name',
                'option' =>  Current::get()->toArray(),
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
                'title' => 'Fatura Türü',
                'name' => 'invoice_type',
                'type' => 'select',
                'child' => 'name',
                'option' =>  array(
                    ['id' => 0,'name' => 'Satış'],
                    ['id' => 1,'name' => 'Proforma'],
                    ['id' => 2,'name' => 'İade'],
                ),
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
                'title' => 'Fatura Kodu',
                'name' => 'invoice_id',
                'type' => 'text',
                'class' => '',
                'grid' => 'col-md-3',
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
                'title' => 'Fatura Tutarı',
                'name' => 'amount',
                'type' => 'text',
                'class' => 'currency',
                'grid' => 'col-md-3',
                'validate' => 'required|max:255',
                'id' => '',
                'multilang' => false,
                'attribute' => '',
                'required' => false,
                'readonly' => false,
                'disabled' => false,
                'format' => 'money'
            ),
            array(
                'title' => 'KDV',
                'name' => 'vat',
                'type' => 'number',
                'class' => '',
                'grid' => 'col-md-3',
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
                'title' => 'Fatura Dosyası',
                'name' => 'invoice_file',
                'type' => 'file',
                'class' => '',
                'grid' => 'col-md-12',
                'validate' => "",
                'id' => '',
                'required' => false,
                'readonly' => false,
                'disabled' => false,
                'path' => 'uploads/invoice/',
                'filetype' => 'file',
                'format' => 'file'
            ),
        );



        $this->datatable = array(
            'table' => $this->table,
            'select' => array(
                $this->table.'.*',
                'current.current_name as current_name',
            ),
            'join' => array(
                array('current', 'invoice.current_id', '=', 'current.id','Left')
            ),
            'rows' => array(
                array('title' => 'ID','row' => 'id','type' => 'text'),
                array('title' => 'Cari','row' => 'current_name','type' => 'text'),
                array('title' => 'Fatura No','row' => 'invoice_id','type' => 'text'),
                array('title' => 'Fatura Tutarı','row' => 'amount','type' => 'money'),
                array('title' => 'Fatura Tarihi','row' => 'invoice_date','type' => 'date'),
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


        return view($this->page.'::index',compact('page'));
    }

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
