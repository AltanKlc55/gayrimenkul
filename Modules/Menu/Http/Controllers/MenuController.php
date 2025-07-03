<?php

namespace Modules\Menu\Http\Controllers;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\Menu\Entities\Menu;
use Modules\Content\Entities\Content;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{

    private $table = "menu";
    private $title = "Menü";
    private $multilang = true;

    public function __construct()
    {
        $this->button = array(
            array(
                'title' => 'Yeni Ekle',
                'id' => '',
                'class' =>'',
                'type' => 'link', // button,link
                'icon' => '', // button,link
                'href' => route('menu.create'), // link ise gideceği sayfa
                'onclick' =>'',
                'color' =>'primary'
            ),
        );
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
                array('title' => 'Başlık','row' => 'name','type' => 'multilang'),
                array('title' => 'Seo Başlık','row' => 'title','type' => 'multilang'),
                array('title' => 'Yol','row' => 'title','type' => 'path'),
                array('title' => 'Son İşlem Tarihi','row' => 'updated_at','type' => 'date'),
                array('title' => 'Kontroller','type' => 'control'),
                array('title' => 'İşlemler','type' => 'button'),
            )
        );
        $this->form  = array(
            array(
                'title' => 'Üst Menü',
                'name' => 'parent_id',
                'type' => 'category',
                'option' => Menu::with("Children")->where(["parent_id" => 0])->get()->toArray(),
                'class' => 'select2',
                'grid' => 'col-md-12',
                'id' => '',
                'multiple' => false,
                'required' => false,
                'validate' => "",
                'readonly' => false,
                'disabled' => false,
                'format' => 'select'
            ),
            array(
                'title' => 'Menu Adı',
                'name' => 'name',
                'type' => 'text',
                'class' => '',
                'grid' => 'col-md-6',
                'validate' => 'required|min:2|max:255',
                'id' => '',
                'multilang' => true,
                'attribute' => '',
                'required' => true,
                'readonly' => false,
                'disabled' => false,
                'format' => 'json'
            ),
            array(
                'title' => 'Resim 1',
                'name' => 'image',
                'type' => 'checkbox',
                'class' => '',
                'grid' => 'col-md-6',
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
                'name' => 'name',
                'type' => 'slug',
                'format' => 'slug'
            )
        );

