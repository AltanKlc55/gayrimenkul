<?php

namespace Modules\Page\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Page\Entities\Page;
use Illuminate\Support\Str;
class PageController extends Controller
{

    private $table = "page";
    private $title = "Sayfalar ";
    function __construct()
    {

        $pageTypes = [
            1 => 'Hakkımızda',
            2 => 'İletişim',
            3 => 'Hizmetler',
            4 => 'Referanslar'
        ];

        $this->button = array(
            array(
                'title' => 'Yeni Ekle',
                'id' => '',
                'class' =>'',
                'type' => 'link', // button,link
                'icon' => '', // button,link
                'href' => route('page.create'), // link ise gideceği sayfa
                'onclick' =>'',
                'color' =>'primary'
            ),
        );
        $this->control = array(
            array(
                array(
                    'title' => 'Pasif Yap',
                    'before' => 0,
                    'status' => 1,
                    'table' => $this->table,
                    'column' => 'status',
                    'icon' => 'fe fe-check-circle',
                    'class' => 'btn-dark'
                ),
                array(
                    'title' => 'Aktif Yap',
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
                array('title' => 'Sayfa Adı','row' => 'name','type' => 'text'),
                array('title' => 'Sayfa Url','row' => 'slug','type' => 'text'),
                array('title' => 'Son İşlem Tarihi','row' => 'updated_at','type' => 'date'),
                array('title' => 'Kontroller','type' => 'control'),
                array('title' => 'İşlemler','type' => 'button'),
            )
        );
        $this->form  = array(
            array(
                'title' => 'Sayfa Adı',
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
                'title' => 'Seo Tile',
                'name' => 'title',
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
                'title' => 'Keywords',
                'name' => 'keywords',
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
                'title' => 'Sayfa Türü',
                'name' => 'page_type',
                'type' => 'select',
                'child' => 'title',
                'entry' => 4,
                'option' => array(
                  ['id' => 'hizmetler', 'title' => 'Hizmetler'],
                  ['id' => 'projeler', 'title' => 'Projeler'],
                  ['id' => 'hakkimizda', 'title' => 'Hakkımızda'],
                  ['id' => 'bloglar', 'title' => 'Bloglar'],
                  ['id' => 'iletisim', 'title' => 'İletişim'],
                  ['id' => 'referanslar', 'title' => 'Referanslar']
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
                'title' => 'Sayfa Yapısı',
                'name' => 'page_parent',
                'type' => 'select',
                'child' => 'title',
                'entry' => 4,
                'option' => array(
                  ['id' => 0, 'title' => 'Üst Sayfa'],
                  ['id' => 1, 'title' => 'İçerik Sayfası']
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
                'title' => 'Açıklama',
                'name' => 'description',
                'type' => 'textarea',
                'class' => '',
                'grid' => 'col-12',
                'id' => '',
                'validate' => "",
                'attribute' => '',
                'required' => true,
                'readonly' => false,
                'disabled' => false,
                'format' => 'none'
            ),
            array(
                'title' => 'Resim',
                'name' => 'image',
                'type' => 'file',
                'class' => '',
                'grid' => 'col-md-6',
                'validate' => "",
                'id' => '',
                'required' => false,
                'readonly' => false,
                'disabled' => false,
                'path' => 'uploads/page/',
                'filetype' => 'image',
                'format' => 'file'
            ),
            array(
                'title' => 'Banner',
                'name' => 'banner',
                'type' => 'file',
                'class' => '',
                'grid' => 'col-md-6',
                'validate' => "",
                'id' => '',
                'required' => false,
                'readonly' => false,
                'disabled' => false,
                'path' => 'uploads/page/',
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
        $page['table'] = route('page.show');
        $page['tablerow'] = $this->datatable['rows'];
        $page['button'] = $this->button;
        return view('page::index',compact('page'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $page['title'] = $this->title.' -> Ekle';
        $page['action'] = route('page.store');
        $page['form'] = $this->form;
        return view('page::form',compact('page'));
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
            foreach ($this->form as $validate_control) {
                if (isset($validate_control['validate']) and !empty($validate_control['validate'])) {
                    $validate[$validate_control['name']] = $validate_control['validate'];
                }
            }
            if ($validate) {
                $request->validate($validate);
            }

            $name = Str::slug(request('title'));
            foreach ($this->form as $key => $validate_control) {
                switch ($validate_control['format']) {
                    case 'text':
                        $data[$validate_control['name']] = request($validate_control['name']);
                        break;
                    case 'json':
                        $data[$validate_control['name']] = json_encode(request($validate_control['name']), true);
                        break;
                    case 'none':
                        $data[$validate_control['name']] = $request->input($validate_control['name']);
                        break;
                    case 'select':
                        $data[$validate_control['name']] = request($validate_control['name']) ? request($validate_control['name']) : 0;
                        break;
                    case 'file':
                        if (request()->hasFile($validate_control['name'])) {
                            $image = request()->file($validate_control['name']);
                            $imageName = $name . $key . '.' . $image->extension();
                            $image->move(public_path('./' . $validate_control['path']), $imageName);
                            $data[$validate_control['name']] = $imageName;
                        }
                        break;
                }
            }


            $create = Page::create($data);

            if ($create) {
                $status = "success";
                $message = "İşlem Başarıyla Tamamlandı";
            } else {
                $status = "error";
                $message = "İşlem Sırasında Bir Hata Oluştu";
            }

            return redirect(route('page.index'))->with('message', $message)->with('message_type', $status);

        }

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show()
    {

        $lists = Page::orderByDesc('created_at')->get()->toArray();

        $output = array();
        $output['aaData'] = array();
        if ($lists) {
            foreach ($lists as $list) {
                $row = array();
                $iEdit = route('page.edit',$list['id']);
                $iDestroy = route('page.destroy',$list['id']);


                $control = "";

                foreach ($this->control as $item){
                    foreach ($item as $value){
                        if($list[$value['column']] == $value['before']){
                            $control .= '<button  title="'.$value['title'].'"  data-toggle="tooltip" data-id="'.$list['id'].'" data-status="'.$value['status'].'" data-table="'.$value['table'].'"  data-column="'.$value['column'].'"  onclick="ColumnUpdate(this)"  class="btn  '.$value['class'].'  btn-smsharp mr-1 status_update"><i class="'.$value['icon'].'"></i></button>';
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
        $page['title'] = $this->title . ' -> Düzenle';
        $page['action'] = route('page.update', $id);
        $page['row'] = Page::find($id);
        $page['form'] = $this->form;
        return view('page::form', compact('page'));
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
            foreach ($this->form as $validate_control) {
                if (isset($validate_control['validate']) and !empty($validate_control['validate'])) {
                    $validate[$validate_control['name']] = $validate_control['validate'];
                }
            }
            if ($validate) {
                $request->validate($validate);
            }

            $name = Str::slug(request('title'));
            foreach ($this->form as $key => $validate_control) {
                switch ($validate_control['format']) {
                    case 'text':
                        $data[$validate_control['name']] = request($validate_control['name']);
                        break;
                    case 'json':
                        $data[$validate_control['name']] = json_encode(request($validate_control['name']), true);
                        break;
                    case 'none':
                        $data[$validate_control['name']] = $request->input($validate_control['name']);
                        break;
                    case 'select':
                        $data[$validate_control['name']] = request($validate_control['name']) ? request($validate_control['name']) : 0;
                        break;
                    case 'file':
                        if (request()->hasFile($validate_control['name'])) {
                            $image = request()->file($validate_control['name']);
                            $imageName = $name . $key . '.' . $image->extension();
                            $image->move(public_path('./' . $validate_control['path']), $imageName);
                            $data[$validate_control['name']] = $imageName;
                        }
                        break;
                }
            }


            $entry = Page::where('id', $id)->firstOrFail();


            $update = $entry->update($data);

            if ($update) {
                $status = "success";
                $message = "İşlem Başarıyla Tamamlandı";
            } else {
                $status = "error";
                $message = "İşlem Sırasında Bir Hata Oluştu";
            }
            return redirect(route('page.index'))
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
        $destroy = Page::destroy($id);

        if ($destroy) {
            $status = "success";
            $message = "İşlem Başarıyla Tamamlandı";
        } else {
            $status = "error";
            $message = "İşlem Sırasında Bir Hata Oluştu";
        }

        return redirect(route('page.index'))
            ->with('message', $message)
            ->with('message_type', $status);
    }
}
