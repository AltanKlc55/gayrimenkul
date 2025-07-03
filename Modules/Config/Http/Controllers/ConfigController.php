<?php

namespace Modules\Config\Http\Controllers;

use Illuminate\Support\Str;
use Modules\Config\Entities\Config;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ConfigController extends Controller
{
    private $table = "roles";
    private $title;

    public function __construct()
    {
        $this->title = ___('Permissions');
        $this->form  = array(

            array(
                'title' => ___('Firma Adı'),
                'name' => 'company_name',
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
                'title' => ___('Firma Adres'),
                'name' => 'company_address',
                'getname' => 'company_address',
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
                'title' => ___('Firma Telefon'),
                'name' => 'company_phone',
                'getname' => 'company_phone',
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
                'title' => ___('Firma E-Mail'),
                'name' => 'company_email',
                'getname' => 'company_email',
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
                'title' => ___('Firma Vergi Dairesi'),
                'name' => 'company_tax_address',
                'getname' => 'company_tax_address',
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
                'title' => ___('Firma Vergi No'),
                'name' => 'company_tax_no',
                'getname' => 'company_tax_no',
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

            // array(
            //     'title' => ___('Teklif Üst'),
            //     'name' => 'offer_top',
            //     'getname' => 'offer_top',
            //     'type' => 'textarea',
            //     'class' => '',
            //     'grid' => 'col-md-12',
            //     'validate' => 'required|min:2|max:255',
            //     'id' => '',
            //     'attribute' => '',
            //     'required' => true,
            //     'readonly' => false,
            //     'disabled' => false,
            //     'format' => 'text'
            // ),
            // array(
            //     'title' => ___('Teklif Alt'),
            //     'name' => 'offer_bottom',
            //     'getname' => 'offer_bottom',
            //     'type' => 'textarea',
            //     'class' => '',
            //     'grid' => 'col-md-12',
            //     'validate' => 'required|min:2|max:255',
            //     'id' => '',
            //     'attribute' => '',
            //     'required' => true,
            //     'readonly' => false,
            //     'disabled' => false,
            //     'format' => 'text'
            // ),
            // array(
            //     'title' => ___('Hatırlatma Gün Sayısı'),
            //     'name' => 'company_display_day',
            //     'type' => 'number',
            //     'class' => '',
            //     'grid' => 'col-md-4',
            //     'validate' => 'required|min:2|max:255',
            //     'id' => '',
            //     'attribute' => '',
            //     'required' => true,
            //     'readonly' => false,
            //     'disabled' => false,
            //     'format' => 'text'
            // ),

//            array(
//                'title' => ___('Security Name'),
//                'name' => 'config[company_name]',
//                'type' => 'select',
//                'selected' => 'guard_name',
//                'option' => [array('id' => 'web','name' => 'Web'),array('id' => 'api','name' => 'Api')],
//                'class' => 'select2',
//                'grid' => 'col-md-3',
//                'id' => '',
//                'json' => false,
//                'multiple' => false,
//                'required' => false,
//                'validate' => "",
//                'readonly' => false,
//                'disabled' => false,
//                'format' => 'select'
//            ),

        );
    }
    public function index()
    {
        $page['title'] = $this->title.' | '.___('Add');
        $page['action'] = route('config.store');
        $page['row'] = array();
        foreach ($this->form as $item){
            $page['row'][$item['name']] =   get_config($item['name']);
        }


        $page['form'] = $this->form;
        return view('config::config',compact('page'));
    }

    public function store(Request $request)
    {
        if (request()->isMethod('POST')) {


            // Bu alanda dizi içindeki elemanların validasyon kontrolleri yapoılmakta



            Config::truncate();
            unset($_POST['_token']);
            foreach ($_POST as $key => $value){
                $data['config'] = $key;
                $data['value'] = $value;
                $create =  Config::create($data);
            }



            if ($create) {
                $status = "success";
                $message = ___("Transaction Completed Successfully");
            } else {
                $status = "error";
                $message = ___("An error occurred during the operation");
            }

            return redirect(route('config.index'))->with('message', $message)->with('message_type', $status);

        }
    }
}