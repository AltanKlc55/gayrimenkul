<?php

namespace Modules\Pos\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


use Modules\Pos\Entities\Pos;
use Illuminate\Support\Str;

class PosController extends Controller
{
    private $model;
    private $table = "pos";
    private $page = "pos";
    private $routename= "pos";
    private $title;
    private $multilang = false;




    public function __construct()
    {
        $this->model = Pos::class;
        $this->title = ___('Kredi Kart');

        $this->button = array(

        );

        $this->control = array(

        );
        $this->datatable = array(
            'table' => $this->table,
            'select' => $this->table.'.*',
            'join' => array(),
            'rows' => array(
                array('title' => 'ID','row' => 'id','type' => 'text'),
                array('title' => 'Başlık','row' => 'name','type' => 'text'),
                array('title' => 'İşlemler','type' => 'button'),
            )
        );
        $this->form  = array(

            array(
                'title' => 'Pos Adı',
                'name' => 'name',
                'type' => 'text',
                'class' => '',
                'grid' => 'col-md-6',
                'validate' => 'required|max:255',
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
        $page['table'] = route($this->routename.'.show');
        $page['tablerow'] = $this->datatable['rows'];
        $page['button'] = $this->button;



        return view($this->page.'::pos.index',compact('page'));
    }

    public function installment()
    {

        $page['title'] = $this->title.' -> Listesi';
        $page['table'] = route($this->routename.'.show');
        $page['tablerow'] = $this->datatable['rows'];
        $page['button'] = $this->button;
        $page['action'] = route($this->routename.'.store');
        $page['form'] = $this->repeater;


        return view($this->page.'::pos.installment',compact('page'));
    }
    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $page['title'] = $this->title.' -> Ekle';
        $page['action'] = route($this->routename.'.store');
        $page['multilang'] = $this->multilang;


        $page['form'] = $this->form;

        return view($this->page.'::pos.form',compact('page'));

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


    public function show()
    {
        $lists = $this->model::orderByDesc('created_at')->get()->toArray();
        $output = array();
        $output['aaData'] = array();
        if ($lists) {
            foreach ($lists as $list) {
                $row = array();
                $iEdit = route($this->routename.'.edit',$list['id']);
                $iCard = route('creditcard.index',$list['id']);
                $iDestroy = route($this->routename.'.destroy',$list['id']);




                $control = "";

                foreach ($this->control as $item){
                    foreach ($item as $value){
                        if($list[$value['column']] == $value['before']){
                            $control .= '<button  title="'.$value['title'].'"  data-toggle="tooltip" data-id="'.$list['id'].'" data-status="'.$value['status'].'" data-table="'.$value['table'].'"  data-column="'.$value['column'].'"  onclick="ColumnUpdate(this)"  class="btn  '.$value['class'].'  btn-smsharp mr-1 status_update"><i class="'.$value['icon'].'"></i></button>';
                        }
                    }
                }


                $button = "";
                //$button .= '<a href="' . $iEdit . '" target="_self" class="btn btn-primary  btn-smsharp mr-1" title="Düzenle" data-toggle="tooltip" ><i class="ri-edit-box-line"></i></a>';
                $button .= '<a href="' . $iCard . '" target="_self" class="btn btn-dark  btn-smsharp mr-1" title="'.___('Credit Card').'" data-toggle="tooltip" ><i class="las la-th-large"></i></a>';
                //$button .= '<a href="' . $iDestroy . '" target="_self" class="btn btn-danger  btn-smsharp mr-1" title="Sil" data-toggle="tooltip" ><i class="ri-delete-bin-5-line"></i></a>';


                foreach ($this->datatable['rows'] as $item){
                    switch ($item['type']){
                        case 'text':
                            $row[] = $list[$item['row']];
                            break;
                        case 'multilang':
                            $row[] =getlanguage($list[$item['row']],get_language());
                            break;
                        case 'path':
                            $row[] = $this->getParentsTree($list,getlanguage($list['name'],get_language()));
                            break;
                        case 'date':
                            $row[] = date('Y-m-d H:i',strtotime($list[$item['row']]));
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
        return view($this->page.'::pos.form',compact('page'));

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