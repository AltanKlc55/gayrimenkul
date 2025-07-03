<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;
use Modules\Admin\Entities\Permissions;
use Modules\Admin\Entities\Roles;

class Permision
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

       $roles = Roles::where('default',1)->first();
        if (strpos($request->path(), 'manager') === 0  and $request->route()->getName() != "logout") {

            if(Auth::guard('manager')->check()) {
                $request->merge(['user' => auth()->guard('manager')->user()]);

                if (strpos($request->path(), 'manager/has-permission') === 0 or strpos($request->path(), 'manager/dashboard') === 0 or auth('manager')->user()->authority === $roles->id) {
                    return $next($request);
                } else {
                    $url = $request->route()->getName();
                    if (is_permision($url)){
                        return $next($request);
                    } else {
                
  return  redirect()->route('not_auth');
                    }
                }
                }
            else {
                return  redirect()->route('auth');
            }

        } else {
            return $next($request);
        }

        



    }
}