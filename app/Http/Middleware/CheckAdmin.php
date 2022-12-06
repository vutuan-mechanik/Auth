<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class CheckAdmin
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
        //Sau nay add them role de check permission
        // if (Auth::check() && Auth::user()->is_active == 1 && Auth::user()->status==1 && Auth::user()->is_admin==1)

        if (Auth::check() && Auth::user()->is_active == 1 && Auth::user()->status==1) {
            return $next($request);
        } else {
            return redirect("/manage/user/login");
        }
    }
}
