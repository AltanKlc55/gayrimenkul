<?php

namespace Modules\ExpertPanel\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ExpertPanel\Entities\ExpertUser;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;


class ExpertAuthController extends Authenticatable
{
    public function index(){


        if(Auth::guard('expert')->check()) {
            return  redirect()->route('expertdashboard');
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

            if(Auth::guard('expert')->attempt($credentials, request()->has('remember_me')))
            {
                return redirect()->route('expertdashboard');
            }
            else {
                return back()->withInput()->withErrors(['email'=>'Giriş Hatalı!']);
            }
        }
        return view('expertpanel::auth');
    }

    public function logout(){
        Auth::guard('expert')->logout();
        request()->session()->flush();
        request()->session()->regenerate();

        return view('expertpanel::auth');
    }
}
