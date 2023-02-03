<?php
namespace App\Http\Controllers;
use Redirect;
use Auth;
use Input;
use Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Html\HtmlServiceProvider;
use App\Models\JefeDepartamento;
use App\Models\Departamento;
use App\Models\Alumno;
use App\Models\Carrera;

class DepartamentoController extends Controller {

    public function index(){
        $data = array();
        $jefe = JefeDepartamento::findOrFail(Session::get('loginId'));
        $departamento = Departamento::where('jefe_departamento_id',Session::get('loginId'))->first();
        $alumnos = (Session::get('departamento') == 'DSA') ? $departamento->getAlumnosAceptados(true) : $departamento->getAlumnosAceptados();
        $departamento = $departamento->getAbreviatura();
        return view('homeDepartamento')
            ->with('jefe',$jefe)
            ->with('alumnos',$alumnos)
            ->with('departamento',$departamento);
    }

    public function getPendientes(){
        $data = array();
        if(Session::has('loginId')){
            $jefe = JefeDepartamento::findOrFail(Session::get('loginId'));
            $departamento = Departamento::where('jefe_departamento_id',Session::get('loginId'))->first();
            $alumnos = (Session::get('departamento') == 'DSA') ? $departamento->getAlumnosPendientes(true) : $departamento->getAlumnosPendientes();
            $departamento = $departamento->getAbreviatura();
            return view('homeDepartamento')
                ->with('jefe',$jefe)
                ->with('alumnos',$alumnos)
                ->with('departamento',$departamento);
        }else {
            return redirect()->route('departamento.login');
        }
    }

    public function getDatosAlumno(int $num_cuenta){
        $alumno = Alumno::where('numero_cuenta',$num_cuenta)->first();
        if($alumno){
            $carrera = Carrera::find($alumno->carrera_id)->first();
            $departamento = Departamento::find($alumno->departamento_id)->first();
            $jefe = JefeDepartamento::findOrFail(Session::get('loginId'));
            return view('datos_alumno')
                ->with('jefe',$jefe)
                ->with('alumno',$alumno)
                ->with('carrera',$carrera->carrera)
                ->with('departamento',$departamento->departamento);
        }else{
            return redirect()->back()->with('fail','No existe alumno con número de cuenta: '.$num_cuenta);
        }
        
    }

    public function bajaAlumno(int $num_cuenta){
        if($alumno = Alumno::where('numero_cuenta',$num_cuenta)->first()){
            Alumno::where('numero_cuenta',$num_cuenta)->delete();
            return redirect()->back()->with('success','El alumno con número de cuenta: '.$num_cuenta." fue dado de baja exitosamente del sistema");
        }
        else{
            return redirect()->back()->with('fail','No existe alumno con número de cuenta: '.$num_cuenta);
        }
        
    }
}


