<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthAlumnoCheck
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
        if(!Session()->has('loginId')){
            return redirect()->route('alumno.login')->with('fail','Favor de iniciar sesión primero.');
        }
        return $next($request);
    }
}
