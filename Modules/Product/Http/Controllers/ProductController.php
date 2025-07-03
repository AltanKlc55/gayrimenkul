<?php

namespace Modules\Product\Http\Controllers;
use Illuminate\Support\Str;
use App\Models\Backend\Product;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Product\Entities\Products;
use Modules\Semester\Entities\Semester;
use Modules\Product\Entities\ProductBuyyingChild;
use Modules\Product\Entities\ProductGroup;
use Modules\Offer\Entities\OfferChild;

class ProductController extends Controller
{
    private $table = "products";
    private $title;
    private $multilang = false;

    public function __construct()
    {
        $this->title = ___('Product');
        $this->button = array(
            array(
                'title' => 'Yeni Ekle',
                'id' => '',
                'class' =>'',
                'type' => 'link', // button,link
                'icon' => '', // button,link
                'href' => route('product.create'), // link ise gideceği sayfa
                'onclick' =>'',
                'color' =>'primary'
            ),
        );
        $this->control = array();
        $this->datatable = array(
            'table' => $this->table,
            'select' => array(
                $this->table.'.*',
                'definitions_child.title as unit',
                'brands.title as brand',
            ),
            'join' => array(
                array('definitions_child', 'products.unit', '=', 'definitions_child.id','Left'),
                array('definitions_child as brands', 'products.brand', '=', 'brands.id','Left')
            ),
            'rows' => array(
                array('title' => 'ID','row' => 'id','type' => 'text'),
                array('title' => 'Başlık','row' => 'title','type' => 'text'),
                array('title' => 'Fiyat (KDV Dahil)','row' => 'price','type' => 'price'),
                array('title' => 'KDV','row' => 'vat','type' => 'text'),
                array('title' => 'Stok','row' => 'id','type' => 'stock'),
                array('title' => 'Birim','row' => 'unit','type' => 'text'),
                array('title' => 'Son İşlem Tarihi','row' => 'updated_at','type' => 'date'),
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
                'title' => 'Alt Başlık',
                'name' => 'invoice_title',
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


           //array(
           //    'title' => 'En',
           //    'name' => 'width',
           //    'type' => 'text',
           //    'class' => '',
           //    'grid' => 'col-md-3',
           //    'validate' => 'required|max:255',
           //    'id' => '',
           //    'multilang' => false,
           //    'attribute' => '',
           //    'required' => false,
           //    'readonly' => false,
           //    'disabled' => false,
           //    'format' => 'text'
           //),

            //array(
            //    'title' => 'Boy',
            //    'name' => 'length',
            //    'type' => 'text',
            //    'class' => '',
            //    'grid' => 'col-md-3',
            //    'validate' => 'required|max:255',
            //    'id' => '',
            //    'multilang' => false,
            //    'attribute' => '',
            //    'required' => false,
            //    'readonly' => false,
            //    'disabled' => false,
            //    'format' => 'text'
            //),

            //array(
            //    'title' => 'Yükseklik',
            //    'name' => 'height',
            //    'type' => 'text',
            //    'class' => '',
            //    'grid' => 'col-md-3',
            //    'validate' => 'required|max:255',
            //    'id' => '',
            //    'multilang' => false,
            //    'attribute' => '',
            //    'required' => false,
            //    'readonly' => false,
            //    'disabled' => false,
            //    'format' => 'text'
            //),



            array(
                'title' => 'Türü',
                'name' => 'product_type',
                'type' => 'select',
                'child' => 'name',
                'option' => array(
                    array('id' => 1,'name' => ___('Envanter')),
                    array('id' => 2,'name' => ___('Yedek Parça'))
                ),
                'class' => 'select2',
                'grid' => 'col-md-3',
                'id' => '',
                'multiple' => false,
                'required' => false,
                'validate' => "",
                'readonly' => false,
                'disabled' => false,
                'format' => 'select'
            ),
            array(
                'title' => 'Uyumlu Envanter',
                'name' => 'use_inventory',
                'type' => 'select',
                'child' => 'title',
                'option' => Products::where('product_type',1)->get()->toArray(),
                'class' => 'select2',
                'grid' => 'col-md-3',
                'id' => '',
                'multiple' => false,
                'required' => false,
                'validate' => "",
                'readonly' => false,
                'disabled' => false,
                'format' => 'select'
            ),
            array(
                'title' => 'Ürün Grubu',
                'name' => 'group',
                'type' => 'select',
                'child' => 'name',
                'option' => ProductGroup::get()->toArray(),
                'class' => 'select2',
                'grid' => 'col-md-3',
                'id' => '',
                'multiple' => false,
                'required' => false,
                'validate' => "",
                'readonly' => false,
                'disabled' => false,
                'format' => 'select'
            ),
            array(
                'title' => 'Birim',
                'name' => 'unit',
                'type' => 'select',
                'child' => 'title',
                'option' =>  get_definitions('unit'),
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
                'title' => 'Fiyat',
                'name' => 'price',
                'type' => 'text',
                'class' => 'currency',
                'grid' => 'col-md-3',
                'validate' => 'required',
                'id' => '',
                'multilang' => false,
                'attribute' => '',
                'required' => false,
                'readonly' => false,
                'disabled' => false,
                'format' => 'money'
            ),
            array(
                'title' => 'KDV',
                'name' => 'vat',
                'type' => 'number',
                'class' => '',
                'grid' => 'col-md-3',
                'validate' => 'required',
                'id' => '',
                'attribute' => '',
                'required' => true,
                'readonly' => false,
                'disabled' => false,
                'format' => 'text'
            ),
            array(
                'title' => 'Bakım Süresi',
                'name' => 'vat',
                'type' => 'number',
                'class' => '',
                'grid' => 'col-md-3',
                'validate' => 'required',
                'id' => '',
                'attribute' => '',
                'required' => true,
                'readonly' => false,
                'disabled' => false,
                'format' => 'text'
            ),
            array(
                'title' => 'Minimum Stok',
                'name' => 'min_stock',
                'type' => 'number',
                'class' => '',
                'grid' => 'col-md-3',
                'validate' => 'required',
                'id' => '',
                'attribute' => '',
                'required' => true,
                'readonly' => false,
                'disabled' => false,
                'format' => 'text'
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
        $page['table'] = route('product.show');
        $page['tablerow'] = $this->datatable['rows'];
        $page['button'] = $this->button;


        return view('product::index',compact('page'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $page['title'] = $this->title.' -> Ekle';
        $page['action'] = route('product.store');
        $page['multilang'] = $this->multilang;
        $page['form'] = $this->form;

        return view('product::form',compact('page'));
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

            $create = Products::create($data);

            if ($create) {
                $status = "success";
                $message = "İşlem Başarıyla Tamamlandı";
            } else {
                $status = "error";
                $message = "İşlem Sırasında Bir Hata Oluştu";
            }

            return redirect(route('product.index'))->with('message', $message)->with('message_type', $status);

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
        $data['table']  = $this->datatable['table'];
        $data['select']  =$this->datatable['select'];
        $data['where']  =[];
        $data['join']  =  $this->datatable['join'];

        $lists = dataTable($data,$iDisplayStart,$iDisplayLength,$sSearch,$aColumns);

        $output = array();
        $output['aaData'] = array();
        if ($lists) {
            foreach ($lists as $list) {
                $row = array();
                $iEdit = route('product.edit',$list['id']);
                $iDestroy = route('product.destroy',$list['id']);


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
                            case 'price':
                            $row[] = currency($list[$item['row']]);
                            break;
                            case 'stock':
                                $total = ProductBuyyingChild::selectRaw('SUM(COALESCE(qty, 0)) AS totalstock')->where('product','=',$list[$item['row']])->get()->first();

                                $query = array();
                                $query['where'][] = array('product',$list[$item['row']]);
                                $query['selectRaw'] = "SUM(COALESCE(qty, 0)) AS total_stock";
                                $productstock = getQuery('offer_child',$query,"first");
                                if(isset($productstock->total_stock)){
                                    $row[] = $total['totalstock'] - $productstock->total_stock;
                                } else{
                                    $row[] = ($total['totalstock']) ? $total['totalstock'] : 0;
                                }
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
        $page['action'] = route('product.update',$id);
        $page['row'] = Products::find($id);
        $page['form'] = $this->form;
        $page['multilang'] = $this->multilang;

        return view('product::form',compact('page'));
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


            $entry = Products::where('id', $id)->firstOrFail();


            $update = $entry->update($data);

            if ($update) {
                $status = "success";
                $message = "İşlem Başarıyla Tamamlandı";
            } else {
                $status = "error";
                $message = "İşlem Sırasında Bir Hata Oluştu";
            }
            return redirect(route('product.index'))
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
        $destroy = Products::destroy($id);

        if ($destroy) {
            $status = "success";
            $message = "İşlem Başarıyla Tamamlandı";
        } else {
            $status = "error";
            $message = "İşlem Sırasında Bir Hata Oluştu";
        }

        return redirect(route('product.index'))
            ->with('message', $message)
            ->with('message_type', $status);
    }

    public function get_price(Request $request)
    {
        $json = array();
        if (request()->isMethod('POST')) {

            $total = Products::select('price')->where('id','=',request('id'))->get()->first();

            if($total){
                $json['success'] = $total['price'];
            } else {
                $json['success'] = 0;
            }
        }
        echo json_encode($json);

    }
}