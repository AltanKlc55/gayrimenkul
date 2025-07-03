<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Modules\Language\Entities\Language;

class SetLang
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


            if (session()->has('lang')) {
                app()->setLocale(session()->get('lang'));
            } else {
                $defaultLang =  Language::where('default',1)->first();

                if (!empty($defaultLang)) {
                    app()->setLocale($defaultLang->slug);
                }
            }
            return $next($request);
      



    }
}