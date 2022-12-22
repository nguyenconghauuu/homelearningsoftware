<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class CheckLoginAdmin
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
        // kiem tra login admin
        // neu chua login thi redirect ve trang login

        $checkAdmin = Auth::guard('admins')->check();
        if( ! $checkAdmin )
        {
            return redirect()->route('admin.login');
        }
        return $next($request);
    }
}
