<?php

namespace App\Http\Middleware;

// use Illuminate\Support\Facades\Auth;
use Closure;

class Admin
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
        // $data = Auth::user();
        // echo "<pre>"; print_r($data); die;
        // if(auth()->user()  && $request->user()->admin == 1){
        //     // return $next($request);
        //     return redirect()->guest('/login');
        // }
        return $next($request);
        
    }
}
