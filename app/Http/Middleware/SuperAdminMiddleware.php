<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SuperAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        //this stage is login stage, so we can use Auth
        // if (Auth::user()->role == 'superadmin')
        // {
        //     return $next($request);
        // }

        // return back()->with(['authMessage'=>'You are super admin!']);

    }
}
