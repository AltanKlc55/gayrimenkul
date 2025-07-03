<?php

namespace Modules\employee\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Employee\Entities\Employee;
use Modules\Employee\Entities\EmployeeFile;
use Modules\Employee\Entities\EmployeeLeave;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use  Modules\Project\Entities\Project;


class EmployeeController extends Controller
{
    private $table = "employee";
    private $page = "employee";
    private $routename= "employee";
    private $title;

    public function __construct()
    {
        $this->model = Employee::class;

        $this->title = ___('Employee');
        $this->button = array(
            array(
                'title' => ___('Add New Employee'),
                'id' => '',
                'class' =>'',
                'type' => 'link', // button,link
                'icon' => '', // button,link
                'href' => route('employee.create'), // link ise gideceği sayfa
                'onclick' =>'',
                'color' =>'primary'
            ),
        );
        $this->control = array(

        );

        $this->datatable = array(
            'table' => $this->table,
            'select' => array(
                $this->table.'.*',

                DB::raw('CONCAT(employee.name, " ", employee.surname) as namesurname'),
            ),
            'join' => array(

            ),
            'rows' => array(
                array('title' => 'ID', 'row' => 'id', 'type' => 'text'),
                array('title' => ___('Name Surname'), 'row' => 'namesurname', 'type' => 'link'),
                array('title' => ___('E-Mail'), 'row' => 'email', 'type' => 'link'),
                array('title' => ___('Departman'), 'row' => 'department', 'type' => 'get_definition'),
                array('title' => ___('Pozisyon'), 'row' => 'position', 'type' => 'get_definition'),
                array('title' => ___('Personel Tanımı'), 'row' => 'personel_type', 'type' => 'get_definition'),
               // array('title' => ___('Last Process Date'), 'row' => 'updated_at', 'type' => 'date'),
                array('title' => ___('Controls'), 'type' => 'button'),
            )
        );



        $this->form  = array(
            array(
                'title' =>  ___('Adı'),
                'name' => 'name',
                'type' => 'text',
                'class' => '',
                'grid' => 'col-md-4',
                'validate' => 'required|min:2|max:255',
                'id' => '',
                'attribute' => '',
                'required' => true,
                'readonly' => false,
                'disabled' => false,
                'format' => 'text'
            ),
            array(
                'title' =>  ___('Soyadı'),
                'name' => 'surname',
                'type' => 'text',
                'class' => '',
                'grid' => 'col-md-4',
                'validate' => 'required|min:2|max:255',
                'id' => '',
                'attribute' => '',
                'required' => true,
                'readonly' => false,
                'disabled' => false,
                'format' => 'text'
            ),
            array(
                'title' =>  ___('E-Mail'),
                'name' => 'email',
                'type' => 'text',
                'class' => '',
                'grid' => 'col-md-4',
                'validate' => 'required|min:2|max:255',
                'id' => '',
                'attribute' => '',
                'required' => true,
                'readonly' => false,
                'disabled' => false,
                'format' => 'text'
            ),
            array(
                'title' => 'Personel Tanımı',
                'name' => 'personel_type',
                'type' => 'select',
                'child' => 'title',
                'option' =>  get_definitions('personel_type'),
                'class' => 'select2',
                'grid' => 'col-md-3',
                'id' => '',
                'json' => false,
                'multiple' => false,
                'required' => true,
                'validate' => "",
                'readonly' => false,
                'disabled' => false,
                'format' => 'select'
            ),
            array(
                'title' => 'Departman',
                'name' => 'department',
                'type' => 'select',
                'child' => 'title',
                'option' =>  get_definitions('department'),
                'class' => 'select2',
                'grid' => 'col-md-3',
                'id' => '',
                'json' => false,
                'multiple' => false,
                'required' => true,
                'validate' => "",
                'readonly' => false,
                'disabled' => false,
                'format' => 'select'
            ),
            array(
                'title' => 'Pozisyon',
                'name' => 'position',
                'type' => 'select',
                'child' => 'title',
                'option' =>  get_definitions('position'),
                'class' => 'select2',
                'grid' => 'col-md-3',
                'id' => '',
                'json' => false,
                'multiple' => false,
                'required' => true,
                'validate' => "",
                'readonly' => false,
                'disabled' => false,
                'format' => 'select'
            ),
            array(
                'title' => 'İşe Giriş Tarihi',
                'name' => 'start_date',
                'type' => 'date',
                'entry' => date('Y-m-d'),
                'class' => '',
                'grid' => 'col-md-3',
                'validate' => '',
                'id' => '',
                'multilang' => false,
                'attribute' => '',
                'required' => false,
                'readonly' => false,
                'disabled' => false,
                'format' => 'text'
            ),

        );
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    public function index()
    {
        $page['title'] = $this->title.' | '.___('List');
        $page['table'] = route('employee.show');
        $page['tablerow'] = $this->datatable['rows'];
        $page['button'] = $this->button;

        return view('employee::index',compact('page'));
    }


    public function detail($id)
    {
        $page['title'] = $this->title.' | '.___('Detay');
        $page['button'] = $this->button;
        $page['employee'] = Employee::find($id);
        $page['start_date'] = Carbon::parse($page['employee']->star_date)->format('Y-m-d');
        $page['sum_leave'] = EmployeeLeave::where('employee_id', $id)->sum('leave_day');
        $page['employee_leave'] = EmployeeLeave::where('employee_id', $id)->get();
        $page['employee_file'] =  EmployeeFile::where('employee_id', $id)->get();

        return view('employee::detail',compact('page'));
    }
    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {

        $page['title'] = $this->title.' | '.___('Add');
        $page['action'] = route('employee.store');


        $page['form'] = $this->form;
        $page['form'][] =   array(
            'title' => ___('Şifresi'),
            'name' => 'password',
            'type' => 'password',
            'class' => '',
            'grid' => 'col-md-3',
            'validate' => 'required|min:8|max:255',
            'id' => '',
            'attribute' => '',
            'required' => false,
            'readonly' => false,
            'disabled' => false,
            'format' => 'password'
        );
        return view('employee::form',compact('page'));
    }

    public function notification()
    {
        $page['title'] = $this->title.' | '.___('Notification');
        return view('employee::notification',compact('page'));
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


            $this->form[] =   array(
                'title' => ___('Password'),
                'name' => 'password',
                'type' => 'password',
                'class' => '',
                'grid' => 'col-md-3',
                'validate' => 'required|min:8|max:255',
                'id' => '',
                'attribute' => '',
                'required' => false,
                'readonly' => false,
                'disabled' => false,
                'format' => 'password'
            );
            foreach ($this->form as $key => $validate_control){
                switch ($validate_control['format']){
                    case 'text':
                        $data[$validate_control['name']] = request($validate_control['name']);
                        break;
                    case 'password':
                        $data[$validate_control['name']] = Hash::make(request($validate_control['name']));
                        break;
                    case 'json':
                        $data[$validate_control['name']] = json_encode(request($validate_control['name']),true);
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
                            $imageName = time().$key.'.'.$image->extension();
                            $image->move(public_path('./'.$validate_control['path']), $imageName);
                            $data[$validate_control['name']] = $imageName;
                        }
                        break;
                }
            }


            $create = Employee::create($data);

            if ($create) {
                $status = "success";
                $message = ___("Transaction Completed Successfully");
            } else {
                $status = "error";
                $message = ___("An error occurred during the operation");
            }

            return redirect(route('employee.index'))->with('message', $message)->with('message_type', $status);

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
         $data['where'] = array();
        $data['join']  =  $this->datatable['join'];
        $lists = dataTable($data,$iDisplayStart,$iDisplayLength,$sSearch,$aColumns);


//        $lists = Employee::orderByDesc('created_at')->where('authority','!=',1)->get()->toArray();
        $output = array();
        $output['aaData'] = array();
        if ($lists) {
            foreach ($lists as $list) {
                $row = array();
                $iEdit = route('employee.edit',$list['id']);
                $iDestroy = route('employee.destroy',$list['id']);
                $iEmployeeFiles = route('employee_file.index',$list['id']);
                $iEmployeeLeave = route('employee_leave.index',$list['id']);
                $iReport = route('employee.report',$list['id']);

                $control = "";

                foreach ($this->control as $item){
                    foreach ($item as $value){
                        if($list[$value['column']] == $value['before']){
                            $control .= '<button  title="'.$value['title'].'"  data-toggle="tooltip" data-id="'.$list['id'].'" data-status="'.$value['status'].'" data-table="'.$value['table'].'"  data-column="'.$value['column'].'"  onclick="ColumnUpdate(this)"  class="btn  '.$value['class'].'  btn-smsharp mr-1 status_update"><i class="'.$value['icon'].'"></i></button>';
                        }
                    }
                }



                $button = "";
                $button .= '<a href="' . $iReport . '" target="_self" class="btn btn-dark  btn-smsharp mr-1" title="Rapor" data-toggle="tooltip" ><i class="ri-pie-chart-2-line"></i></a>';

                $button .= '<a href="' . $iEmployeeFiles . '" target="_self" class="btn btn-dark  btn-smsharp mr-1" title="'.___('Employee File ').'" data-toggle="tooltip" ><i class="ri-file-line"></i></a>';
                $button .= '<a href="' . $iEmployeeLeave . '" target="_self" class="btn btn-dark  btn-smsharp mr-1" title="'.___('Employee Leave ').'" data-toggle="tooltip" ><i class="ri-calendar-check-line"></i></a>';
                $button .= '<a href="' . $iEdit . '" target="_self" class="btn btn-primary  btn-smsharp mr-1" title="'.___('Edit').'" data-toggle="tooltip" ><i class="ri-edit-box-line"></i></a>';



                $button .= '<button type="button" class="btn btn-danger btn-smsharp mr-1 delete-btn" data-href="' . $iDestroy . '" title="Sil" data-toggle="tooltip">
                                <i class="ri-delete-bin-5-line"></i>
                            </button>';

//                $button .= '<a href="' . $iDestroy . '" target="_self" class="btn btn-danger  btn-smsharp mr-1" title="'.___('Delete').'" data-toggle="tooltip" ><i class="ri-delete-bin-5-line"></i></a>';



                foreach ($this->datatable['rows'] as $item){
                    switch ($item['type']){
                        case 'text':
                            $row[] = $list[$item['row']];
                            break;
                        case 'path':
                            $row[] = $this->getParentsTree($list,$list['name']);
                            break;
                        case 'get_definition':
                            $row[] =  get_definition($list[$item['row']]);
                            break;
                        case 'link':
                            $row[] = '<a href="'.route('employee.detail',$list['id']).'">'.$list[$item['row']].'</a>';
                            break;
                        case 'date':
                            $row[] = date('Y-m-d H:i',strtotime($list[$item['row']]));
                            break;
                    }
                }

                if($control){
                    $row[] = $control;
                }
                if($button){
                    $row[] = $button;
                }

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
        $page['title'] = $this->title.' | '.___('Edit');
        $page['action'] = route('employee.update',$id);
        $page['row'] = Employee::find($id);
        $page['form'] = $this->form;
        $page['form'][] =   array(
            'title' => ___('Şifresi'),
            'name' => 'password',
            'type' => 'password',
            'class' => '',
            'grid' => 'col-md-3',
            'validate' => '',
            'id' => '',
            'attribute' => '',
            'required' => false,
            'readonly' => false,
            'disabled' => false,
            'format' => 'password'
        );
        return view('employee::form',compact('page'));
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
            $this->form[] =   array(
                'title' => ___('Password'),
                'name' => 'password',
                'type' => 'password',
                'class' => '',
                'grid' => 'col-md-3',
                'validate' => '',
                'id' => '',
                'attribute' => '',
                'required' => false,
                'readonly' => false,
                'disabled' => false,
                'format' => 'password'
            );
            foreach ($this->form as $key => $validate_control){
                switch ($validate_control['format']){
                    case 'text':
                        $data[$validate_control['name']] = request($validate_control['name']);
                        break;
                    case 'password':
                        if(request($validate_control['name'])){
                            $data[$validate_control['name']] = Hash::make(request($validate_control['name']));
                        }
                        break;

                    case 'json':
                        $data[$validate_control['name']] = json_encode(request($validate_control['name']),true);
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
                            $imageName = time().$key.'.'.$image->extension();
                            $image->move(public_path('./'.$validate_control['path']), $imageName);
                            $data[$validate_control['name']] = $imageName;
                        }
                        break;
                }
            }


            $entry = Employee::where('id', $id)->firstOrFail();

            $update = $entry->update($data);

            if ($update) {
                $status = "success";
                $message = ___("Transaction Completed Successfully");
            } else {
                $status = "error";
                $message = ___("An error occurred during the operation");
            }
            return redirect(route('employee.index'))
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
        $destroy = Employee::destroy($id);

        if ($destroy) {
            $status = "success";
            $message = ___("Transaction Completed Successfully");
        } else {
            $status = "error";
            $message = ___("An error occurred during the operation");
        }

        return redirect(route('employee.index'))
            ->with('message', $message)
            ->with('message_type', $status);
    }

    public function sendNotification(Request $request)
    {
        $notificationType = $request->input('notification_type');
        $message = $request->input('message');
        $employeeIds = $request->input('employee_ids', []);
        $groupIds = $request->input('group_ids', []);

        switch ($notificationType) {
            case 'all':
                // Tüm çalışanlara bildirim gönder
                $employees = DB::table('employee')->get();
                break;
            case 'group':
                // Belirli gruplara bildirim gönder
                $employees = DB::table('employee')
                    ->whereIn('group', $groupIds)
                    ->get();
                break;
            case 'individual':
                // Tek tek çalışanlara bildirim gönder
                $employees = DB::table('employee')
                    ->whereIn('id', $employeeIds)
                    ->get();
                break;
            default:
                return response()->json(['error' => 'Invalid notification type'], 400);
        }

        foreach ($employees as $employee) {
            DB::table('notifications')->insert([
                'employee_id' => $employee->id,
                'notification_type' => $notificationType,
                'message' => $message,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
        return redirect(route('employee.index'))
            ->with('message', "Notifications sent successfully")
            ->with('message_type', "success");

    }


    public function report(Request $request,$id)
    {

        $year = ($request->year) ? $request->year : date('Y');
        $start = ($request->start) ? $request->start : date('Y-m-01');
        $end = ($request->end) ? $request->end :  date('Y-m-t');
        $page['year'] = $year;
        $page['start'] = $start;
        $page['end'] = $end;
        $page['id'] = $id;

        $result = $this->model::find($id);


        $page['title'] = $this->title.' -> '.$result->name.' '.$result->surname.' -> Rapor';
        $page['row'] =$result;

        $page['task_time'] = getSum('task',array(['user',$id]),'task_time',array('task_date',$start,$end));
        $page['leave'] = getSum('employee_leave',array(['employee_id',$id]),'leave_day',array('start_date',$start,$end));
        $page['person'] = get_table_count('task',array('where' => [['user',$id]],'distinct' => 'project_id','whereBetween' => ['task_date',$start,$end]));
        $page['task'] = get_table_count('task',array('where' => [['user',$id]],'distinct' => 'task_id','whereBetween' => ['task_date',$start,$end]));

        $user = array();
        foreach (getQuery('task',array('groupBy'=> 'project_id','where' => [['user',$id]],'selectRaw' => array('SUM(task_time) as time'),'select' => array('project_id'),'whereBetween' => ['task_date',$start,$end])) as $item){
            $get_project = Project::where('id',$item['project_id'])->first();
            $user[] = array(
                'id' => $item['project_id'],
                'name' => ($get_project) ? $get_project['title'].' ('.converttime($item['time']).')' : '',
                'time' => converttime_notext($item['time']),
                'color' => randColor(),
            );
        }

        $work = array();
        foreach (getQuery('task',array('groupBy'=> 'task_id','where' => [['user',$id]],'selectRaw' => array('SUM(task_time) as time'),'select' => array('task_id'),'whereBetween' => ['task_date',$start,$end])) as $item){
            $get_task = get_definition($item['task_id']);
            $work[] = array(
                'id' => $item['task_id'],
                'name' => $get_task.' ('.converttime($item['time']).')',
                'time' => converttime_notext($item['time']),
                'color' => randColor(),
            );
        }

        return view($this->page.'::report',compact('page','user','work'));
    }



}