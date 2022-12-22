<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckLoginUser
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

        if(Auth::guard('web')->check())
        {
            return $next($request);
        }
        return redirect('/');
    }
}
