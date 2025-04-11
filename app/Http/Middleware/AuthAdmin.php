<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class AuthAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // dd('AuthAdmin middleware is running for: ' . $request->fullUrl());

        if(Auth::check())
        {
            if(Auth::user()->role=='ADM')
            {
                dd('saaa');

                return $next($request);
            }
            else{
                     dd('saaxs');

                Session::flush();
                return redirect()->route('login');
            }
        }
        else{
            dd('aaaa');
            return redirect()->route('login');
        }
    }
}
