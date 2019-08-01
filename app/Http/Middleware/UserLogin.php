<?php

namespace App\Http\Middleware;
use App\User;
use Closure;
Use Session;
use Illuminate\Support\Facades\Auth;


class UserLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role=null)
    {
        if(empty(Session::has('UserSession')))
        {
            return redirect('/login');
        }
        // return $next($request);

        // if(!$request->user()->hasRole($role)){
        //     // return redirect()->guest('/login');
        //     return redirect('/');
        // }
        return $next($request);
    }
}
