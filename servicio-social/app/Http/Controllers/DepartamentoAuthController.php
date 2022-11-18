<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Hash;
use Session;

class DepartamentoAuthController extends Controller
{
    public function login(){
        if(Session::has('loginId')){
            return back();
        }
        return view("auth.departamento_login");
    }
    public function logout(){
        if(Session::has('loginId')){
            Session::pull('loginId');
            return redirect()->route('departamento.login');
        }
    }

    public function loginUser(Request $request){
        $request->validate([
            'usuario' => 'required',
            'contraseña' => 'required|min:12',
        ]);
        $user = DB::table('jefe_departamento')
            ->where('uid','=',$request->usuario)->first();
        if($user){
            if(Hash::check($request->contraseña,$user->contraseña)){
                $request->session()->put('loginId',$user->jefe_departamento_id);
                return redirect('departamento/home');
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
            $data = DB::table('jefe_departamento')
                ->where('jefe_departamento_id','=',Session::get('loginId'))->first();

            return view('dashboard')
                ->with('data',$data);
        }else {
            return redirect()->route('departamento.login');
        }
    }

}
