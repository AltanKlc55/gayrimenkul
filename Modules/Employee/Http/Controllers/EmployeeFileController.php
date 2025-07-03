<?php

namespace Modules\Employee\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Modules\Current\Entities\CurrentType;
use Modules\Current\Entities\CurrentContract;
use Modules\Current\Entities\Branch;
use Modules\Admin\Entities\User;
use Modules\Current\Entities\Current;
use Modules\Employee\Entities\EmployeeFile;
use Modules\Employee\Entities\EmployeeLeave;
class EmployeeFileController extends Controller
{

    private $model;
    private $table = "employee_files";
    private $page = "employee::employee_file";
    private $routename= "employee_file";
    private $title;
    private $menu_id = 0;
    private $multilang = false;

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function __construct()
    {
        $this->model = EmployeeFile::class;
        $this->title = ___('Özlük Belgeleri');
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

        );
        $this->control = array(

        );
        $this->form  = array(

            array(
                'title' => 'Belge Adı',
                'name' => 'title',
                'type' => 'text',
                'class' => '',
                'grid' => 'col-md-4',
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
                'title' => 'Belge Tarihi',
                'name' => 'contract_date',
                'type' => 'date',
                'entry' => date('Y-m-d'),
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
                'title' => 'Belge Dosyası',
                'name' => 'contract_file',
                'type' => 'file',
                'class' => '',
                'grid' => 'col-md-4',
                'validate' => "",
                'id' => '',
                'required' => false,
                'readonly' => false,
                'disabled' => false,
                'path' => 'uploads/employee_file/',
                'filetype' => 'file',
                'format' => 'file'
            ),
            array(
                'title' => 'Note',
                'name' => 'note',
                'type' => 'textarea',
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
                'title' => 'Employee ID',
                'name' => 'employee_id',
                'type' => 'hidden',
                'class' => '',
                'value' => '',
                'grid' => 'col-md-8',
                'validate' => '',
                'id' => '',
                'multilang' => false,
                'attribute' => '',
                'required' => false,
                'readonly' => false,
                'disabled' => false,
                'format' => 'text'
            )
        );

        $this->datatable = array(
            'table' => $this->table,
            'select' => array(
                $this->table.'.*',
            ),
            'join' => array(
//                array('products_set', 'order.product', '=', 'products_set.id','Left')
            ),
            'rows' => array(
                array('title' => 'ID','row' => 'id','type' => 'text'),
                array('title' => 'Belge Adı','row' => 'title','type' => 'text'),
                array('title' => 'Belge Tarihi','row' => 'contract_date','type' => 'date'),
             //   array('title' => 'Son İşlem Tarihi','row' => 'updated_at','type' => 'date'),
//                array('title' => 'Kontroller','type' => 'control'),
                array('title' => 'İşlemler','type' => 'button'),
            )
        );
    }

    public function index($id)
    {


        $page['title'] = $this->title;
        $page['sub_title'] = $this->title;
        $page['table'] = route($this->routename.'.show');
        $page['tablerow'] = $this->datatable['rows'];
        $page['table_query'] = array('employee_id' => $id);
        $page['button'] = $this->button;
        $page['id'] = $id;
        $page['button'][] = array(
            'title' => 'Yeni Ekle',
            'id' => '',
            'class' => '',
            'type' => 'link', // button,link
            'icon' => '', // button,link
            'href' => route($this->routename.'.create',$id), // link ise gideceği sayfa
            'onclick' => '',
            'color' => 'primary'
        );


        return view($this->page.'.index',compact('page'));
    }

    public function create($id)
    {

        $page['title'] = $this->title.' -> Ekle';
        $page['action'] = route($this->routename.'.store');
        $page['id'] = $id;
        $page['form'] = $this->form;
        $page['form'][] = array(
            'title' => '',
            'name' => 'employee_id',
            'type' => 'hidden',
            'class' => '',
            'grid' => 'col-md-4',
            'validate' => 'required|max:255',
            'id' => '',
            'value' => $id,
            'multilang' => false,
            'attribute' => '',
            'required' => false,
            'readonly' => false,
            'disabled' => false,
            'format' => 'text'
        );
        $page['multilang'] = $this->multilang;
        return view($this->page.'.form',compact('page'));
    }

    public function store(Request $request)
    {

        if (request()->isMethod('POST')) {


            $this->form[] = array(
                'title' => '',
                'name' => 'employee_id',
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
                'format' => 'text'
            );

            // Bu alanda dizi içindeki elemanların validasyon kontrolleri yapoılmakta
            $validate = array();
            foreach ($this->form as $validate_control){
                if(isset($validate_control['validate']) and !empty($validate_control['validate'])){
                    $validate[$validate_control['name']] = $validate_control['validate'];
                }
            }
            if($validate){  $request->validate($validate); }

            $name = Str::slug(request('title'));


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

            return redirect(route($this->routename.'.index',$request->employee_id))->with('message', $message)->with('message_type', $status);

        }

    }

    public function show(Request $request)
    {
        $aColumns = array($this->datatable['table'].'.*');
        $iDisplayStart = $request->input('iDisplayStart', true);
        $iDisplayLength = $request->input('iDisplayLength', true);
        $sSearch = $request->input('search', true);
        $employee_id = $request->input('employee_id', true);

        $data['table']  = $this->datatable['table'];
        $data['select']  =$this->datatable['select'];
        $data['where']  =array(['employee_id',$employee_id]);
        $data['join']  =  $this->datatable['join'];

        $lists = dataTable($data,$iDisplayStart,$iDisplayLength,$sSearch,$aColumns);

        $output = array();
        $output['aaData'] = array();
        if ($lists) {
            foreach ($lists as $list) {
                $row = array();
                $iEdit = route($this->routename.'.edit',$list['id']);
                $iDestroy = route($this->routename.'.destroy',$list['id']);
                $iViewInvoice = url('uploads/employee_file',$list['contract_file']);



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
                $button .= '<a href="' . $iViewInvoice . '" target="_blank" class="btn btn-primary  btn-smsharp mr-1" title="Fatura" data-toggle="tooltip" >Belgeyi Görüntüle</a>';
                $button .= '<a href="' . $iEdit . '" target="_self" class="btn btn-primary  btn-smsharp mr-1" title="Düzenle" data-toggle="tooltip" ><i class="ri-edit-box-line"></i></a>';

                $button .= '<button type="button" class="btn btn-danger btn-smsharp mr-1 delete-btn" data-href="' . $iDestroy . '" title="Sil" data-toggle="tooltip">
                                <i class="ri-delete-bin-5-line"></i>
                            </button>';

//                $button .= '<a href="' . $iDestroy . '" target="_self" class="btn btn-danger  btn-smsharp mr-1" title="Sil" data-toggle="tooltip" ><i class="ri-delete-bin-5-line"></i></a>';



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


    public function edit($id)
    {
        $page['title'] = $this->title.' -> Düzenle';
        $page['action'] = route($this->routename.'.update',$id);
        $page['row'] = $this->model::find($id);
        $page['multilang'] = $this->multilang;
        $page['id'] = $id;

        $page['form'] = $this->form;




        return view($this->page.'.form',compact('page'));
    }

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

            $name = Str::slug(request('title'));
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
            return redirect(route($this->routename.'.index',$request->employee_id))
                ->with('message', $message)
                ->with('message_type', $status);

        }
    }

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
        return redirect()->back()
            ->with('message', $message)
            ->with('message_type', $status);
    }

}
