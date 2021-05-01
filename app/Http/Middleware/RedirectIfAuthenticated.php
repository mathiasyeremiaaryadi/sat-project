<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
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
        if($guard == 'admin' && auth($guard)->check()) {
            return redirect()->route('admins.dashboard.index');
        } 
        
        if($guard == 'customer' && auth($guard)->check()) {
            return redirect()->route('customers.shopping.index');
        }

        return $next($request);
    }
}


