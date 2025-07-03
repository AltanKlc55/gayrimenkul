<?php

namespace Modules\Admin\Http\Controllers;

/*
use Modules\Admin\Entities\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\UserProvider;
use  Illuminate\Contracts\Auth\Authenticatable;
*/

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Admin\Entities\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(){


        if(Auth::guard('manager')->check()) {
            return  redirect()->route('manager.dashboard');
        }
        if(request()->isMethod('POST')) {

            $this->validate(request(), [
                'email' => 'required|email',
                'password' => 'required|min:8|max:60',
            ]);

            $credentials = [
                'email' => request()->get('email'),
                'password' => request()->get('password'),
            ];

            if(Auth::guard('manager')->attempt($credentials, request()->has('remember_me')))
            {
                return redirect()->route('manager.dashboard');
            }
            else {

                return back()->withInput()->withErrors(['email'=>'Giriş Hatalı!']);

            }

        }


        return view('admin::auth');
    }

    public function logout(){
        Auth::guard('manager')->logout();
        request()->session()->flush();
        request()->session()->regenerate();

        return redirect('manager');
    }

}