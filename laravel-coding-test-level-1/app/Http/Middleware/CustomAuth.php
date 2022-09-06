<?php

namespace App\Http\Middleware;

use Session;
use Closure;
use Illuminate\Http\Request;

class CustomAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $path = $request->path();
        if(($path == 'login' || $path == 'register') && Session::get('user'))
        {
            return redirect('events');
        }
        else if(($path !='login' && $path != 'register') && !Session::get('user'))
        {
            return redirect('login');
        }

        return $next($request);
    }
}
