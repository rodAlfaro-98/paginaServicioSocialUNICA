<?php
namespace App\Http\Controllers;
use Redirect;
use Auth;
use Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Html\HtmlServiceProvider;

class DepartamentoController extends Controller {

    public function index(){
        $data = array();
        if(Session::has('loginId')){
            $jefe = JefeDepartamento::findOrFail(Session::get('loginId'))->first();
            $departamento = Departamento::where('jefe_departamento_id',Session::get('loginId'))->first();
            $alumnos = $departamento->getAlumnosAceptados();
            $departamento = $departamento->getAbreviatura();
            return view('homeDepartamento')
                ->with('jefe',$jefe)
                ->with('alumnos',$alumnos)
                ->with('departamento',$departamento);
        }else {
            return redirect()->route('departamento.login');
        }
    }

    public function getPendientes(){
        $data = array();
        if(Session::has('loginId')){
            $jefe = JefeDepartamento::findOrFail(Session::get('loginId'))->first();
            $departamento = Departamento::where('jefe_departamento_id',Session::get('loginId'))->first();
            $alumnos = $departamento->getAlumnosPendientes();
            $departamento = $departamento->getAbreviatura();
            return view('homeDepartamento')
                ->with('jefe',$jefe)
                ->with('alumnos',$alumnos)
                ->with('departamento',$departamento);
        }else {
            return redirect()->route('departamento.login');
        }
    }
}


