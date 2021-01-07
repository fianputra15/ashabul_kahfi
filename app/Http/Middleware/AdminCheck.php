<?php

namespace App\Http\Middleware;

use Closure;

class AdminCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->session()->has("users")){
            if($request->session()->get("users")['status'] != "1") {
                return $next($request);
            }
        }else{
            return redirect('login')->with('failed',"Silahkan Login Terlebih Dahulu");
        }
        return $next($request);
    }
}
