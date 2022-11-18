<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Hash;
use Session;

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
        $user = DB::table('alumno')
            ->where('numero_cuenta','=',$request->num_cuenta)->first();
        if($user){
            if(Hash::check($request->contraseña,$user->contraseña)){
                $request->session()->put('loginId',$user->alumno_id);
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
            $data = DB::table('alumno')
                ->where('alumno_id','=',Session::get('loginId'))->first();
            return view('homeAlumno')
                ->with('data',$data);
        }else {
            return redirect()->route('alumno.login');
        }
    }

}
