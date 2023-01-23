<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Illuminate\Http\Request;

class AuthDepartamentoCheck
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
        if(!Session::has('loginId')){
            return redirect()->route('departamento.login')->with('fail','Favor de iniciar sesión primero.');
        }else if(Session::get('tipo') != 'Jefe de departamento'){
            return redirect()->route('seleccion')->with('fail','Favor de iniciar sesión como jefe de departamento');
        }
        return $next($request);
    }
}