//      print_r(Auth::guard('manager')->user());

    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    public function index()
    {
        $page['title'] = $this->title.' -> Listesi';
        $page['table'] = route('menu.show');
        $page['tablerow'] = $this->datatable['rows'];
        $page['button'] = $this->button;



        return view('menu::index',compact('page'));
    }
    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {

        $page['title'] = $this->title.' -> Ekle';
        $page['action'] = route('menu.store');
        $page['multilang'] = $this->multilang;


        $page['form'] = $this->form;
        return view('menu::form',compact('page'));
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


            $create = Menu::create($data);

            if ($create) {
                $status = "success";
                $message = "İşlem Başarıyla Tamamlandı";
            } else {
                $status = "error";
                $message = "İşlem Sırasında Bir Hata Oluştu";
            }

            return redirect(route('menu.index'))->with('message', $message)->with('message_type', $status);

        }

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show()
    {
        $lists = Menu::orderByDesc('created_at')->get()->toArray();
        $output = array();
        $output['aaData'] = array();
        if ($lists) {
            foreach ($lists as $list) {
                $row = array();
                $iEdit = route('menu.edit',$list['id']);
                $iDestroy = route('menu.destroy',$list['id']);

                $content = Content::where('menu_id', $list['id'])->get()->first();
                if($content){
                    $iContent = route('content.edit',$content->id);
                } else {
                    $iContent = route('content.create',$list['id']);
                }


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
                $button .= '<a href="' . $iContent . '" target="_self" class="btn btn-success  btn-smsharp mr-1" title="İçerik Yönetimi" data-toggle="tooltip" ><i class="ri-edit-box-line"></i></a>';
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
                            $row[] = $this->getParentsTree($list,getlanguage($list['name'],get_language()));
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
        $page['action'] = route('menu.update',$id);
        $page['row'] = Menu::find($id);
        $page['multilang'] = $this->multilang;
        $page['form'] = $this->form;

      if(is_developer()){
          $page['form'][] =   array(
              'title' => ___('Image'),
              'name' => 'image',
              'type' => 'checkbox',
              'grid' => 'col-md-2',
              'attribute' => '',
              'required' => true,
              'readonly' => false,
              'disabled' => false,
              'format' => 'text'
          );
          $page['form'][] =   array(
              'title' => ___('Image').' 2',
              'name' => 'image2',
              'type' => 'checkbox',
              'grid' => 'col-md-2',
              'attribute' => '',
              'required' => true,
              'readonly' => false,
              'disabled' => false,
              'format' => 'text'
          );
          $page['form'][] =   array(
              'title' => ___('Image').' 3',
              'name' => 'image3',
              'type' => 'checkbox',
              'grid' => 'col-md-2',
              'attribute' => '',
              'required' => true,
              'readonly' => false,
              'disabled' => false,
              'format' => 'text'
          );
          $page['form'][] =   array(
              'title' => ___('Image').' 4',
              'name' => 'image4',
              'type' => 'checkbox',
              'grid' => 'col-md-2',
              'attribute' => '',
              'required' => true,
              'readonly' => false,
              'disabled' => false,
              'format' => 'text'
          );
          $page['form'][] =   array(
              'title' => ___('Image').' 5',
              'name' => 'image5',
              'type' => 'checkbox',
              'grid' => 'col-md-2',
              'attribute' => '',
              'required' => true,
              'readonly' => false,
              'disabled' => false,
              'format' => 'text'
          );
          $page['form'][] =   array(
              'title' => ___('Youtube'),
              'name' => 'youtube',
              'type' => 'checkbox',
              'grid' => 'col-md-2',
              'attribute' => '',
              'required' => true,
              'readonly' => false,
              'disabled' => false,
              'format' => 'text'
          );
          $page['form'][] =   array(
              'title' => ___('Price'),
              'name' => 'price',
              'type' => 'checkbox',
              'grid' => 'col-md-2',
              'attribute' => '',
              'required' => true,
              'readonly' => false,
              'disabled' => false,
              'format' => 'text'
          );
          $page['form'][] =   array(
              'title' => ___('File'),
              'name' => 'file',
              'type' => 'checkbox',
              'grid' => 'col-md-2',
              'attribute' => '',
              'required' => true,
              'readonly' => false,
              'disabled' => false,
              'format' => 'text'
          );
          $page['form'][] =   array(
              'title' => ___('File').' 2',
              'name' => 'file',
              'type' => 'checkbox',
              'grid' => 'col-md-2',
              'attribute' => '',
              'required' => true,
              'readonly' => false,
              'disabled' => false,
              'format' => 'text'
          );
          $page['form'][] =   array(
              'title' => ___('File').' 3',
              'name' => 'file',
              'type' => 'checkbox',
              'grid' => 'col-md-2',
              'attribute' => '',
              'required' => true,
              'readonly' => false,
              'disabled' => false,
              'format' => 'text'
          );
      }


        return view('menu::form',compact('page'));
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


            $entry = Menu::where('id', $id)->firstOrFail();


            $update = $entry->update($data);

            if ($update) {
                $status = "success";
                $message = "İşlem Başarıyla Tamamlandı";
            } else {
                $status = "error";
                $message = "İşlem Sırasında Bir Hata Oluştu";
            }
            return redirect(route('menu.index'))
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
        $destroy = Menu::destroy($id);

        if ($destroy) {
            $status = "success";
            $message = "İşlem Başarıyla Tamamlandı";
        } else {
            $status = "error";
            $message = "İşlem Sırasında Bir Hata Oluştu";
        }

        return redirect(route('menu.index'))
            ->with('message', $message)
            ->with('message_type', $status);
    }
}