<?php

namespace Modules\Ilanlar\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Category\Entities\Category;
use Modules\EstateProperties\Entities\EstateProperties;
use Modules\Ilanlar\Entities\IlanModel;
use Storage;

class IlanlarController extends Controller
{
    private $table = "tbl_ilan";
    private $title = "İlanlar";

    public function __construct()
    {
        $this->button = array(
            array(
                'title' => 'Yeni Ekle',
                'id' => '',
                'class' => '',
                'type' => 'link',
                'icon' => '',
                'href' => route('ilanlar.create'),
                'onclick' => '',
                'color' => 'primary'
            ),
        );


        $this->button_test = array(
            array(
                'title' => 'Yeni Ekle',
                'id' => '',
                'class' => '',
                'type' => 'link',
                'icon' => '',
                'href' => route('ilanlar.create'),
                'onclick' => '',
                'color' => 'primary'
            ),
        );


        $this->control = array(
            array(
                array(
                    'title' => 'Sitede Göster',
                    'before' => 1,
                    'status' => 0,
                    'table' => $this->table,
                    'column' => 'status',
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
                    array('title' => 'İlan Başlığı', 'row' => 'name', 'type' => 'text'),
                    array('title' => 'Adres', 'row' => 'adress', 'type' => 'text'),
                    array('title' => 'Oluşturlma Tarihi', 'row' => 'created_at', 'type' => 'date'),
                    array('title' => 'İşlemler', 'type' => 'button'),
                )
        );



        $this->form = array(
            array(
                'title' => 'Soru',
                'name' => 'question',
                'type' => 'text',
                'class' => '',
                'grid' => 'col-md-12',
                'validate' => 'required|min:2|max:255',
                'id' => '',
                'attribute' => '',
                'required' => true,
                'readonly' => false,
                'disabled' => false,
                'format' => 'text'
            ),
            array(
                'title' => 'Seçenek Cümlesi',
                'name' => 'selection',
                'type' => 'text',
                'class' => '',
                'grid' => 'col-md-4',
                'validate' => "",
                'id' => 'selection',
                'attribute' => '',
                'required' => true,
                'readonly' => false,
                'disabled' => false,
                'format' => 'text'
            ),
            array(
                'title' => 'Seçenek Değeri',
                'name' => 'selection_val',
                'type' => 'text',
                'class' => '',
                'grid' => 'col-md-4',
                'validate' => "",
                'id' => 'selection_val',
                'attribute' => '',
                'required' => true,
                'readonly' => false,
                'disabled' => false,
                'format' => 'text'
            ),
        );
    }


    public function create()
    {
        $page['title'] = $this->title . ' -> Ekle';
        $page['action'] = route('ilanlar.store');
        $page['category'] = Category::all();
        $page['estateprops'] = EstateProperties::all();
        return view('ilanlar::create', compact('page'));
    }

    public function store(Request $request)
    {
        $saveData = [];
        $validatedData = $request->validate([
            'baslik' => 'required|string|max:255',
            'kategori' => 'required|integer',
            'fiyatlandirma' => 'required|string',
            'fiyat' => 'required|numeric',
            'adress' => 'nullable|string',
            'ilan_icerik' => 'nullable|string',
            'props' => 'nullable|string',
            'fileInput.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5240',
        ]);

        $ozellikler = json_decode($request->props, true) ?? [];
        $gorseller = [];
        if ($request->hasFile('fileInput')) {
            foreach ($request->file('fileInput') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('uploads/ilanlar', $filename, 'public');
                $gorseller[] = $filePath;
            }
        }

        $saveData['name'] = $validatedData['baslik'];
        $saveData['category'] = $validatedData['kategori'];
        $saveData['price_type'] = $validatedData['fiyatlandirma'];
        $saveData['price'] = $validatedData['fiyat'];
        $saveData['adress'] = $validatedData['adress'];
        $saveData['content'] = $validatedData['ilan_icerik'];
        $saveData['property_properties'] = $ozellikler;
        $saveData['images'] = $gorseller;
        $saveData['agent_id'] = auth('manager')->user()->id;
        $saveData['branch_id'] = auth('manager')->user()->branch_id;
        $create = IlanModel::create($saveData);


        if ($create) {
            return redirect()->route('ilanlar.lists');
        } else {
            return redirect()->route('ilanlar.create');
        }
    }



    public function edit(Request $request)
{
    try {
        $validatedData = $request->validate([
            'baslik' => 'required|string|max:255',
            'kategori' => 'required|integer',
            'fiyatlandirma' => 'required|string',
            'fiyat' => 'required|numeric',
            'adress' => 'nullable|string',
            'ilan_icerik' => 'nullable|string',
            'props' => 'nullable|string',
            'fileInput.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5240',
            'existingImages' => 'nullable|array',
            'images_data' => 'nullable|string'
        ]);
    } catch (\Illuminate\Validation\ValidationException $e) {
        dd($e->errors());
    }

    $id = $request->input('id');
    $entry = IlanModel::where('id', $id)->first();

    if (!$entry) {
        return redirect()->route('ilanlar.edit')->withErrors(['İlan bulunamadı!']);
    }

    $ozellikler = json_decode($request->props, true) ?? [];
    $formExistingImages = $request->images_data ?? [];
    $newUploadedImages = [];

    if ($request->hasFile('fileInput')) {
        foreach ($request->file('fileInput') as $file) {
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('uploads/ilanlar', $filename, 'public');
            $newUploadedImages[] = 'uploads/ilanlar/' . $filename;
        }
    }

    $finalImages = array_merge(json_decode($formExistingImages), $newUploadedImages);
    $finalImages = array_unique($finalImages);
    $saveData = [
        'name' => $validatedData['baslik'],
        'category' => $validatedData['kategori'],
        'price_type' => $validatedData['fiyatlandirma'],
        'price' => $validatedData['fiyat'],
        'adress' => $validatedData['adress'],
        'content' => $validatedData['ilan_icerik'],
        'property_properties' => $ozellikler,
        'images' =>array_values($finalImages), // JSON olarak sakla
        'agent_id' => auth('manager')->user()->id,
        'branch_id' => auth('manager')->user()->branch_id,
    ];

    $update = $entry->update($saveData);

    if ($update) {
        return redirect()->route('ilanlar.lists');
    } else {
     //   return redirect()->route('ilanlar.edit')->withErrors(['Güncelleme başarısız!']);
    }
}

    




    public function update($id)
    {
        $page['title'] = $this->title . ' -> Düzenle';
        $page['action'] = route('ilanlar.edit', $id);
        $page['row'] = IlanModel::find($id);
        $page['category'] = Category::all();
        $page['estateprops'] = EstateProperties::all();
        return view('ilanlar::edit', compact('page'));
    }


    public function lists()
    {
        $page['title'] = 'İlan -> Listesi';
        $page['table'] = route('ilanlar.show');
        $page['tablerow'] = $this->datatable['rows'];
        $page['button'] = $this->button_test;
        return view('ilanlar::lists', compact('page'));
    }


    public function show()
    {
        $lists = IlanModel::orderByDesc('created_at')->get()->toArray();
        $output = array();
        $output['aaData'] = array();
        if ($lists) {
            foreach ($lists as $list) {
                $row = array();
                $iEdit = route('ilanlar.update', $list['id']);
                $iDestroy = route('ilanlar.destroy', $list['id']);
                $control = "";

                foreach ($this->control as $item) {
                    foreach ($item as $value) {
                        if ($list[$value['column']] == $value['before']) {
                            $control .= '<button  title="' . $value['title'] . '"  data-toggle="tooltip" data-id="' . $list['id'] . '" data-status="' . $value['status'] . '" data-table="' . $value['table'] . '"  data-column="' . $value['column'] . '"  onclick="ColumnUpdate(this)"  class="btn  ' . $value['class'] . '  btn-smsharp mr-1 status_update"><i class="' . $value['icon'] . '"></i></button>';
                        }
                    }
                }

                $button = "";
                $button .= '<a href="' . $iEdit . '" target="_self" class="btn btn-primary  btn-smsharp mr-1" title="Düzenle" data-toggle="tooltip" ><i class="ri-edit-box-line"></i></a>';
                $button .= '<a href="' . $iDestroy . '" target="_self" class="btn btn-danger  btn-smsharp mr-1" title="Sil" data-toggle="tooltip" ><i class="ri-delete-bin-5-line"></i></a>';

                foreach ($this->datatable['rows'] as $item) {
                    switch ($item['type']) {
                        case 'text':
                            $row[] = $list[$item['row']];
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

    public function destroy($id)
    {
        $destroy = IlanModel::destroy($id);
        if ($destroy) {
            $status = "success";
            $message = "İşlem Başarıyla Tamamlandı";
        } else {
            $status = "error";
            $message = "İşlem Sırasında Bir Hata Oluştu";
        }
        return redirect(route('ilanlar.lists'))
            ->with('message', $message)
            ->with('message_type', $status);
    }

}
