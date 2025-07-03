<?php

namespace Modules\Psikologlar\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PsikologlarController extends Controller
{

    private $tbl_tests = "tbl_psikologlar";
    private $table = "tbl_psikologlar";
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
  
    );
    }

    /**
     * @return Renderable
     */
    public function index(){
        $page['title'] = 'Psikolog -> Listesi';
        $page['table'] = route('test.show_question');
        $page['tablerow'] = $this->datatable['rows'];
        $page['button'] = $this->button_test;
        return view('testcreate::index',compact('page'));
    }

    /**
     * @return Renderable
     */
    public function create()
    {
        return view('psikologlar::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('psikologlar::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('psikologlar::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
