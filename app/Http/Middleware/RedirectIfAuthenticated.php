<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            return redirect('/admin');
        }
        else
        {
            return redirect()->action('AdminController@adminLogin')->with('flash_message_error', 'Please login to access.');
        }

        if(empty(Session::has('Auth')))
        {
            return redirect('/admin');
        }

        return $next($request);
    }
}
