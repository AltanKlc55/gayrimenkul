<?php

namespace Modules\TestCreate\Http\Controllers;

use Illuminate\Support\Str;
use Modules\TestCreate\Entities\Questions;
use Modules\Category\Entities\Category;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TestCreateController extends Controller
{
    private $table = "tbl_questions";
    private $title = "Sorular";

    public function __construct()
    {
        $this->button = array(
            array(
                'title' => 'Yeni Ekle',
                'id' => '',
                'class' =>'',
                'type' => 'link', // button,link
                'icon' => '', // button,link
                'href' => route('testcreate.create'), // link ise gideceği sayfa
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
            // array(
            //     array(
            //         'title' => 'Listelemede Gizle',
            //         'before' => 0,
            //         'status' => 1,
            //         'table' => $this->table,
            //         'column' => 'listening',
            //         'icon' => 'fe fe-check-circle',
            //         'class' => 'btn-dark'
            //     ),
            //     array(
            //         'title' => 'Listelemede Göster',
            //         'before' => 1,
            //         'status' => 0,
            //         'table' => $this->table,
            //         'column' => 'listening',
            //         'icon' => 'fe fe-check-circle',
            //         'class' => 'btn-light'
            //     )
            // )
        );
        $this->datatable = array(
            'table' => $this->table,
            'select' => $this->table.'.*',
            'join' => array(),
            'rows' => array(
                array('title' => 'ID','row' => 'id','type' => 'text'),
                array('title' => 'Soru','row' => 'question','type' => 'text'),
                array('title' => 'Oluşturlma Tarihi','row' => 'created_at','type' => 'text'),
                array('title' => 'Durum','row' => 'status','type' => 'path'),
                array('title' => 'Son İşlem Tarihi','row' => 'updated_at','type' => 'date'),
                array('title' => 'İşlemler','type' => 'button'),
            )
        );

        $kategoriler = Category::all(['id', 'name']);
        $this->form  = array(
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
        array(
            'title' => 'Seçenek Hizmet Kategorisi',
            'name' => 'category_id',
            'type' => 'select',
            'option' => Category::with("Children")->where(["parent_id" => 0])->get()->toArray(),
            'class' => 'select2',
            'grid' => 'col-md-4',
            'validate' => "",
            'id' => 'category_id',
            'child' => '',
            'attribute' => '',
            'required' => true,
            'readonly' => false,
            'disabled' => false,
            'format' => 'text'
        ),
    );
    }


    public function question_bank(){
        $page['title'] = 'Soru -> Listesi';
        $page['table'] = route('testcreate.show_question');
        $page['tablerow'] = $this->datatable['rows'];
        $page['button'] = $this->button;
        return view('testcreate::index',compact('page'));
    }

    public function tests(){
        return view('testcreate::index'); 
    }

    public function create()
    {
        $page['title'] = $this->title.' -> Ekle';
        $page['action'] = route('testcreate.store');
        $categories = Category::all();
        return view('testcreate::question_add',compact('page','categories'));
    }

    public function store(Request $request)
    {

        $data['answers_json'] = $request->input('answers_json');
        $data['question'] = $request->input('question_text');
    
        $create = Questions::create($data);
    
        if ($create) {
            return redirect()->route('testcreate.question_bank')->with('message', 'İşlem Başarıyla Tamamlandı')->with('message_type', 'success');
        }
    
        return redirect()->route('testcreate.create')->with('message', 'İşlem Sırasında Bir Hata Oluştu')->with('message_type', 'error');
    }
    


    public function show_question()
    {
        $lists = Questions::orderByDesc('created_at')->get()->toArray();
        $output = array();
        $output['aaData'] = array();
        if ($lists) {
            foreach ($lists as $list) {
                $row = array();
                $iEdit = route('testcreate.edit',$list['id']);
                $iDestroy = route('testcreate.destroy',$list['id']);
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

    public function destroy($id)
    {
     $destroy = Questions::destroy($id);
     if ($destroy) {
         $status = "success";
         $message = "İşlem Başarıyla Tamamlandı";
     } else {
         $status = "error";
         $message = "İşlem Sırasında Bir Hata Oluştu";
     }
     return redirect(route('testcreate.question_bank'))
         ->with('message', $message)
         ->with('message_type', $status);
    }

    public function update(Request $request){
        $id = $request->input('id');
        $data['answers_json'] = $request->input('answers_json');
        $data['question'] = $request->input('question_text');
        $entry = Questions::where('id', $id)->first();
        $update = $entry->update($data);
        if ($update) {
            return redirect()->route('testcreate.question_bank')->with('message', 'İşlem Başarıyla Tamamlandı')->with('message_type', 'success');
        }
        return redirect()->route('testcreate.edit_question')->with('message', 'İşlem Sırasında Bir Hata Oluştu')->with('message_type', 'error');
    }

    public function edit($id)
    {
      $page['title'] = $this->title.' -> Düzenle';
      $page['action'] = route('testcreate.update',$id);
      $page['row'] = Questions::find($id);
      $page['cevaplar'] = json_decode($page['row']->answers_json);
      $categories = Category::all();
      return view('testcreate::edit_question',compact('page','categories'));
    }

}
