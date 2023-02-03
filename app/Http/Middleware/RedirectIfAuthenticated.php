<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        if(Auth::guard($guards)->check()){
            $user_type = Auth::user()->user_type;
            switch($user_type){
                case 1:
                    return redirect('/admin');
                    break;
                default:
                    return redirect('/');
                    break;
            }
        }

        return $next($request);
    }
}
