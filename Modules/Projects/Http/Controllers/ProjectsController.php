<?php

namespace Modules\Projects\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Modules\Projects\Entities\Projects;
use Modules\Current\Entities\Current;
use Modules\Admin\Entities\User;

class ProjectsController extends Controller
{

    private $model;
    private $table = "projects";
    private $page = "projects";
    private $routename= "project";
    private $title;
    private $menu_id = 0;
    private $multilang = false;

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function __construct(Request $request)
    {
        $this->current_id = $request->route('id');
        $this->model = Projects::class;
        $this->title = ___('İş Emirleri');
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
            array(
                array(
                    'title' => 'Devam Ediyor',
                    'before' => 0,
                    'status' => 1,
                    'table' => $this->table,
                    'column' => 'project_status',
                    'icon' => 'fe fe-check-circle',
                    'class' => 'btn-success'
                ),
                array(
                    'title' => 'Tamamlandı',
                    'before' => 1,
                    'status' => 0,
                    'table' => $this->table,
                    'column' => 'project_status',
                    'icon' => 'fe fe-check-circle',
                    'class' => 'btn-dark'
                )
            )
        );
        $this->form  = array(
            array(
                'title' => 'Cari',
                'name' => 'current_id',
                'type' => 'select',
                'child' => 'current_name',
                'option' =>  Current::get()->toArray(),
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
                'title' => 'Emir Başlığı',
                'name' => 'title',
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
                'title' => 'Emir Kodu',
                'name' => 'project_id',
                'type' => 'text',
                'value' => date('YmdHi'),
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
                'title' => ___('İş Emir Açıklaması'),
                'name' => 'project_note',
                'getname' => 'project_note',
                'type' => 'textarea',
                'class' => '',
                'grid' => 'col-md-6',
                'validate' => '',
                'id' => '',
                'attribute' => '',
                'required' => false,
                'readonly' => false,
                'disabled' => false,
                'format' => 'text'
            ),
            array(
                'title' => ___('İş Emri Saha Notları'),
                'name' => 'project_items',
                'getname' => 'project_items',
                'type' => 'textarea',
                'class' => '',
                'grid' => 'col-md-6',
                'validate' => '',
                'id' => '',
                'attribute' => '',
                'required' => false,
                'readonly' => false,
                'disabled' => false,
                'format' => 'text'
            ),


            array(
                'title' => 'İş Emri Yöneticisi',
                'name' => 'project_manager',
                'type' => 'select',
                'child' => 'username',
                'option' =>  User::all()->toArray(),
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
                'title' => 'İş Emri Durumu',
                'name' => 'status',
                'type' => 'select',
                'child' => 'title',
                'option' => get_definitions('project_status'),
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
                'title' => 'Başlama Tarihi',
                'name' => 'official_start',
                'type' => 'date',
                'entry' => date('Y-m-d'),
                'class' => '',
                'grid' => 'col-md-3',
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
                'title' => 'Bitiş Tarihi',
                'name' => 'official_end',
                'type' => 'date',
                'entry' => date('Y-m-d'),
                'class' => '',
                'grid' => 'col-md-3',
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
                'title' => 'Görevli Teknik Personel',
                'name' => 'project_persons',
                'type' => 'select_json',
                'child' => 'username', // Option name değeri
                'option' =>  User::all()->toArray(),
                'class' => 'select2',
                'grid' => 'col-md-12',
                'id' => '',
                'multiple' => true,
                'required' => false,
                'validate' => "",
                'readonly' => false,
                'disabled' => false,
                'format' => 'select_json'
            ),
        );




        $this->datatable = array(
            'table' => $this->table,
            'select' => array(
                $this->table.'.*',
                'current.current_name as current_name',
            ),
            'where' => array(
                array('projects.project_status', '=', 0)
            ),
            'join' => array(
                array('current', 'projects.current_id', '=', 'current.id','Left')
            ),
            'rows' => array(
                array('title' => 'ID','row' => 'id','type' => 'text'),
                array('title' => 'Cari','row' => 'current_name','type' => 'text'),
                array('title' => 'Emir Kodu','row' => 'project_id','type' => 'text'),
                array('title' => 'Emir Başlık','row' => 'title','type' => 'text'),
                array('title' => 'Emir Sorumlusu','row' => 'project_manager','type' => 'project_manager'),
                //array('title' => 'Kalan Gün','row' => 'official_end','type' => 'remaining_day'),
                array('title' => 'Emir Durumu','row' => 'status','type' => 'project_status'),
                array('title' => 'Kontroller','type' => 'control'),
                array('title' => 'İşlemler','type' => 'button'),
            )
        );

