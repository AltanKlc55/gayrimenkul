<?php

namespace Modules\Product\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Product\Entities\Products;
use Modules\Product\Entities\Productset;
use Modules\Product\Entities\ProductChild;
use Modules\Semester\Entities\Semester;
use Modules\Admin\Entities\User;

class ProductSetController extends Controller
{
    private $table = "products_set";
    private $title;
    private $multilang = false;

    public function __construct()
    {
        $this->title = ___('Product Set');
        $this->button = array(
            array(
                'title' => 'Yeni Ekle',
                'id' => '',
                'class' =>'',
                'type' => 'link', // button,link
                'icon' => '', // button,link
                'href' => route('productset.create',time()), // link ise gideceği sayfa
                'onclick' =>'',
                'color' =>'primary'
            ),
        );
        $this->control = array();
        $this->datatable = array(
            'table' => $this->table,
            'select' => array('products_set.*','semester.name as donem','user.username as dagitici'),
            'join' => array(
                array('semester', 'products_set.group', '=', 'semester.id','Left'),
                array('user', 'products_set.distributor', '=', 'user.id','Left')
            ),
            'rows' => array(
                array('title' => 'ID','row' => 'id','type' => 'text'),
                array('title' => 'Başlık','row' => 'title','type' => 'text'),
                array('title' => 'Fiyat','row' => 'total','type' => 'total'),
                array('title' => 'Dağıtıcı','row' => 'dagitici','type' => 'text'),
                array('title' => 'Dönem','row' => 'donem','type' => 'text'),
                array('title' => 'Son İşlem Tarihi','row' => 'updated_at','type' => 'date'),
                array('title' => 'İşlemler','type' => 'button'),
            )
        );

        $this->datatable2 = array(
            'table' => "products_child",
            'select' => array('products_child.*','products.title as product'),
            'join' => array(
                array('products', 'products_child.product', '=', 'products.id','Left')
            ),
            'rows' => array(
                array('title' => 'Başlık','row' => 'product','type' => 'json'),
                array('title' => 'Adet','row' => 'qty','type' => 'text'),
                array('title' => 'Fiyat (KDV Dahil)','row' => 'price','type' => 'price'),
                array('title' => 'İşlemler','type' => 'button'),
            )
        );


        $this->form  = array(
            array(
                'title' => 'Başlık',
                'name' => 'title',
                'type' => 'text',
                'class' => '',
                'grid' => 'col-md-6',
                'validate' => 'required|max:255',
                'id' => '',
                'multilang' => false,
                'attribute' => '',
                'required' => false,
                'readonly' => false,
                'disabled' => false,
                'format' => 'text'
            ),
            array(
                'title' => 'Kod',
                'name' => 'code',
                'type' => 'text',
                'class' => '',
                'grid' => 'col-md-6',
                'validate' => 'required|max:255',
                'id' => '',
                'multilang' => false,
                'attribute' => '',
                'required' => false,
                'readonly' => false,
                'disabled' => false,
                'format' => 'text'
            ),
            array(
                'title' => 'Distributor',
                'name' => 'distributor',
                'type' => 'select',
                'child' => 'username',
                'option' =>  User::where('authority',3)->get()->toArray(),
                'class' => 'select2',
                'grid' => 'col-md-12',
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
                'title' => 'Dönem ',
                'name' => 'group',
                'type' => 'select',
                'child' => 'name',
                'option' => Semester::get()->toArray(),
                'class' => 'select2',
                'grid' => 'col-md-12',
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
                'title' => 'Resim',
                'name' => 'image',
                'type' => 'file',
                'class' => '',
                'grid' => 'col-md-3',
                'validate' => "",
                'id' => '',
                'required' => false,
                'readonly' => false,
                'disabled' => false,
                'path' => 'uploads/product/',
                'filetype' => 'image',
                'format' => 'file'
            ),
            array(
                'name' => 'title',
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
        $page['table'] = route('productset.show');
        $page['tablerow'] = $this->datatable['rows'];
        $page['button'] = $this->button;


        return view('product::index',compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function create($id)
    {
        $page['title'] = $this->title;
        $page['action'] = route('productset.store');
        $page['code'] = $id;
        $page['semester'] = Semester::get()->toArray();
        $page['product'] = Products::select('id','title')->get()->toArray();
        $page['distributor'] = User::select('id','username')->where('authority',3)->get()->toArray();


        $page['table'] = route('productset.show_child');
        $page['table_query'] = array('code' => $id);
        $page['tablerow'] = $this->datatable2['rows'];
        $page['button'] = array();

        return view('product::setform',compact('page'));
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

            $name = Str::slug(request('title'));
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
                    case 'money':
                        $data[$validate_control['name']] =  floatvalue($request->input($validate_control['name']));
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

            $create = Productset::create($data);

            if ($create) {
                $status = "success";
                $message = ___('Transaction Successful');
            } else {
                $status = "error";
                $message = "İşlem Sırasında Bir Hata Oluştu";
            }

            return redirect(route('productset.index'))->with('message', $message)->with('message_type', $status);

        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Request $request)
    {

        $aColumns = array($this->datatable['table'].'.*');
        $iDisplayStart = $request->input('iDisplayStart', true);
        $iDisplayLength = $request->input('iDisplayLength', true);
        $sSearch = $request->input('search', true);
        $code = $request->input('code', true);


        $data['table']  = $this->datatable['table'];
        $data['select']  =$this->datatable['select'];
        $data['where']  =[];
        $data['join']  =  $this->datatable['join'];

        $lists = dataTable($data,$iDisplayStart,$iDisplayLength,$sSearch,$aColumns);

//        $lists = Productset::orderByDesc('created_at')->get()->toArray();
        $output = array();
        $output['aaData'] = array();
        if ($lists) {
            foreach ($lists as $list) {
                $row = array();
                $iEdit = route('productset.edit',$list['id']);
                $iDestroy = route('productset.destroy',$list['id']);
                $iPay= route('payment',$list['slug']);


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
                $button .= '<a href="' . $iPay . '" target="_blank" class="btn btn-dark  btn-smsharp mr-1" title="Düzenle" data-toggle="tooltip" ><i class="ri-links-line"></i></a>';
                $button .= '<a href="' . $iDestroy . '" target="_self" class="btn btn-danger  btn-smsharp mr-1" title="Sil" data-toggle="tooltip" ><i class="ri-delete-bin-5-line"></i></a>';

                foreach ($this->datatable['rows'] as $item){
                    switch ($item['type']){
                        case 'text':
                            $row[] = $list[$item['row']];
                            break;
                        case 'price':
                            $row[] = currency($list[$item['row']]);
                            break;
                            case 'total':
//                                $total = DB::table('products_child')->select(DB::raw('COALESCE(SUM(price),0) as total_price'))->get();
//                                $total = ProductChild::select(DB::raw('COALESCE(SUM(price), 0) as price'))->where('code','=',$list['code'])->get();
                            $row[] =ProductChild::where('code','=',$list['code'])->sum('price').' TL';
                            break;
                        case 'multilang':
                            $row[] =getlanguage($list[$item['row']],get_language());
                            break;

                        case 'date':
                            $row[] = date('Y-m-d H:i',strtotime($list[$item['row']]));
                            break;
                    }
                }

                if($control){
                    $row[] = $control;
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
        $page['title'] = $this->title.' -> Düzenle';
        $page['action'] = route('productset.update',$id);
        $page['row'] = Productset::find($id);
        $row = Productset::find($id)->toArray();
        $page['semester'] = Semester::get()->toArray();
        $page['product'] = Products::select('id','title')->get()->toArray();
        $page['distributor'] = User::where('authority',3)->get()->toArray();


        $page['form'] = $this->form;
        $page['multilang'] = $this->multilang;

        $page['code'] = $page['row']->code;


        $page['table'] = route('productset.show_child');
        $page['table_query'] = array('code' => $page['row']->code);
        $page['tablerow'] = $this->datatable2['rows'];
        $page['button'] = array();

        return view('product::setform',compact('page','row'));
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

            $name = Str::slug(request('title'));
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
                    case 'money':
                        $data[$validate_control['name']] =  floatvalue($request->input($validate_control['name']));
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


            $entry = Productset::where('id', $id)->firstOrFail();


            $update = $entry->update($data);

            if ($update) {
                $status = "success";
                $message = ___('Transaction Successful');
            } else {
                $status = "error";
                $message = "İşlem Sırasında Bir Hata Oluştu";
            }
            return redirect(route('productset.index'))
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
        $destroy = Productset::destroy($id);

        if ($destroy) {
            $status = "success";
            $message = ___('Transaction Successful');
        } else {
            $status = "error";
            $message = "İşlem Sırasında Bir Hata Oluştu";
        }

        return redirect(route('productset.index'))
            ->with('message', $message)
            ->with('message_type', $status);
    }
    public function store_child(Request $request)
    {

        $json = array();
        if (request()->isMethod('POST')) {


            // Bu alanda dizi içindeki elemanların validasyon kontrolleri yapoılmakta
            $validate = array();

            $data['code'] = request('code');
            $data['product'] = request('product');
            $data['qty'] = request('qty');
            $data['price'] = request('price');


         $create = ProductChild::create($data);
//
            if ($create) {
                $json['success'] = ___('Transaction Successful');
            } else {
                $json['error'] = "İşlem Sırasında Bir Hata Oluştu";
            }


        }
        echo json_encode($json);
    }
    public function show_child(Request $request)
    {
//        $lists = ProductChild::orderByDesc('created_at')->get()->toArray();
        $aColumns = array($this->datatable2['table'].'.*');

        $iDisplayStart = $request->input('iDisplayStart', true);
        $iDisplayLength = $request->input('iDisplayLength', true);
        $sSearch = $request->input('search', true);
        $code = $request->input('code', true);

        $data['table']  = $this->datatable2['table'];
        $data['select']  =$this->datatable2['select'];
        $data['where']  =[['code','=',$code],['code','=',$code]];

        $data['join']  =  $this->datatable2['join'];
        $lists = dataTable($data,$iDisplayStart,$iDisplayLength,$sSearch,$aColumns);

        $output = array();
        $output['aaData'] = array();
        if ($lists) {
            foreach ($lists as $list) {
                $row = array();
                $iEdit = route('productset.edit',$list['id']);
                $iDestroy = route('productset.destroy_child',$list['id']);


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
                $button .= '<a href="javascript:void(0)" data-url="'.$iDestroy.'" onclick="removechild(this)"  class="btn btn-danger  btn-smsharp mr-1" title="Sil" data-toggle="tooltip" ><i class="ri-delete-bin-5-line"></i></a>';

                foreach ($this->datatable2['rows'] as $item){
                    switch ($item['type']){
                        case 'text':
                            $row[] = $list[$item['row']];
                            break;
                        case 'price':
                            $row[] = currency($list[$item['row']]);
                            break;
                        case 'json':
                            $row[] =getlanguage($list[$item['row']],get_language());
                            break;

                        case 'date':
                            $row[] = date('Y-m-d H:i',strtotime($list[$item['row']]));
                            break;
                    }
                }

                if($control){
                    $row[] = $control;
                }

                $row[] = $button;

                $output['aaData'][] = $row;

            }
        }

        return json_encode($output);
    }
    public function destroy_child($id)
    {
        $destroy = ProductChild::destroy($id);
        $json = array();

        if ($destroy) {
            $json['success'] = ___('Transaction Successful');
        } else {
            $json['error'] = ___('Transaction Failed');
        }
        echo json_encode($json);
    }
}