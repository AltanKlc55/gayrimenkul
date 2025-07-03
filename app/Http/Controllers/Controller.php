<?php

namespace App\Http\Controllers;
use App\Services\TranslationService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use App\Providers;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function __construct()
    {
    }
    public function ColumnStatusUpdate($id,$status,$table,$column){
        $query =  DB::table($table)
            ->where('id', $id)
            ->update([$column => $status]);

        if($query){return true;}else{return false;}
    }

}