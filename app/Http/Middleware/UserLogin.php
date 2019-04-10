<?php

namespace App\Http\Middleware;
use Closure;
Use Session;

class UserLogin
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
        if(empty(Session::has('UserSession')))
        {
            return redirect('/login');
        }
        return $next($request);
    }
}
