<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AdminRedirectIfNotAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        //return $next($request);
        if (!Auth::guard('admin')->check()) {
            return redirect('/admin/login');
        }
        return $next($request);
    }
}
