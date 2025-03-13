<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        # after login
        if(Auth::user()) 
        {
            if( $request->route()->getName() == 'login' || $request->route()->getName() == 'register')
            {
                return back();
            } 
        }
        # before login
        else
        {
            return $next($request);
        }
       
    }
}
