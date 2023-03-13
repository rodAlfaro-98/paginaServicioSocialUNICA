<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class SeleccionUsuarioController extends Controller
{
    /*
    * @brief Función encargada de validar que no haya una sesión inicada y de retornar la vista
    * @brief de selección de tipo de usuario.
    * @return Si hay sesión iniciada y es de un alumno retorna el home del alumno
    * @return Si hay sesión iniciada y es de un coordinador retorna el home del coordinador
    * @return Si no hay sesión iniciada retorna la vista de selección de usuario
    */
    public function seleccionPage(){
        //Vemos si hay un usuario en las variables de sesión
        if(Session::has('loginId')){
            //Vemos el tipo de usuario con sesión creada
            if(strcmp(Session::get('tipo'),'alumno') == 0){
                return redirect()->route('alumno.home');
            }else{
                return redirect()->route('departamento.home');
            }
        }

        return view("seleccionUsuario");
    }
}