        $this->datatable_finished = array(
            'table' => $this->table,
            'select' => array(
                $this->table.'.*',
                'current.current_name as current_name',
            ),
            'where' => array(
                array('projects.project_status', '=', 1)
            ),
            'join' => array(
                array('current', 'projects.current_id', '=', 'current.id','Left')
            ),
            'rows' => array(
                array('title' => 'ID','row' => 'id','type' => 'text'),
                array('title' => 'Cari','row' => 'current_name','type' => 'text'),
                array('title' => 'Proje Kodu','row' => 'project_id','type' => 'text'),
                array('title' => 'Proje Başlık','row' => 'title','type' => 'text'),
                array('title' => 'Proje Sorumlusu','row' => 'project_manager','type' => 'project_manager'),
                array('title' => 'Proje Durumu','row' => 'status','type' => 'project_status'),
                array('title' => 'Kontroller','type' => 'control'),
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

    public function finished()
    {


        $page['title'] = $this->title;
        $page['table'] = route($this->routename.'.show2');
        $page['tablerow'] = $this->datatable_finished['rows'];
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
        $current_id = $request->input('current_id');
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

            return redirect(route('project.index',$current_id))->with('message', $message)->with('message_type', $status);

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
        $data['where']  = $this->datatable['where'];
        $data['join']  =  $this->datatable['join'];

        $lists = dataTable($data,$iDisplayStart,$iDisplayLength,$sSearch,$aColumns);

        $output = array();
        $output['aaData'] = array();
        if ($lists) {
            foreach ($lists as $list) {
                $row = array();
                $iPerson = route('current_person.index',$list['id']);
                $iAddress = route('current_address.index',$list['id']);
                $iEdit = route($this->routename.'.edit',$list['id']);
                $iDestroy = route($this->routename.'.destroy',$list['id']);





                $control = "";

                foreach ($this->control as $item){
                    foreach ($item as $value){
                        if($list[$value['column']] == $value['before']){
                            $control .= '<button  title="'.$value['title'].'"  data-toggle="tooltip" data-id="'.$list['id'].'" data-status="'.$value['status'].'" data-table="'.$value['table'].'"  data-column="'.$value['column'].'"  onclick="ColumnUpdate(this)"  class="btn  '.$value['class'].'  btn-smsharp mr-1 status_update"><i class="'.$value['icon'].'"> '.$value['title'].'</i></button>';
                        }
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
                            $row[] = currency($list[$item['row']],$list['currency']);
                            break;

                        case 'get_definition':
                            $row[] =  get_definition($list[$item['row']]);
                            break;
                        case 'remaining_day':
                            $row[] =  remaining_day($list[$item['row']]);
                            break;
                        case 'multilang':
                            $row[] =getlanguage($list[$item['row']],get_language());
                            break;
                        case 'project_manager':
                            $row[] = (User::find($list[$item['row']]) ? User::find($list[$item['row']])->username : ___('Sorumlu atanmamış'));
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
        $aColumns = array($this->datatable_finished['table'].'.*');
        $iDisplayStart = $request->input('iDisplayStart', true);
        $iDisplayLength = $request->input('iDisplayLength', true);
        $sSearch = $request->input('search', true);

        $data['table']  = $this->datatable_finished['table'];
        $data['select']  =$this->datatable_finished['select'];
        $data['where']  =$this->datatable_finished['where'];
        $data['join']  =  $this->datatable_finished['join'];

        $lists = dataTable($data,$iDisplayStart,$iDisplayLength,$sSearch,$aColumns);

        $output = array();
        $output['aaData'] = array();
        if ($lists) {
            foreach ($lists as $list) {
                $row = array();
                $iPerson = route('current_person.index',$list['id']);
                $iAddress = route('current_address.index',$list['id']);
                $iEdit = route($this->routename.'.edit',$list['id']);
                $iDestroy = route($this->routename.'.destroy',$list['id']);



                $control = "";

                foreach ($this->control as $item){
                    foreach ($item as $value){
                        if($list[$value['column']] == $value['before']){
                            $control .= '<button  title="'.$value['title'].'"  data-toggle="tooltip" data-id="'.$list['id'].'" data-status="'.$value['status'].'" data-table="'.$value['table'].'"  data-column="'.$value['column'].'"  onclick="ColumnUpdate(this)"  class="btn  '.$value['class'].'  btn-smsharp mr-1 status_update"><i class="'.$value['icon'].'"> '.$value['title'].'</i></button>';
                        }
                    }
                }

                $button = "";
                $button .= '<a href="' . $iEdit . '" target="_self" class="btn btn-primary  btn-smsharp mr-1" title="Düzenle" data-toggle="tooltip" ><i class="ri-edit-box-line"></i></a>';
                $button .= '<a href="' . $iDestroy . '" target="_self" class="btn btn-danger  btn-smsharp mr-1" title="Sil" data-toggle="tooltip" ><i class="ri-delete-bin-5-line"></i></a>';



                foreach ($this->datatable_finished['rows'] as $item){
                    switch ($item['type']){
                        case 'text':
                            $row[] = $list[$item['row']];
                            break;
                        case 'money':
                            $row[] = currency($list[$item['row']],$list['currency']);
                            break;
                        case 'kdvdahil':
                            $kdv =  (get_definition($list['vat'],'value')/100);
                            $row[] = currency(($list[$item['row']] * (1+$kdv)),$list['currency']);
                            break;
                        case 'project_status':
                            $row[] =  get_definition($list[$item['row']]);
                            break;
                        case 'remaining_day':
                            $row[] =  remaining_day($list[$item['row']]);
                            break;
                        case 'multilang':
                            $row[] =getlanguage($list[$item['row']],get_language());
                            break;
                        case 'project_manager':
                            $row[] = (User::find($list[$item['row']]) ? User::find($list[$item['row']])->username : ___('Sorumlu atanmamış'));
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
        $current_id = $request->input('current_id');
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
            return redirect(route('project.index'))
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
        $entry = $this->model::where('id', $id)->firstOrFail();
        $destroy = $this->model::destroy($id);

        if ($destroy) {
            $status = "success";
            $message = "İşlem Başarıyla Tamamlandı";
        } else {
            $status = "error";
            $message = "İşlem Sırasında Bir Hata Oluştu";
        }
        return redirect(route('project.index'))
            ->with('message', $message)
            ->with('message_type', $status);
    }

}
