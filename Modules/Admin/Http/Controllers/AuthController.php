<?php

namespace Modules\Admin\Http\Controllers;
use App;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Admin\Entities\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AuthController extends Authenticatable
{
    public function index(){


        if(Auth::guard('manager')->check()) {
            return  redirect()->route('dashboard');
        }
        if(request()->isMethod('POST')) {

            request()->validate([
                'email' => 'required|email',
                'password' => 'required|min:8|max:60',
            ]);

            $credentials = [
                'email' => request()->get('email'),
                'password' => request()->get('password'),
            ];

            if(Auth::guard('manager')->attempt($credentials, request()->has('remember_me')))
            {

                return redirect()->route('dashboard');
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

        return redirect('');
    }

}