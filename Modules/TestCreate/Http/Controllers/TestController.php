<?php

namespace Modules\TestCreate\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\TestCreate\Entities\Questions;
use Modules\TestCreate\Entities\Tests;
use Modules\Category\Entities\Category;
use Illuminate\Routing\Controller;

class TestController extends Controller
{
    private $tbl_tests = "tbl_tests";
    private $table = "tbl_questions";
    private $title = "Sorular";

    public function __construct()

    
    {
        $this->button = array(
            array(
                'title' => 'Yeni Ekle',
                'id' => '',
                'class' =>'',
                'type' => 'link',
                'icon' => '', 
                'href' => route('testcreate.create'),
                'onclick' =>'',
                'color' =>'primary'
            ),
        );


        $this->button_test = array(
            array(
                'title' => 'Yeni Ekle',
                'id' => '',
                'class' =>'',
                'type' => 'link',
                'icon' => '', 
                'href' => route('test.create'),
                'onclick' =>'',
                'color' =>'primary'
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
            'table' => $this->tbl_tests,
            'select' => $this->tbl_tests.'.*',
            'join' => array(),
            'rows' => array(
                array('title' => 'ID','row' => 'id','type' => 'text'),
                array('title' => 'Test Adı','row' => 'test_name','type' => 'text'),
                array('title' => 'Test Açıklaması','row' => 'test_description','type' => 'text'),
                array('title' => 'Oluşturlma Tarihi','row' => 'created_at','type' => 'date'),
                array('title' => 'Durum','row' => 'status','type' => 'path'),
                array('title' => 'İşlemler','type' => 'button'),
            )
        );
        

        $this->modaltable = array(
            'table' => $this->table,
            'select' => $this->table.'.*',
            'join' => array(),
            'rows' => array(
                array('title' => 'ID','row' => 'id','type' => 'text'),
                array('title' => 'Soru','row' => 'question','type' => 'text'),
                array('title' => 'Oluşturlma Tarihi','row' => 'created_at','type' => 'text'),
                array('title' => 'Seçim','type' =>'checkbox', 'row' => ''),
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


    public function create_test_page(){
        $page['title'] = $this->title.' -> Ekle';
        $page['action'] = route('test.store');
        $page['questions'] = Questions::all();
        return view('testcreate::test_create',compact('page'));
    }

    public function test_question_filtered(Request $request){
        $ids = $request->input('ids');
        $questions = Questions::whereIn('id', $ids)->get();
        return response()->json([
            'status' => 'success',
            'data' => $questions
        ]);
    }


    public function show_question()
    {
        $lists = Tests::orderByDesc('created_at')->get()->toArray();
        $output = array();
        $output['aaData'] = array();
        if ($lists) {
            foreach ($lists as $list) {
                $row = array();
                $iEdit = route('test.update',$list['id']);
                $iDestroy = route('test.destroy',$list['id']);
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

    public function store(Request $request)
    {
        $data['test_name'] = $request->input('test_name');
        $data['test_description'] = $request->input('test_description');
        $data['result_points'] = $request->input('points_json');
        $data['questions'] = $request->input('selected_values');
        $create = Tests::create($data);
        if ($create) {
            return redirect()->route('test.test_list')->with('message', 'İşlem Başarıyla Tamamlandı')->with('message_type', 'success');
        }
        return redirect()->route('test.create')->with('message', 'İşlem Sırasında Bir Hata Oluştu')->with('message_type', 'error');
    }


    public function edit(Request $request){
        $id = $request->input('id');
        $data['test_name'] = $request->input('test_name');
        $data['test_description'] = $request->input('test_description');
        $data['result_points'] = $request->input('points_json');
        $data['questions'] = $request->input('selected_values');
        $entry = Tests::where('id', $id)->first();
        $update = $entry->update($data);
        if ($update) {
            return redirect()->route('test.test_list')->with('message', 'İşlem Başarıyla Tamamlandı')->with('message_type', 'success');
        }
        return redirect()->route('test.update')->with('message', 'İşlem Sırasında Bir Hata Oluştu')->with('message_type', 'error');
    }

    public function update($id)
    {
      $page['title'] = $this->title.' -> Düzenle';
      $page['action'] = route('test.edit',$id);
      $page['questions'] = Questions::all();
      $page['row'] = Tests::find($id);
      $page['puanlar'] = json_decode($page['row']->result_points);
      return view('testcreate::test_edit',compact('page'));
    }


    public function index(){
        $page['title'] = 'Test -> Listesi';
        $page['table'] = route('test.show_question');
        $page['tablerow'] = $this->datatable['rows'];
        $page['button'] = $this->button_test;
        return view('testcreate::index',compact('page'));
    }

    
    public function show()
    {
        $lists = Questions::orderByDesc('created_at')->get()->toArray();
        $output = array();
        $output['aaData'] = array();
        if ($lists) {
            foreach ($lists as $list) {
                $row = array();
                $iEdit = route('test.edit',$list['id']);
                $iDestroy = route('test.destroy',$list['id']);
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
     $destroy = Tests::destroy($id);
     if ($destroy) {
         $status = "success";
         $message = "İşlem Başarıyla Tamamlandı";
     } else {
         $status = "error";
         $message = "İşlem Sırasında Bir Hata Oluştu";
     }
     return redirect(route('test.test_list'))
         ->with('message', $message)
         ->with('message_type', $status);
    }


}
