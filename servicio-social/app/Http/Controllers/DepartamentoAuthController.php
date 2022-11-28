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
        $user = JefeDepartamento::where('uid',$request->usuario)->first();
        if($user){
            if(Hash::check($request->contraseña,$user->contraseña)){
                $request->session()->put('loginId',$user->id);
                $request->session()->put('tipo','Jefe de departamento');
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
            $jefe = JefeDepartamento::findOrFail(Session::get('loginId'))->first();
            $departamento = Departamento::where('jefe_departamento_id',Session::get('loginId'))->first();
            $alumnos = $departamento->getAlumnos();
            $departamento = $departamento->getAbreviatura();
            return view('dashboard')
                ->with('jefe',$jefe)
                ->with('alumnos',$alumnos)
                ->with('departamento',$departamento);
        }else {
            return redirect()->route('departamento.login');
        }
    }

}
