<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admin\Entities\Roles;
use Modules\Admin\Entities\Permissions;
use Modules\Admin\Entities\HasPermision;
use Illuminate\Support\Facades\DB;

class HasPermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index($id)
    {

        $page['title'] = ___('Permission Control');


        $group = Permissions::groupBy('group')->where('status',0)->get()->toArray();


        $permissions = array();
        foreach ($group as $value){
            $permissions[$value['group']] = Permissions::where('group' ,$value['group'])->groupBy('group_control')->get()->toArray();
        }
       $page['roles'] = $permissions;
       $page['role'] = $id;
        return view('admin::permission',compact('page'));
    }


    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store($id)
    {
        if (request()->isMethod('POST')) {
            HasPermision::where('role_id', $id)->delete();
           foreach ($_POST['permissions'] as $key => $value){
               foreach ($value as $value){
                   $group = Permissions::where(['group' => $key,'group_control' => $value])->select('id')->get()->toArray();
                   foreach ($group as $item){
                       $create =  HasPermision::create(array('role_id' => $id,'permission_id' => $item['id']));
                   }

               }
           }
            if ($create) {
                $status = "success";
                $message = ___("Transaction Completed Successfully");
            } else {
                $status = "error";
                $message = ___("An error occurred during the operation");
            }

            return redirect(route('roles.index'))->with('message', $message)->with('message_type', $status);

        }

    }
}