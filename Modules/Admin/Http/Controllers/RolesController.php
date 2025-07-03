<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Support\Str;
use Modules\Admin\Entities\Roles;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class RolesController extends Controller
{
    private $table = "roles";
    private $title;

    public function __construct()
    {
         $this->title = ___('Permissions');

        $this->button = array(
            array(
                'title' => ___('Add Roles'),
                'id' => '',
                'class' =>'',
                'type' => 'link', // button,link
                'icon' => '', // button,link
                'href' => route('roles.create'), // link ise gideceği sayfa
                'onclick' =>'',
                'color' =>'primary'
            ),
        );
        $this->control = array(
            array(
                array(
                    'title' => ___('Disable'),
                    'before' => 0,
                    'status' => 1,
                    'table' => $this->table,
                    'column' => 'status',
                    'icon' => 'fe fe-check-circle',
                    'class' => 'btn-dark'
                ),
                array(
                    'title' => ___('Active'),
                    'before' => 1,
                    'status' => 0,
                    'table' => $this->table,
                    'column' => 'status',
                    'icon' => 'fe fe-check-circle',
                    'class' => 'btn-light'
                )
            ),
        );
        $this->datatable = array(
            'table' => $this->table,
            'select' => $this->table.'.*',
            'join' => array(),
            'rows' => array(
                array('title' => 'ID','row' => 'id','type' => 'text'),
                array('title' => ___('Title'),'row' => 'name','type' => 'text'),
                array('title' => ___('Last Process Date'),'row' => 'updated_at','type' => 'date'),
                array('title' => ___('Controls'),'type' => 'control'),
                array('title' => ___('Process'),'type' => 'button'),
            )
        );
        $this->form  = array(

            array(
                'title' => ___('Role Name'),
                'name' => 'name',
                'type' => 'text',
                'class' => '',
                'grid' => 'col-md-3',
                'validate' => 'required|min:2|max:255',
                'id' => '',
                'attribute' => '',
                'required' => true,
                'readonly' => false,
                'disabled' => false,
                'format' => 'text'
            ),
            array(
                'title' => ___('Security Name'),
                'name' => 'guard_name',
                'type' => 'select',
                'selected' => 'guard_name',
                'option' => [array('id' => 'web','name' => 'Web'),array('id' => 'api','name' => 'Api')],
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
                'name' => 'name',
                'type' => 'slug',
                'format' => 'slug'
            )
        );
    }
    public function index()
    {
        $page['title'] = $this->title.' | '.___('List');
        $page['table'] = route('roles.show');
        $page['tablerow'] = $this->datatable['rows'];
        $page['button'] = $this->button;


        return view('admin::index',compact('page'));

    }


    public function create()
    {
        $page['title'] = $this->title.' | '.___('Add');
        $page['action'] = route('roles.store');


        $page['form'] = $this->form;
        return view('admin::form',compact('page'));
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


            foreach ($this->form as $key => $validate_control){
                switch ($validate_control['format']){
                    case 'text':
                        $data[$validate_control['name']] = request($validate_control['name']);
                        break;
                    case 'json':
                        $data[$validate_control['name']] = json_encode(request($validate_control['name']),true);
                        break;
                    case 'none':
                        $data[$validate_control['name']] =  $request->input($validate_control['name']);
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


            $create = Roles::create($data);

            if ($create) {
                $status = "success";
                $message = ___("Transaction Completed Successfully");
            } else {
                $status = "error";
                $message = ___("An error occurred during the operation");
            }

            return redirect(route('roles.index'))->with('message', $message)->with('message_type', $status);

        }
    }



    public function show()
    {

        $lists = Roles::orderByDesc('id')->get()->toArray();

        $output = array();
        $output['aaData'] = array();
        if ($lists) {
            foreach ($lists as $list) {
                $row = array();
                $iEdit = route('roles.edit',$list['id']);
                $iPermissions = route('haspermission.index',$list['id']);
                $iDestroy = route('roles.destroy',$list['id']);
                $control = "";
                foreach ($this->control as $item){
                    foreach ($item as $value){
                        if($list[$value['column']] == $value['before']){
                            $control .= '<button  title="'.$value['title'].'"  data-toggle="tooltip" data-id="'.$list['id'].'" data-status="'.$value['status'].'" data-table="'.$value['table'].'"  data-column="'.$value['column'].'"  onclick="ColumnUpdate(this)"  class="btn  '.$value['class'].'  btn-smsharp mr-1 status_update"><i class="'.$value['icon'].'"></i></button>';
                        }
                    }
                }

                $button = "";
                $button .= '<a href="' . $iEdit . '" target="_self" class="btn btn-primary  btn-smsharp mr-1" title="'.___('Edit').'" data-toggle="tooltip" ><i class="ri-edit-box-line"></i></a>';
                $button .= '<a href="' . $iPermissions . '" target="_self" class="btn btn-dark  btn-smsharp mr-1" title="'.___('Permissions').'" data-toggle="tooltip" ><i class="ri-settings-line"></i></a>';
                $button .= '<a href="' . $iDestroy . '" target="_self" class="btn btn-danger  btn-smsharp mr-1" title="'.___('Delete').'" data-toggle="tooltip" ><i class="ri-delete-bin-5-line"></i></a>';

                foreach ($this->datatable['rows'] as $item){
                    switch ($item['type']){
                        case 'text':
                            $row[] = $list[$item['row']];
                            break;
                        case 'path':
                            $row[] = $this->getParentsTree($list,$list['name']);
                            break;
                        case 'date':
                            $row[] = date('Y-m-d H:i',strtotime($list[$item['row']]));
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



    public function edit($id)
    {
        $page['title'] = $this->title.' | '.___('Edit');
        $page['action'] = route('roles.update',$id);
        $page['row'] = Roles::find($id);
        $page['form'] = $this->form;
        return view('admin::form',compact('page'));
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

            foreach ($this->form as $key => $validate_control){
                switch ($validate_control['format']){
                    case 'text':
                        $data[$validate_control['name']] = request($validate_control['name']);
                        break;
                    case 'password':
                        if(request($validate_control['name'])){
                            $data[$validate_control['name']] = Hash::make(request($validate_control['name']));
                        }
                        break;
                    case 'json':
                        $data[$validate_control['name']] = json_encode(request($validate_control['name']),true);
                        break;
                    case 'none':
                        $data[$validate_control['name']] =  $request->input($validate_control['name']);
                        break;
                    case 'select':
                        $data[$validate_control['name']] = request($validate_control['name']) ? request($validate_control['name']): 0;
                        break;
                    case 'file':
                        if(request()->hasFile($validate_control['name'])){
                            $image = request()->file($validate_control['name']);
                            $imageName = time().$key.'.'.$image->extension();
                            $image->move(public_path('./'.$validate_control['path']), $imageName);
                            $data[$validate_control['name']] = $imageName;
                        }
                        break;
                }
            }


            $entry = Roles::where('id', $id)->firstOrFail();


            $update = $entry->update($data);

            if ($update) {
                $status = "success";
                $message = ___("Transaction Completed Successfully");
            } else {
                $status = "error";
                $message = ___("An error occurred during the operation");
            }
            return redirect(route('roles.index'))
                ->with('message', $message)
                ->with('message_type', $status);

        }



    }



    public function destroy($id)
    {
        $destroy = Roles::destroy($id);

        if ($destroy) {
            $status = "success";
            $message = ___("Transaction Completed Successfully");
        } else {
            $status = "error";
            $message = ___("An error occurred during the operation");
        }

        return redirect(route('roles.index'))
            ->with('message', $message)
            ->with('message_type', $status);
    }


}