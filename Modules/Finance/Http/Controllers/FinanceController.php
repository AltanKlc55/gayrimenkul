<?php

namespace Modules\Finance\Http\Controllers;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Finance\Entities\FinanceGroup;
use Modules\Finance\Entities\FinanceGroupChild;
use Modules\Finance\Entities\FinanceHistory;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Str;
class FinanceController extends Controller
{


    private $model;
    private $table = "finance_history";
    private $page = "finance";
    private $routename= "finance";
    private $title;
    private $menu_id = 0;
    private $multilang = false;
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    protected $center;
    protected $period = 0;
    protected $financegroup;

    public function __construct()
    {

        $this->middleware(function ($request, $next) {
           $this->center = auth('center')->user()->id;

           $this->financegroup = FinanceGroup::where(["current_id" => $this->center])->get()->toArray();

            $this->form  = array(
                array(
                    'title' => 'İşlem Tarihi',
                    'name' => 'process_date',
                    'type' => 'date',
                    'class' => '',
                    'grid' => 'col-md-4',
                    'validate' => "",
                    'id' => '',
                    'attribute' => '',
                    'multilang' => false,
                    'required' => true,
                    'readonly' => false,
                    'disabled' => false,
                    'format' => 'text'
                ),
                array(
                    'title' => 'Grubu',
                    'name' => 'group_id',
                    'type' => 'select',
                    'option' => $this->financegroup,
                    'class' => 'select2',
                    'grid' => 'col-md-4',
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
                    'title' => 'İşlem Türü',
                    'name' => 'child_id',
                    'type' => 'select',
                    'option' => array(),
                    'class' => 'select2',
                    'grid' => 'col-md-4',
                    'id' => 'childs',
                    'json' => false,
                    'multiple' => false,
                    'required' => false,
                    'validate' => "",
                    'readonly' => false,
                    'disabled' => false,
                    'format' => 'select'
                ),
                array(
                    'title' => 'İşlem Tutarı',
                    'name' => 'amount',
                    'type' => 'text',
                    'class' => 'currency',
                    'grid' => 'col-md-3',
                    'validate' => "",
                    'id' => '',
                    'attribute' => '',
                    'multilang' => false,
                    'required' => true,
                    'readonly' => false,
                    'disabled' => false,
                    'format' => 'text'
                ),
                array(
                    'title' => 'KDV Oranı',
                    'name' => 'tax',
                    'type' => 'number',
                    'class' => '',
                    'grid' => 'col-md-3',
                    'validate' => "",
                    'id' => '',
                    'attribute' => '',
                    'multilang' => false,
                    'required' => true,
                    'readonly' => false,
                    'disabled' => false,
                    'format' => 'text'
                ),
                array(
                    'title' => 'İşlem Detayı',
                    'name' => 'process_desc',
                    'type' => 'text',
                    'class' => '',
                    'grid' => 'col-md-6',
                    'validate' => "",
                    'id' => '',
                    'attribute' => '',
                    'multilang' => false,
                    'required' => true,
                    'readonly' => false,
                    'disabled' => false,
                    'format' => 'text'
                ),
                array(
                    'title' => 'Peryot',
                    'name' => 'period',
                    'type' => ($this->period) ? 'select'  :'',
                    'option' => array(
                        array('id' => 1,'name' => ___('Günlük')),
                        array('id' => 1,'name' => ___('Haftalık')),
                        array('id' => 1,'name' => ___('Aylık')),
                        array('id' => 1,'name' => ___('Yıllık'))
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
                    'title' => 'Peryot Tarihi',
                    'name' => 'process_date',
                    'type' => ($this->period) ? 'date'  :'',
                    'class' => '',
                    'grid' => 'col-md-3',
                    'validate' => "",
                    'id' => '',
                    'attribute' => '',
                    'multilang' => false,
                    'required' => true,
                    'readonly' => false,
                    'disabled' => false,
                    'format' => 'text'
                ),


            );


            return $next($request);
        });


        $this->model = FinanceHistory::class;
        $this->title = ___('Income & Expense');
        $this->button = array(
//            array(
//                'title' => 'Yeni Ekle',
//                'id' => '',
//                'class' =>'',
//                'type' => 'dropdown', // button,link
//                'icon' => '', // button,link
//                'href' => "", // link ise gideceği sayfa
//                'option' => $this->createlink,
//                'onclick' =>'',
//                'color' =>'primary'
//            ),
            array(
                'title' => 'Yeni Ekle',
                'id' => '',
                'class' => '',
                'type' => 'link', // button,link
                'icon' => '', // button,link
                'href' => route($this->routename.'.create'), // link ise gideceği sayfa
                'onclick' => '',
                'color' => 'primary'
            ),
        );
        $this->control = array(

        );
        $this->datatable = array(
            'table' => $this->table,
            'select' => $this->table.'.*',
            'join' => array(),
            'rows' => array(
                array('title' => 'ID','row' => 'id','type' => 'text'),
                array('title' => 'Gelir & Gider Açıklaması','row' => 'process_desc','type' => 'text'),
                array('title' => 'Gelir & Gider Tutarı','row' => 'amount','type' => 'money'),
                array('title' => 'Son İşlem Tarihi','row' => 'updated_at','type' => 'date'),
//                array('title' => 'Kontroller','type' => 'control'),
                array('title' => 'İşlemler','type' => 'button'),
            )
        );

    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $page['title'] = $this->title;
        $page['table'] = route($this->routename.'.show');
        $page['tablerow'] = $this->datatable['rows'];
        $page['button'] = $this->button;


        return view($this->page.'::index',compact('page'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {

        $page['title'] = $this->title.' -> Ekle';
        $page['action'] = route($this->routename.'.store');


        $page['form'] = $this->form;
        $page['multilang'] = $this->multilang;
        return view($this->page.'::form',compact('page'));
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

            $name = Str::slug(request('name'));


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
                    case 'select_json':
                        $data[$validate_control['name']] = request($validate_control['name']) ? json_encode(request($validate_control['name'])): "";
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


            $data['current_id'] = auth('center')->user()->id;





            $create = $this->model::create($data);

            if ($create) {
                $status = "success";
                $message = "İşlem Başarıyla Tamamlandı";
            } else {
                $status = "error";
                $message = "İşlem Sırasında Bir Hata Oluştu";
            }

            return redirect(route($this->routename.'.index'))->with('message', $message)->with('message_type', $status);

        }

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show()
    {
        $lists = $this->model::orderByDesc('created_at')->get()->toArray();
        $output = array();
        $output['aaData'] = array();
        if ($lists) {
            foreach ($lists as $list) {
                $row = array();
                $iEdit = route($this->routename.'.edit',$list['id']);
                $iDestroy = route($this->routename.'.destroy',$list['id']);


                $control = "";

                foreach ($this->control as $item){
                    foreach ($item as $value){
                        if($list[$value['column']] == $value['before']){
                            $control .= '<button  title="'.$value['title'].'"  data-toggle="tooltip" data-id="'.$list['id'].'" data-status="'.$value['status'].'" data-table="'.$value['table'].'"  data-column="'.$value['column'].'"  onclick="ColumnUpdate(this)"  class="btn  '.$value['class'].'  btn-smsharp mr-1 status_update"><i class="'.$value['icon'].'"></i></button>';
                        }
                    }
                }

                /*
                  if ($list['status'] == 0) {
                     $control .= '<button  title="Aktif"  data-toggle="tooltip" data-id="'.$list['id'].'" data-status="1" data-table="'.$this->table.'"  data-column="status"  onclick="ColumnUpdate(this)"  class="btn  btn-light  btn-smsharp mr-1 status_update"><i class="fe fe-check-circle"></i></button>';
                 } else {
                     $control .= '<button  title="Pasif"  data-toggle="tooltip" data-id="'.$list['id'].'" data-status="0" data-table="'.$this->table.'"  data-column="status"  onclick="ColumnUpdate(this)"  class="btn  btn-dark  btn-smsharp mr-1 status_update"><i class="fe fe-check-circle"></i></button>';
                 }
                 if ($list['listening'] == 0) {
                     $control .= '<button  title="Listelemede Göste"  data-toggle="tooltip" data-id="'.$list['id'].'" data-status="1" data-table="'.$this->table.'"  data-column="listening"  onclick="ColumnUpdate(this)"  class="btn  btn-light  btn-smsharp mr-1 status_update"><i class="fe fe-check-circle"></i></button>';
                 } else {
                     $control .= '<button  title="Listelemede Gösterme"  data-toggle="tooltip" data-id="'.$list['id'].'" data-status="0" data-table="'.$this->table.'"  data-column="listening"  onclick="ColumnUpdate(this)"  class="btn  btn-dark  btn-smsharp mr-1 status_update"><i class="fe fe-check-circle"></i></button>';
                 }
                 */


                $button = "";
                $button .= '<a href="' . $iEdit . '" target="_self" class="btn btn-primary  btn-smsharp mr-1" title="Düzenle" data-toggle="tooltip" ><i class="ri-edit-box-line"></i></a>';
                $button .= '<a href="' . $iDestroy . '" target="_self" class="btn btn-danger  btn-smsharp mr-1" title="Sil" data-toggle="tooltip" ><i class="ri-delete-bin-5-line"></i></a>';



                foreach ($this->datatable['rows'] as $item){
                    switch ($item['type']){
                        case 'text':
                            $row[] = $list[$item['row']];

                            break;
                            case 'money':
                            $row[] = currency($list[$item['row']]);

                            break;
                        case 'multilang':
                            $row[] =getlanguage($list[$item['row']],get_language());
                            break;
                        case 'path':

                            $menu =  Menu::where('id',$list[$item['row']])->get()->first();

                            $row[] = $this->getParentsTree($menu,getlanguage($menu->name,get_language()));
                            break;
                        case 'date':
                            $row[] = date('Y-m-d H:i',strtotime($list[$item['row']]));
                            break;
                    }
                }

//                $row[] = $control;
                $row[] = $button;

                $output['aaData'][] = $row;

            }
        }

        return json_encode($output);
    }
    public function getParentsTree($menu, $name)
    {
        if ($menu['parent_id'] == null) {
            return $name;
        }

        $parent = $this->model::find($menu['parent_id']);
        $name = getlanguage($parent['name'], get_language()) . ' > ' . $name;

        return $this->getParentsTree($parent, $name);
    }
    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $page['title'] = $this->title.' -> Düzenle';
        $page['action'] = route($this->routename.'.update',$id);
        $page['row'] = $this->model::find($id);
        $page['multilang'] = $this->multilang;

        $this_element = json_decode($page['row']['this_elements'],true);


        $new_form = array();
        foreach ($this->form as $item){
            if(isset($item['name'])){
                if(in_array($item['name'],array_values($this_element))){
                    $new_form[] =  $item;
                }
            }
        }

        $page['form'] = $new_form;




        return view($this->page.'::form',compact('page'));
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

            $name = Str::slug(request('name'));
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
                    case 'none':
                        $data[$validate_control['name']] =  $request->input($validate_control['name']);
                        break;
                    case 'select':
                        $data[$validate_control['name']] = request($validate_control['name']) ? request($validate_control['name']): 0;
                        break;
                    case 'select_json':
                        $data[$validate_control['name']] = request($validate_control['name']) ? json_encode(request($validate_control['name'])): "";
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
            $entry = $this->model::where('id', $id)->firstOrFail();
            $update = $entry->update($data);
            if ($update) {
                $status = "success";
                $message = "İşlem Başarıyla Tamamlandı";
            } else {
                $status = "error";
                $message = "İşlem Sırasında Bir Hata Oluştu";
            }
            return redirect(route($this->routename.'.index'))
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
        $destroy = $this->model::destroy($id);

        if ($destroy) {
            $status = "success";
            $message = "İşlem Başarıyla Tamamlandı";
        } else {
            $status = "error";
            $message = "İşlem Sırasında Bir Hata Oluştu";
        }
        return redirect(route($this->routename.'.index'))
            ->with('message', $message)
            ->with('message_type', $status);
    }


    public function report(Request $request)
    {

        $year = ($request->year) ? $request->year : date('Y');
        $start = ($request->start) ? $request->start : "";
        $end = ($request->end) ? $request->end : "";
        $group = ($request->group) ? $request->group : "";
        $page['year'] = $year;
        $page['group'] = $group;
        $page['start'] = $start;
        $page['end'] = $end;


        $page['group'] = FinanceGroup::where(["current_id" => $this->center])->get()->toArray();

        $auth = auth('center')->user()->id;

        $sales = array();
        $pending = array();
        $cancel = array();
        foreach (getmonth() as $month => $value){
            $sale_query =  FinanceHistory::where('type',1)->whereRaw('YEAR(created_at) = ?',[$year])->whereRaw('MONTH(created_at) = ?',[$month])->where('current_id',$auth);

            if(!empty($group)){
                $sale_query = $sale_query->where('group_id',$group);
            }
            $sale_query = $sale_query->sum('amount');


            $sales[] = array(
                'x' =>$value,
                'y' => $sale_query
            );

            $pending_query =  FinanceHistory::where('type',0)->whereRaw('YEAR(created_at) = ?',[$year])->whereRaw('MONTH(created_at) = ?',[$month])->where('current_id',$auth);

            if(!empty($group)){
                $pending_query = $pending_query->where('group_id',$group);
            }
            $pending_query = $pending_query->sum('amount');


            $pending[] = array(
                'x' =>$value,
                'y' => $pending_query
            );

        }



        return view('finance::report',compact('page','sales','pending'));
    }

}
