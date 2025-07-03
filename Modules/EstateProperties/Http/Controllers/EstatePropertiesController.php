<?php

namespace Modules\EstateProperties\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\EstateProperties\Entities\EstateProperties;

class EstatePropertiesController extends Controller
{
    private $table = "tbl_ilan_ozellik_kategori";
    private $title = "Özellik";

    public function __construct()
    {
        $this->button = array(
            array(
                'title' => 'Yeni Ekle',
                'id' => '',
                'class' => '',
                'type' => 'link',
                'icon' => '',
                'href' => route('estateproperties.create'),
                'onclick' => '',
                'color' => 'primary'
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
                array(
                    'title' => 'Listelemede Gizle',
                    'before' => 0,
                    'status' => 1,
                    'table' => $this->table,
                    'column' => 'listening',
                    'icon' => 'fe fe-check-circle',
                    'class' => 'btn-dark'
                ),
                array(
                    'title' => 'Listelemede Göster',
                    'before' => 1,
                    'status' => 0,
                    'table' => $this->table,
                    'column' => 'listening',
                    'icon' => 'fe fe-check-circle',
                    'class' => 'btn-light'
                )
            )
        );
        $this->datatable = array(
            'table' => $this->table,
            'select' => $this->table . '.*',
            'join' => array(),
            'rows' => array(
                array('title' => 'ID', 'row' => 'id', 'type' => 'text'),
                array('title' => 'Kategori Adı', 'row' => 'category_name', 'type' => 'text'),
                array('title' => 'Kategori Görseli', 'row' => 'category_icon', 'type' => 'text'),
                array('title' => 'Son İşlem Tarihi', 'row' => 'updated_at', 'type' => 'date'),
                array('title' => 'İşlemler', 'type' => 'button'),
            )
        );
        $this->form = array(
            array(
                'title' => 'Özellik Adı',
                'name' => 'category_name',
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
                'title' => 'Özellik İkonu',
                'name' => 'category_icon',
                'type' => 'file',
                'class' => '',
                'grid' => 'col-md-3',
                'validate' => "",
                'id' => '',
                'required' => false,
                'readonly' => false,
                'disabled' => false,
                'path' => 'uploads/properties/',
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
     * @return Renderable
     */

    public function index()
    {
        $page['title'] = 'Özellilk -> Listesi';
        $page['table'] = route('estateproperties.show');
        $page['tablerow'] = $this->datatable['rows'];
        $page['button'] = $this->button;


        return view('estateproperties::index', compact('page'));
    }

    public function create()
    {
        $page['title'] = $this->title . ' -> Ekle';
        $page['action'] = route('estateproperties.store');
        $page['form'] = $this->form;
        return view('estateproperties::form', compact('page'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        if ($request->hasFile('category_icon')) {
            $data['category_name'] = $request->input('category_name');
            $image = $request->file('category_icon');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/properties'), $imageName);
            $data['category_icon'] = $imageName;
            $create = EstateProperties::create($data);
            if ($create) {
                return redirect(route('estateproperties.index'))
                    ->with('message', 'İşlem Başarıyla Tamamlandı')
                    ->with('message_type', 'success');
            } else {
                return redirect(route('estateproperties.create'))
                    ->with('message', 'İşlem Sırasında Bir Hata Oluştu')
                    ->with('message_type', 'error');
            }
        } else {
            return redirect(route('estateproperties.create'))
                ->with('message', 'Dosya yüklenmedi, lütfen bir dosya seçin!')
                ->with('message_type', 'error');
        }
    }

    /**
     * @param int $id
     * @return Renderable
     */
    public function show()
    {
        $lists = EstateProperties::orderByDesc('created_at')->get()->toArray();
        $output = array();
        $output['aaData'] = array();
        if ($lists) {
            foreach ($lists as $list) {
                $row = array();
                $iEdit = route('estateproperties.edit', $list['id']);
                $iDestroy = route('estateproperties.destroy', $list['id']);
                $button = "";
                $button .= '<a href="' . $iEdit . '" target="_self" class="btn btn-primary  btn-smsharp mr-1" title="Düzenle" data-toggle="tooltip" ><i class="ri-edit-box-line"></i></a>';
                $button .= '<a href="' . $iDestroy . '" target="_self" class="btn btn-danger  btn-smsharp mr-1" title="Sil" data-toggle="tooltip" ><i class="ri-delete-bin-5-line"></i></a>';
                foreach ($this->datatable['rows'] as $item) {
                    switch ($item['type']) {
                        case 'text':
                            $row[] = $list[$item['row']];
                            break;
                        case 'path':
                            $row[] = $this->getParentsTree($list, $list['name']);
                            break;
                        case 'date':
                            $row[] = date('Y-m-d H:i', strtotime($list[$item['row']]));
                            break;
                    }
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
        $page['title'] = $this->title . ' -> Düzenle';
        $page['action'] = route('estateproperties.update', $id);
        $page['row'] = EstateProperties::find($id);
        $page['form'] = $this->form;
        return view('estateproperties::form', compact('page'));
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
            if ($request->hasFile('category_icon')){
                $data['category_name'] = $request->input('category_name');
                $data['id'] = $request->input('id');
                $image = $request->file('category_icon');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/properties'), $imageName);
                $data['category_icon'] = $imageName;
                $entry = EstateProperties::where('id', $id)->first();
                $update = $entry->update($data);
                if ($update) {
                    return redirect(route('estateproperties.index'))
                        ->with('message', 'İşlem Başarıyla Tamamlandı')
                        ->with('message_type', 'success');
                } else {
                    return redirect(route('estateproperties.create'))
                        ->with('message', 'İşlem Sırasında Bir Hata Oluştu')
                        ->with('message_type', 'error');
                }
            } else {
                $data['category_name'] = $request->input('category_name');
                $data['id'] = $request->input('id');
                $data['category_icon'] = $request->input('old_photo');
                $entry = EstateProperties::where('id', $id)->first();
                $update = $entry->update($data);
                if ($update) {
                    return redirect(route('estateproperties.index'))
                        ->with('message', 'İşlem Başarıyla Tamamlandı')
                        ->with('message_type', 'success');
                } else {
                    return redirect(route('estateproperties.create'))
                        ->with('message', 'İşlem Sırasında Bir Hata Oluştu')
                        ->with('message_type', 'error');
                }
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $destroy = EstateProperties::destroy($id);

        if ($destroy) {
            $status = "success";
            $message = "İşlem Başarıyla Tamamlandı";
        } else {
            $status = "error";
            $message = "İşlem Sırasında Bir Hata Oluştu";
        }

        return redirect(route('estateproperties.index'))
            ->with('message', $message)
            ->with('message_type', $status);
    }
}