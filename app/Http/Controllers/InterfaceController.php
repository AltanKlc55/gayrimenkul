<?php

namespace App\Http\Controllers;

use Modules\Category\Entities\Category;
use Modules\Config\Entities\Config;
use Modules\EstateProperties\Entities\EstateProperties;
use Modules\Ilanlar\Entities\IlanModel;
use Modules\Page\Entities\Page;

class InterfaceController extends Controller
{
    public function index(){
        $data = [];
        $data["title"] = "Anasayfa";
        $data["ilanlar"] = IlanModel::select('tbl_ilan.*', 'name as ilan_adi')->orderBy('id','desc')->take(6)->get();
        $data["projelerimiz"] = Page::where('page_type', 'projeler')->where('page_parent',1)->get();
        $data["hizmetlerimiz"] = Page::where('page_type', 'hizmetler')->where('page_parent',1)->get();
        $data["hakkimizda"] = Page::where('page_type', 'hakkimizda')->where('page_parent',0)->get();
        $data['blog'] = Page::where('page_type', 'bloglar')->where('page_parent',1)->get();
        $data["ilanlar_rakam"] = IlanModel::select('tbl_ilan.*', 'name as ilan_adi')->orderBy('price','desc')->take(6)->get();
        $data['ayarlar'] = Config::all();
        return view("default", compact("data"));
    }

    public function about(){
        $data['ayarlar'] = Config::all();
        $data['ilk_data'] = Page::where('page_type', 'hakkimizda')->where('page_parent',1)->where('slug','hakkimizda-hosgeldiniz')->get();
        $data["hakkimizda"] = Page::where('page_type', 'hakkimizda')->where('page_parent',0)->get();
        return view("interface_pages/about", compact("data"));
    }

    public function ilanlar(){
        $data['ayarlar'] = Config::all();
        $data['ozellikler'] = Category::all();
        $data['detayli_ozellikler'] = EstateProperties::all();
        $data['ilanlar'] = IlanModel::all();
        return view("interface_pages/propertylist", compact("data"));
    }

    public function propertydetail($slug){
        $data['ayarlar'] = Config::all();
        return view("interface_pages/propertydetail", compact("data"));
    }

    public function blogs(){
        $data['ayarlar'] = Config::all();
        $data["sayfa"] = Page::where('page_type', 'bloglar')->where('page_parent',0)->get();
        $data["bloglar"] = Page::where('page_type', 'bloglar')->where('page_parent',1)->get();
        return view("interface_pages/blog", compact("data"));
    }

    public function blogdetail($slug){
        $data['ayarlar'] = Config::all();
        $data["sayfa"] = Page::where('page_type', 'bloglar')->where('slug',$slug)->get();
        $data["projeler"] = Page::where('page_type', 'projeler')->where('page_parent',1)->get();
        return view("interface_pages/blogdetail", compact("data"));
    }

    public function projects(){
        $data['ayarlar'] = Config::all();
        $data["sayfa"] = Page::where('page_type', 'projeler')->where('page_parent',0)->get();
        $data["projeler"] = Page::where('page_type', 'projeler')->where('page_parent',1)->get();
        return view("interface_pages/projects", compact("data"));
    }

    public function projectsdetail($slug){
        $data['ayarlar'] = Config::all();
        $data["sayfa"] = Page::where('page_type', 'projeler')->where('slug',$slug)->get();
        $data["projeler"] = Page::where('page_type', 'projeler')->where('page_parent',1)->get();
        $data['bloglar'] = Page::where('page_type', 'bloglar')->where('page_parent',1)->get();
        return view("interface_pages/projectsdetail", compact("data"));
    }

    public function contact(){
        $data['ayarlar'] = Config::all();        
        $data["sayfa"] = Page::where('page_type', 'iletisim')->get();
        return view("interface_pages/contact", compact("data"));
    }

}
