<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class SeleccionUsuarioController extends Controller
{
    public function seleccionPage(){
        if(Session::has('loginId')){
            if(strcmp(Session::get('tipo'),'alumno') == 0){
                return redirect()->route('alumno.home');
            }else{
                return redirect()->route('departamento.home');
            }
        }

        return view("SeleccionUsuario");
    }
}
