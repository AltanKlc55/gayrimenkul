<?php

namespace Modules\Admin\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admin\Entities\User;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    private $table = "user";
    private $title;

    public function __construct()
    {
        $this->title = ___('Management');
        $this->button = array(
            array(
                'title' => ___('Add New'),
                'id' => '',
                'class' =>'',
                'type' => 'link', // button,link
                'icon' => '', // button,link
                'href' => route('admin.create'), // link ise gideceği sayfa
                'onclick' =>'',
                'color' =>'primary'
            ),
        );
        $this->control = array(

        );
        $this->datatable = array(
            'table' => $this->table,
            'select' => $this->table.'.*',
            'join' => array(),
            'rows' => array(
                array('title' => 'ID','row' => 'id','type' => 'text'),
                array('title' => ___('User Name'),'row' => 'username','type' => 'text'),
                array('title' => 'e-Mail','row' => 'email','type' => 'text'),
                array('title' => ___('Last Process Date'),'row' => 'updated_at','type' => 'date'),
                array('title' => ___('Controls'),'type' => 'button'),
            )
        );
        $this->form  = array(
            array(
                'title' =>  ___('User Name'),
                'name' => 'username',
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
                'title' => 'e-Mail',
                'name' => 'email',
                'type' => 'text',
                'class' => '',
                'grid' => 'col-md-3',
                'validate' => "",
                'id' => '',
                'attribute' => '',
                'required' => true,
                'readonly' => false,
                'disabled' => false,
                'format' => 'text'
            ),
            array(
                'title' => ___('Password'),
                'name' => 'password',
                'type' => 'password',
                'class' => '',
                'grid' => 'col-md-3',
                'validate' => 'required|min:8|max:255',
                'id' => '',
                'attribute' => '',
                'required' => true,
                'readonly' => false,
                'disabled' => false,
                'format' => 'password'
            ),
            array(
                'title' => ___('Profile Image'),
                'name' => 'image',
                'type' => 'file',
                'class' => '',
                'grid' => 'col-md-3',
                'validate' => "",
                'id' => '',
                'required' => false,
                'readonly' => false,
                'disabled' => false,
                'path' => 'uploads/manager/',
                'filetype' => 'image',
                'format' => 'file'
            )
        );
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    public function index()
    {
        $page['title'] = $this->title.' | '.___('List');
        $page['table'] = route('admin.show');
        $page['tablerow'] = $this->datatable['rows'];
        $page['button'] = $this->button;

        return view('admin::index',compact('page'));
    }
    

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {

        $page['title'] = $this->title.' | '.___('Add');
        $page['action'] = route('admin.store');


        $page['form'] = $this->form;
        return view('admin::form',compact('page'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
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
                        case 'password':
                        $data[$validate_control['name']] = Hash::make(request($validate_control['name']));
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


            $create = User::create($data);

            if ($create) {
                $status = "success";
                $message = ___("Transaction Completed Successfully");
            } else {
                $status = "error";
                $message = ___("An error occurred during the operation");
            }

            return redirect(route('admin.index'))->with('message', $message)->with('message_type', $status);

        }

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show()
    {
        $lists = User::orderByDesc('created_at')->get()->toArray();
        $output = array();
        $output['aaData'] = array();
        if ($lists) {
            foreach ($lists as $list) {
                $row = array();
                $iEdit = route('admin.edit',$list['id']);
                $iDestroy = route('admin.destroy',$list['id']);


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

                if($control){
                    $row[] = $control;
                }
                if($button){
                    $row[] = $button;
                }

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
        $page['title'] = $this->title.' | '.___('Edit');
        $page['action'] = route('admin.update',$id);
        $page['row'] = User::find($id);
        $page['form'] = $this->form;
        return view('admin::form',compact('page'));
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


            $entry = User::where('id', $id)->firstOrFail();


            $update = $entry->update($data);

            if ($update) {
                $status = "success";
                $message = ___("Transaction Completed Successfully");
            } else {
                $status = "error";
                $message = ___("An error occurred during the operation");
            }
            return redirect(route('admin.index'))
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
        $destroy = User::destroy($id);

        if ($destroy) {
            $status = "success";
            $message = ___("Transaction Completed Successfully");
        } else {
            $status = "error";
            $message = ___("An error occurred during the operation");
        }

        return redirect(route('admin.index'))
            ->with('message', $message)
            ->with('message_type', $status);
    }
}