<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;
use Hash;
use Session;
use Redirect;
use Validator;
use Exception;
use App\Models\Alumno;
use App\Models\Carrera;
use App\Models\Estado;
use App\Models\HistoricoEstado;
use Carbon\Carbon;
use App\Mail\Registro;
use App\Mail\CambioContraseña;
use App\Mail\Peticion;
use Illuminate\Support\Facades\Mail;

class AlumnoController extends Controller
{
    /*
    * @brief Función encargada de retornar el home del alumno en caso de que haya una sesión iniciada
    * @return Si hay una sesión iniciada retorna la vista home del alumno
    * @return Si no hay una sesión iniciada retorna el login del alumno
    */
    public function home(){
        $data = array();
        if(Session::has('loginId')){
            $data = Alumno::findOrFail(Session::get('loginId'))->getDatos();
            return view('alumno.homeAlumno')
                ->with('data',$data);
        }else {
            return redirect()->route('alumno.login');
        }
    }
}