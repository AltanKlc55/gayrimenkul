<?php

namespace Modules\Content\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Menu\Entities\Menu;
use Modules\Content\Entities\Content;
use Illuminate\Support\Str;
class ContentController extends Controller
{
    private $table = "content";
    private $title;
    private $menu_id = 0;
    private $multilang = true;

    public function __construct()
    {
        $this->title = ___('Content');
        $this->button = array();
        $this->control = array(
            array(
                array(
                    'title' => 'Sitede Gizle',
                    'before' => 0,
                    'status' => 1,
                    'table' => $this->table,
                    'column' => 'status',
                    'icon' => 'fe fe-check-circle',
                    'class' => 'btn-dark'
                ),
                array(
                    'title' => 'Sitede Göster',
                    'before' => 1,
                    'status' => 0,
                    'table' => $this->table,
                    'column' => 'status',
                    'icon' => 'fe fe-check-circle',
                    'class' => 'btn-light'
                )
            ),
            array(

            )
        );
        $this->datatable = array(
            'table' => $this->table,
            'select' => $this->table.'.*',
            'join' => array(),
            'rows' => array(
                array('title' => 'ID','row' => 'id','type' => 'text'),
                array('title' => 'Başlık','row' => 'title','type' => 'multilang'),
                array('title' => 'Menü','row' => 'menu_id','type' => 'path'),
                array('title' => 'Son İşlem Tarihi','row' => 'updated_at','type' => 'date'),
                array('title' => 'Kontroller','type' => 'control'),
                array('title' => 'İşlemler','type' => 'button'),
            )
        );
        $this->form  = array(

            array(
                'title' => 'Sayfa Başlık',
                'name' => 'title',
                'type' => 'text',
                'class' => '',
                'grid' => 'col-md-4',
                'validate' => "",
                'id' => '',
                'attribute' => '',
                'multilang' => true,
                'required' => true,
                'readonly' => false,
                'disabled' => false,
                'format' => 'json'
            ),
            array(
                'title' => 'Seo Açıklama',
                'name' => 'description',
                'type' => 'text',
                'class' => '',
                'grid' => 'col-md-8',
                'validate' => "",
                'id' => '',
                'attribute' => '',
                'multilang' => true,
                'required' => false,
                'readonly' => false,
                'disabled' => false,
                'format' => 'json'
            ),
            array(
                'title' => 'Açıklama',
                'name' => 'single',
                'type' => 'textarea',
                'class' => '',
                'grid' => 'col-md-12',
                'validate' => "",
                'id' => '',
                'attribute' => '',
                'multilang' => true,
                'required' => false,
                'readonly' => false,
                'disabled' => false,
                'format' => 'json_none'
            ),
            array(
                'title' => 'Resim',
                'name' => 'image',
                'type' => 'file',
                'class' => '',
                'grid' => 'col-md-2',
                'validate' => "",
                'id' => '',
                'required' => false,
                'readonly' => false,
                'disabled' => false,
                'path' => 'uploads/content/',
                'filetype' => 'image',
                'format' => 'file'
            ),
            array(
                'title' => 'Resim 2',
                'name' => 'image2',
                'type' => 'file',
                'class' => '',
                'grid' => 'col-md-2',
                'id' => '',
                'validate' => "",
                'required' => false,
                'readonly' => false,
                'disabled' => false,
                'path' => 'uploads/content/',
                'filetype' => 'image',
                'format' => 'file'

            ),
            array(
                'title' => 'Resim 3',
                'name' => 'image3',
                'type' => 'file',
                'class' => '',
                'grid' => 'col-md-2',
                'id' => '',
                'validate' => "",
                'required' => false,
                'readonly' => false,
                'disabled' => false,
                'path' => 'uploads/content/',
                'filetype' => 'image',
                'format' => 'file'
            ),
            array(
                'title' => 'Resim 4',
                'name' => 'image4',
                'type' => 'file',
                'class' => '',
                'grid' => 'col-md-2',
                'id' => '',
                'validate' => "",
                'required' => false,
                'readonly' => false,
                'disabled' => false,
                'path' => 'uploads/content/',
                'filetype' => 'image',
                'format' => 'file'
            ),
            array(
                'title' => 'Resim 5',
                'name' => 'image5',
                'type' => 'file',
                'class' => '',
                'grid' => 'col-md-2',
                'id' => '',
                'validate' => "",
                'required' => false,
                'readonly' => false,
                'disabled' => false,
                'path' => 'uploads/content/',
                'filetype' => 'image',
                'format' => 'file'
            ),
            array(
                'name' => 'name',
                'type' => 'slug',
                'format' => 'slug'
            )
        );
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $page['title'] = $this->title.' -> Listesi';
        $page['table'] = route('content.show');
        $page['tablerow'] = $this->datatable['rows'];
        $page['button'] = $this->button;


        return view('content::index',compact('page'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create($id)
    {

        $page['title'] = $this->title.' -> Ekle';
        $page['action'] = route('content.store',$id);


        $page['form'] = $this->form;
        $page['multilang'] = $this->multilang;
        return view('content::form',compact('page'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store($id,Request $request)
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

            $name = Str::slug(get_image_name(request('title')));
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
            $data['menu_id'] = $id;

            $create = Content::create($data);

            if ($create) {
                $status = "success";
                $message = "İşlem Başarıyla Tamamlandı";
            } else {
                $status = "error";
                $message = "İşlem Sırasında Bir Hata Oluştu";
            }

            return redirect(route('content.index'))->with('message', $message)->with('message_type', $status);

        }

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show()
    {
        $lists = Content::orderByDesc('created_at')->get()->toArray();
        $output = array();
        $output['aaData'] = array();
        if ($lists) {
            foreach ($lists as $list) {
                $row = array();
                $iEdit = route('content.edit',$list['id']);
                $iDestroy = route('content.destroy',$list['id']);


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

                $row[] = $control;
                $row[] = $button;

                $output['aaData'][] = $row;

            }
        }

        return json_encode($output);
    }
    public function getParentsTree($menu, $name)
    {
        if ($menu['parent_id'] == null) {
            return $name;
        }

        $parent = Menu::find($menu['parent_id']);
        $name = getlanguage($parent['name'], get_language()) . ' > ' . $name;

        return $this->getParentsTree($parent, $name);
    }
    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $page['title'] = $this->title.' -> Düzenle';
        $page['action'] = route('content.update',$id);
        $page['row'] = Content::find($id);
        $page['form'] = $this->form;
        $page['multilang'] = $this->multilang;

        return view('content::form',compact('page'));
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

            $name = Str::slug(get_image_name(request('title')));
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


            $entry = Content::where('id', $id)->firstOrFail();


            $update = $entry->update($data);

            if ($update) {
                $status = "success";
                $message = "İşlem Başarıyla Tamamlandı";
            } else {
                $status = "error";
                $message = "İşlem Sırasında Bir Hata Oluştu";
            }
            return redirect(route('content.index'))
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
        $destroy = Content::destroy($id);

        if ($destroy) {
            $status = "success";
            $message = "İşlem Başarıyla Tamamlandı";
        } else {
            $status = "error";
            $message = "İşlem Sırasında Bir Hata Oluştu";
        }

        return redirect(route('content.index'))
            ->with('message', $message)
            ->with('message_type', $status);
    }
}