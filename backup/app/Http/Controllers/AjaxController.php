<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AjaxController extends Controller
{

    public function Update(Request $request)
    {

        if (request()->isMethod('POST')) {
            $data = $request->all();

            $insert = $this->ColumnStatusUpdate($data['id'],$data['status'],$data['table'],$data['column']);

            if($insert){
                return response()->json(['success'=>'İşlem Başarıyla Gerşekleşti']);
            } else {
                return response()->json(['error'=>'Beklenmedik Bir Hata Oluştu,Sistem Yöneticisine Başvurun']);
            }
        }
    }
}