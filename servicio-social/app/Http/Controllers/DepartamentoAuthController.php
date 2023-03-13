<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Hash;
use Session;
use App\Models\JefeDepartamento;
use App\Models\Departamento;

class DepartamentoAuthController extends Controller
{
    /*
    * @brief Función que validad si no hay una sesión iniciada en el sistema, en caso de no haber retorna la vista de login
    * @brief en caso de haber regresa a la vista anterior
    * @return Vista de login de coordinador
    */
    public function login(){
        Session::forget('succes');
        if(Session::has('loginId')){
            return back();
        }
        return view("auth.departamento_login");
    }

    /*
    * @brief Función encargada de eliminar las variables de sesión y retornar la vista de login
    * @return Retorna la vista de login del coordinador
    */
    public function logout(){
        if(Session::has('loginId')){
            //Eliminamos las variables de sesión
            Session::flush();         
        }
        return redirect()->route('departamento.login');
    }

    /*
    * @brief Función encargada de validar y generar el ingreso de sesión del usuario coordinador
    * @param Objeto de tipo request con los datos ingresados por el usuario
    * @return En caso de ingresar credenciales correctas retorna la vista home de coordinador
    * @return con un objeto de sesión creados. En caso de ser erróneo se retorna a la vista anterior.
    */
    public function loginUser(Request $request){
        //Validamos que se ingresó el usuario y la contraseña con los formatos adecuados
        $request->validate([
            'usuario' => 'required',
            'contraseña' => 'required|min:12',
        ]);
        //Buscamos al jefe de departamento con el uid ingresado
        $user = JefeDepartamento::where('uid',$request->usuario)->first();
        if($user){
            //Buscamos que el hash de las contraseñas coincida
            if(Hash::check($request->contraseña,$user->contraseña)){
                //Creamos la sesión con el id del usuario
                $request->session()->put('loginId',$user->id);
                //Ingresamos la variable de sesión de tipo
                $request->session()->put('tipo','Jefe de departamento');
                $departamento = Departamento::where('jefe_departamento_id',$user->id)->first();
                //Indicamos el departamento del coordinador y lo guardamos en la sesión.
                $request->session()->put('departamento',$departamento->getAbreviatura());
                return redirect('departamento/home');
            }else{
                return back()->with('fail','Contraseña errónea.');    
            }
        }else{
            return back()->with('fail','Este usuario no está registrado.');
        }
    }

}

