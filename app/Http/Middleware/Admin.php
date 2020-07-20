<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Admin extends Authenticatable
{

    public function handle($request, Closure $next)
    {

        if (Auth::check() && Auth::user()->isAdmin() == "true") {
            return $next($request);
        }

        return redirect('/');
    }
}
