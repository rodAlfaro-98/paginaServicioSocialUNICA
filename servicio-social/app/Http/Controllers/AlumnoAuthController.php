<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;
use Hash;
use Session;
use App\Models\Alumno;

class AlumnoAuthController extends Controller
{
    public function login(){
        if(Session::has('loginId')){
            return back();
        }
        return view("auth.alumno_login");
    }
    public function logout(){
        if(Session::has('loginId')){
            Session::pull('loginId');
            return redirect()->route('alumno.login');
        }
    }

    public function loginUser(Request $request){
        $request->validate([
            'num_cuenta' => 'required|numeric|min:9',
            'contraseña' => 'required|min:12',
        ]);
        $user = Alumno::where('numero_cuenta',$request->num_cuenta)->first();
        //$user = DB::table('alumno')
            //->where('numero_cuenta','=',$request->num_cuenta)->first();
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
            //$data = DB::table('alumno as a')
            //    ->select('a.*','c.clave_carrera','d.departamento')
            //    ->join('carrera as c', 'a.carrera_id','=','c.id')
            //    ->join('departamento as d','a.departamento_id','=','d.id')
            //    ->where('a.id','=',Session::get('loginId'))->first();
            return view('homeAlumno')
                ->with('data',$data);
        }else {
            return redirect()->route('alumno.login');
        }
    }

    public function formulario(){
        
    }
}

