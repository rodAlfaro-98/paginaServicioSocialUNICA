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

class AlumnoAuthController extends Controller
{
    public function login(){
        Session::forget('succes');
        if(Session::has('loginId')){
            return back();
        }
        return view("auth.alumno_login");
    }
    public function logout(){
        if(Session::has('loginId')){
            Session::flush();
            return redirect()->route('alumno.login');
        }
    }

    public function loginUser(Request $request){
        $request->validate([
            'num_cuenta' => 'required|digits_between:9,10',
            'contraseña' => 'required|min:12',
        ]);
        $user = Alumno::where('numero_cuenta',$request->num_cuenta)->first();
        if($user){
            if(Hash::check($request->contraseña,$user->contraseña)){
                $request->session()->put('loginId',$user->id);
                $request->session()->put('tipo','alumno');
                return redirect('alumno/home');
            }else{
                return back()->with('fail','Contraseña errónea.');    
            }
        }else{
            return back()->with('fail','Este usuario no está registrado.');
        }
    }

    public function home(){
        $data = array();
        if(Session::has('loginId')){
            $data = Alumno::findOrFail(Session::get('loginId'))->getDatos();
            return view('homeAlumno')
                ->with('data',$data);
        }else {
            return redirect()->route('alumno.login');
        }
    }

    public function register(){
        if(Session::has('loginId')){
            return back();
        }
        return view('auth.alumno_register');
    }

    public function registerUser(Request $request){
        $request->validate([
            'numero_cuenta' => 'required|numeric|min:9',
            'correo' => 'required',
            'nombres' => 'required',
            'apellido_paterno' => 'required',
            'apellido_materno' => 'required',
            'fecha_nacimiento' => 'required',
            'curp' => 'required',
            'genero' => 'required',
            'telefono_casa' => 'required',
            'telefono_celular' => 'required',
            'creditos_pagados' => 'required',
            'avance_porcentaje' => 'required',
            'promedio' => 'required',
            'fecha_ingreso_fac' => 'required',
            'duracion_servicio' => 'required',
            'horas_semana' => 'required',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
            'interno' => 'required',
            'departamento_id' => 'required'
        ]);
        $alumno = new Alumno();
        $alumno->correo = $request->correo;
        $alumno->numero_cuenta = $request->numero_cuenta;
        $alumno->nombres = $request->nombres;
        $alumno->apellido_paterno = $request->apellido_paterno;
        $alumno->apellido_materno = $request->apellido_materno;
        $alumno->fecha_nacimiento = $request->fecha_nacimiento;
        $alumno->curp = $request->curp;
        $alumno->genero = ($request->genero_especifico !== null) ? $request->genero_especifico : $request->genero;
        $alumno->telefono_casa = $request->telefono_casa;
        $alumno->telefono_celular = $request->telefono_celular;
        $alumno->creditos_pagados = $request->creditos_pagados;
        $alumno->avance_porcentaje = $request->avance_porcentaje;
        $alumno->fecha_ingreso_facultad = $request->fecha_ingreso_fac;
        $alumno->promedio =$request->promedio;
        $alumno->duracion_servicio = $request->duracion_servicio;
        $alumno->horas_semana = $request->horas_semana;
        $alumno->hora_inicio = $request->hora_inicio;
        $alumno->hora_fin = $request->hora_fin;
        $alumno->fecha_inicio = $request->fecha_inicio;
        $alumno->fecha_fin = Carbon::parse($request->fecha_inicio)->addMonth($request->duracion_servicio)->format('Y-m-d');
        $contraseña = Str::random(12);
        $alumno->contraseña = Hash::make($contraseña);
        $alumno->interno = (strcmp($request->interno,'interno') == 0);
        $carrera = ($alumno->interno == true) ? $request->carrera_interno : $request->carrera_externo;
        $datos_carrera = Carrera::where('carrera',$carrera)->first();
        $carrera_id = 0;
        if($datos_carrera){
            $carrera_id = $datos_carrera->id;
        }
        else{
            $carrera_nombre = strtolower(Str::ascii($carrera));
            $lista_carreras = DB::table('carrera')
                                ->select('carrera')
                                ->get();
            $found = false;
            foreach($lista_carreras as $elem_carrera){
                if(strcmp(strtolower(Str::ascii($elem_carrera->carrera)),$carrera_nombre) == 0){
                    $carrera = Carrera::where('carrera',$elem_carrera->carrera)->first();
                    $carrera_id = $carrera->id;
                    $found = true;
                    break;
                }
            }
            if(!$found){

            }
        }
        $alumno->carrera_id = $carrera_id;
        $alumno->departamento_id = $request->departamento_id;
        $estado = new Estado();
        $estado->estado = "PENDIENTE";
        $now = Carbon::now();
        $estado->fecha_estado = $now;
        $estado->save();
        $alumno->estado_id = $estado->id;
        $alumno->save();

        $historico_estado = new HistoricoEstado();
        $historico_estado->fecha_estado = $now;
        $historico_estado->estado_id = $estado->id;
        $historico_estado->departamento_id = $request->departamento_id;
        $historico_estado->alumno_id = $alumno->id;
        $historico_estado->save();

        $departamento = $alumno->getDepartamento();
        $jefe_departamento = $departamento->getJefeDepartamento();

        Mail::to($alumno->correo)->send(new Registro($alumno->correo,$alumno->getNombre(),$departamento->departamento,$jefe_departamento->getNombreTitulo(),$contraseña));
        Mail::to($jefe_departamento->email)->send(new Peticion($jefe_departamento->email,$jefe_departamento->getNombreTitulo(),$alumno->numero_cuenta,$alumno->getNombreApellidos()));

        return redirect()->route('alumno.login')->with('success','Ha sido ingresado exitosamente al sistema. Favor de esperar a que su solicitud sea aceptada. Su contraseña para ingresar al sistema es: '.$contraseña);
    }

    public function vistaCambioContraseña(){
        return view('auth.alumno_comfirma_contraseña');
    }

    public function comfirmaContraseña(Request $request){
        $alumno = Alumno::findOrFail(Session::get('loginId'));
        if(Hash::check($request->contraseña,$alumno->contraseña)){
            return view('auth.alumno_cambia_contraseña');
        }
        else{
            return redirect()->back()->with('fail','La contraseña ingresada es incorrecta.');
        }
    }

    public function cambioContraseña(){
        return view('auth.alumno_cambia_contraseña');
    }

    public function doCambioContraseña(Request $request){
        $validator = Validator::make($request->all(),[
            'contraseña' => 'required|min:12',
            'comfirma_contraseña' => 'required|min:12',
        ]);
        
        if($validator->fails()){
            return redirect()->route('alumno.cambio.contraseña')->withErrors($validator);
        }

        if(strcmp($request->contraseña,$request->comfirma_contraseña) != 0){
            return Redirect::route('alumno.cambio.contraseña')->with('fail','Las contraseñas no coinciden');
        }
        $alumno = Alumno::findOrFail(Session::get('loginId'));
        $contraseña_nueva = Hash::make($request->contraseña);
        $alumno->contraseña = $contraseña_nueva;
        $alumno->save();
        Mail::to($alumno->correo)->send(new CambioContraseña($alumno->getNombre(),$request->contraseña));
        return redirect()->route('alumno.home')->with('success','La contraseña fue cambiada exitosamente');
    }
}


