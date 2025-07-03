<?php

namespace Modules\Language\Http\Controllers;

use Modules\Language\Entities\Language;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    private $table = "language";
    private $title = "Dil Yönetimi";
    public function __construct()
    {
        $this->button = array(
            array(
                'title' => 'Yeni Ekle',
                'id' => '',
                'class' =>'',
                'type' => 'link', // button,link
                'icon' => '', // button,link
                'href' => route('language.create'), // link ise gideceği sayfa
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
        );
        $this->datatable = array(
            'table' => $this->table,
            'select' => $this->table.'.*',
            'join' => array(),
            'rows' => array(
                array('title' => 'ID','row' => 'id','type' => 'text'),
                array('title' => 'Başlık','row' => 'name','type' => 'text'),
                array('title' => 'Son İşlem Tarihi','row' => 'updated_at','type' => 'date'),
                array('title' => 'Kontroller','type' => 'control'),
                array('title' => 'İşlemler','type' => 'button'),
            )
        );
        $this->form  = array(
            array(
                'title' => 'Dil',
                'name' => 'name',
                'type' => 'text',
                'class' => '',
                'grid' => 'col-md-6',
                'validate' => 'required|min:2|max:255',
                'id' => '',
                'attribute' => '',
                'required' => true,
                'readonly' => false,
                'disabled' => false,
                'format' => 'text'
            ),  array(
                'title' => 'Direction',
                'name' => 'direction',
                'type' => 'select',
                'selected' => 'direction',
                'option' => [array('id' => 'ltr','name' => 'LTR'),array('id' => 'rtl','name' => 'RTL')],
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
            array(
                'name' => 'name',
                'type' => 'slug',
                'format' => 'slug'
            )
        );
    }
    public function index()
    {
        $page['title'] = $this->title.' -> Listesi';
        $page['table'] = route('language.show');
        $page['tablerow'] = $this->datatable['rows'];
        $page['button'] = $this->button;


        return view('language::index',compact('page'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $page['title'] = $this->title.' -> Ekle';
        $page['action'] = route('language.store');


        $page['form'] = $this->form;


        return view('language::form',compact('page'));
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


            $create = Language::create($data);

            if ($create) {

               $get_default = Language::where('default', 1)->first();
               if($get_default){
                   $default_lang_data = file_get_contents(resource_path('lang') . '/'.$get_default->slug.'_.json');
               } else {
                   $default_lang_data = file_get_contents(resource_path('lang') . '/default.json');
               }
                file_put_contents(resource_path('lang/') . $name . '_.json', $default_lang_data);


                $status = "success";
                $message = "İşlem Başarıyla Tamamlandı";
            } else {
                $status = "error";
                $message = "İşlem Sırasında Bir Hata Oluştu";
            }

            return redirect(route('language.index'))->with('message', $message)->with('message_type', $status);

        }

    }
    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show()
    {
        $lists = Language::orderByDesc('created_at')->get()->toArray();
        $output = array();
        $output['aaData'] = array();
        if ($lists) {
            foreach ($lists as $list) {
                $row = array();
                $iEdit = route('language.edit',$list['id']);
                $iLangs = route('language.edit_words',$list['slug']);
                $iDestroy = route('language.destroy',$list['id']);
                $iDefault = route('language.make_default',$list['id']);


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
                $default = ($list['default'] == 1) ? 'success' : 'btn-light';
                $button .= '<a href="' . $iDefault . '" target="_self" class="btn btn-'.$default.'  btn-smsharp mr-1" title="'.__('Default').'" data-toggle="tooltip" ><i class="las la-check-double"></i></a>';
                $button .= '<a href="' . $iEdit . '" target="_self" class="btn btn-primary  btn-smsharp mr-1" title="'.__('Edit').'" data-toggle="tooltip" ><i class="ri-edit-box-line"></i></a>';
                $button .= '<a href="' . $iLangs . '" target="_self" class="btn btn-dark  btn-smsharp mr-1" title="'.__('Adwords').'" data-toggle="tooltip" ><i class="las la-th-large"></i></a>';
                $button .= '<a href="' . $iDestroy . '" target="_self" class="btn btn-danger  btn-smsharp mr-1" title="'.__('Delete').'" data-toggle="tooltip" ><i class="ri-delete-bin-5-line"></i></a>';



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

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {

        $page['title'] = $this->title.' -> Düzenle';
        $page['action'] = route('language.update',$id);
        $page['row'] = Language::find($id);
        $page['form'] = $this->form;

        return view('language::form',compact('page'));
    }

    public function make_default(Request $request, $id)
    {
        Language::where('default', 1)->update(['default' => 0]);
        Language::find($id)->update(['default' => 1]);
        $lang = Language::find($id);
        $lang->default = 1;
        $lang->save();
        session()->put('lang', $lang->slug);
        return redirect()->back()->with([
            'msg' => __('Default Language Set To') . ' ' . $lang->name,
            'type' => 'success'
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $get_lang =Language::find($id);
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


            $entry = Language::where('id', $id)->firstOrFail();


            $update = $entry->update($data);

            if ($update) {
                $lang_file_path = resource_path('lang/') . $name .'_.json';
                if (!file_exists($lang_file_path)){
                    if(!file_exists(resource_path('lang/').$get_lang->slug.'_.json')){

                        file_put_contents(resource_path('lang/') . $name . '_.json', file_get_contents(resource_path('lang/').'default.json'));
                    } else {
                      $newlang =   file_put_contents(resource_path('lang/') . $name . '_.json', file_get_contents(resource_path('lang/').$get_lang->slug.'_.json'));

                      if($newlang){
                          $oldPath = resource_path('lang/'.$get_lang->slug.'_.json');  // Eski dosya yol ve adı
                          $newPath = storage_path('lang-backup/'.$get_lang->slug.'-'.date('Y-m-d-H-i-s').'_.json');  // Eski dosya yol ve adı


                          File::move($oldPath, $newPath);
                      }
                    }
                }

                $status = "success";
                $message = "İşlem Başarıyla Tamamlandı";
            } else {
                $status = "error";
                $message = "İşlem Sırasında Bir Hata Oluştu";
            }
            return redirect(route('language.index'))
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
        $destroy = Language::destroy($id);

        if ($destroy) {
            $status = "success";
            $message = "İşlem Başarıyla Tamamlandı";
        } else {
            $status = "error";
            $message = "İşlem Sırasında Bir Hata Oluştu";
        }

        return redirect(route('language.index'))
            ->with('message', $message)
            ->with('message_type', $status);
    }


    public function edit_words($slug)
    {
        $page['title'] = $this->title.' -> Düzenle';
        $all_word = file_get_contents(resource_path('lang/') . $slug . '_.json');
        return view('language::edit-words')->with([
            'all_word' => json_decode($all_word),
            'page' => $page,
            'lang_slug' => $slug,
            'type' => 'frontend'
        ]);
    }

    public function update_words(Request $request, $id)
    {
        $lang = Language::where('slug', $id)->first();
        $content = json_encode($request->word);
        if ($content === 'null') {
            return back()->with(['msg' => 'İşlem Sırasında Bir Hata Oluştu', 'type' => 'error']);
        }
        file_put_contents(resource_path('lang/') . $lang->slug .'_.json', $content);

        return back()->with(['msg' => 'İşlem Başarıyla Tamamlandı', 'type' => 'success']);
    }
    public function add_new_string(Request $request){
        $request->validate([
            'slug' => 'required',
            'string' => 'required',
            'translate_string' => 'required',
        ]);

        if (file_exists(resource_path('lang/') . $request->slug .'_.json')){
            $default_lang_data = file_get_contents(resource_path('lang').'/'.$request->slug .'_.json');
            $default_lang_data = (array) json_decode($default_lang_data);
            $default_lang_data[$request->string] = $request->translate_string;
            $default_lang_data = (object) $default_lang_data;
            $default_lang_data =   json_encode($default_lang_data);
            file_put_contents(resource_path('lang/') . $request->slug .'_.json', $default_lang_data);
        }

        return redirect()->back()->with([
            'msg' => "İşlem Başarıyla Gerçekleşti",
            'type' => 'success'
        ]);
    }
}