<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class VerifyAdmin
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
        if(Auth::user()->roles()->where('role_id', 1)->first()){
            return $next($request);
        }

        //TODO redirect to page with info about no access pertmission
        return redirect()->back()->with("message", "Access denied")->with("message_type", "danger");
    }
}
