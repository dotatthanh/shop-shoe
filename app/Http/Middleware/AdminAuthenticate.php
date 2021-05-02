<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'admin')
    {
        $segments = $request->segments();
        $currentURL = implode('/', $segments);
        
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                if ($currentURL != 'admin/login') {
                    $request->session()->put('admin_redirect_url', $currentURL);
                }

                return redirect('admin/login');
            }
        }
        return $next($request);
    }
}
