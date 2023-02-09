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
use App\Models\Estado;
use App\Models\HistoricoEstado;
use Illuminate\Support\Facades\Mail;
use App\Mail\Aceptacion;
use App\Mail\Baja;
use App\Mail\Rechazo;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AlumnosExport;
use PDF;

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
        $jefe = JefeDepartamento::findOrFail(Session::get('loginId'));
        $departamento = Departamento::where('jefe_departamento_id',Session::get('loginId'))->first();
        $alumnos = (Session::get('departamento') == 'DSA') ? $departamento->getAlumnosPendientes(true) : $departamento->getAlumnosPendientes();
        $departamento = $departamento->getAbreviatura();
        return view('alumnosPendientes')
            ->with('jefe',$jefe)
            ->with('alumnos',$alumnos)
            ->with('departamento',$departamento);
    }

    public function getRechazados(){
        $data = array();
        $jefe = JefeDepartamento::findOrFail(Session::get('loginId'));
        $departamento = Departamento::where('jefe_departamento_id',Session::get('loginId'))->first();
        $alumnos = (Session::get('departamento') == 'DSA') ? $departamento->getAlumnosRechazados(true) : $departamento->getAlumnosRechazados();
        $departamento = $departamento->getAbreviatura();
        return view('alumnosRechazados')
            ->with('jefe',$jefe)
            ->with('alumnos',$alumnos)
            ->with('departamento',$departamento);
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
        $alumno = Alumno::where('numero_cuenta',$num_cuenta)->first();
        if($alumno){
            $departamento = Departamento::findOrFail($alumno->departamento_id);
            //Enviar correo al alumno
            $estado = Estado::findOrFail($alumno->estado_id);
            $estado->estado = 'BAJA';
            $estado->fecha_estado = Carbon::now();
            $estado->save();

            $historico = new HistoricoEstado();
            $historico->fecha_estado = Carbon::now();
            $historico->estado_id = $estado->id;
            $historico->departamento_id = $alumno->departamento_id;
            $historico->alumno_id = $alumno->id;
            $historico->save();

            Mail::to($alumno->correo)->send(new Baja($alumno->correo,$alumno->getNombre(),$departamento->departamento));

            return redirect()->back()->with('success','El alumno con número de cuenta: '.$num_cuenta." fue dado de baja exitosamente del sistema");
        }
        else{
            return redirect()->back()->with('fail','No existe alumno con número de cuenta: '.$num_cuenta);
        }
        
    }

    public function rechazoAlumno(int $num_cuenta){
        $alumno = Alumno::where('numero_cuenta',$num_cuenta)->first();
        if($alumno){
            $departamento = Departamento::findOrFail($alumno->departamento_id);
            //Enviar correo al alumno
            $estado = Estado::findOrFail($alumno->estado_id);
            $estado->estado = 'RECHAZO';
            $estado->fecha_estado = Carbon::now();
            $estado->save();
            $alumno->estado_id = $estado->id;
            $alumno->save();

            $historico = new HistoricoEstado();
            $historico->fecha_estado = Carbon::now();
            $historico->estado_id = $estado->id;
            $historico->departamento_id = $alumno->departamento_id;
            $historico->alumno_id = $alumno->id;
            $historico->save();

            Mail::to($alumno->correo)->send(new Rechazo($alumno->correo,$alumno->getNombre(),$departamento->departamento));

            return redirect()->back()->with('success','El alumno con número de cuenta: '.$num_cuenta." fue dado de baja exitosamente del sistema");
        }
        else{
            return redirect()->back()->with('fail','No existe alumno con número de cuenta: '.$num_cuenta);
        }
    }

    public function aceptarAlumno(int $num_cuenta){
        $alumno = Alumno::where('numero_cuenta',$num_cuenta)->first();
        if($alumno){

            $departamento = Departamento::findOrFail($alumno->departamento_id);

            $estado = Estado::findOrFail($alumno->estado_id);
            $estado->estado = 'ACEPTADO';
            $estado->fecha_estado = Carbon::now();
            $estado->save();
            $alumno->estado_id = $estado->id;
            $alumno->save();

            $historico = new HistoricoEstado();
            $historico->fecha_estado = Carbon::now();
            $historico->estado_id = $estado->id;
            $historico->departamento_id = $alumno->departamento_id;
            $historico->alumno_id = $alumno->id;
            $historico->save();
            
            Mail::to($alumno->correo)->send(new Aceptacion($alumno->correo,$alumno->getNombre(),$departamento->departamento));

            return redirect()->back()->with('success','Se acaba de dar de alta al alumno con número de cuenta: '.$num_cuenta);
        }
        else{
            return redirect()->back()->with('fail','No existe alumno con número de cuenta: '.$num_cuenta);
        }
    }


    public function descargarTablaExcel(string $tipo, string $departamento){
        $date = Carbon::now();
        return Excel::download(new AlumnosExport($tipo,$departamento),'alumnos_'.$tipo.'_'.$departamento.'_'.$date->format('Y_m_d').'.xlsx');
    }

    public function descargarTablaPDF(string $tipo, string $departamento){
        $date = Carbon::now();
        $departamento = Departamento::where('jefe_departamento_id',Session::get('loginId'))->first();
        $alumnos = array();
        
        if(strcmp($tipo,'ACEPTADO') == 0)
            $alumnos = (Session::get('departamento') == 'DSA') ? $departamento->getAlumnosAceptados(true) : $departamento->getAlumnosAceptados();
        else if(strcmp($tipo,'PENDIENTE') == 0)
            $alumnos = (Session::get('departamento') == 'DSA') ? $departamento->getAlumnosPendientes(true) : $departamento->getAlumnosPendientes();
        else
            $alumnos = (Session::get('departamento') == 'DSA') ? $departamento->getAlumnosRechazados(true) : $departamento->getAlumnosRechazados();
        
        $departamento = $departamento->getAbreviatura();
        $data = [
            "alumnos" => $alumnos,
            "departamento" => $departamento,
            "estado" => $tipo
        ];

        $pdf = PDF::loadView('pdf.tablaAlumnos', $data)->setOptions(['defaultFont' => 'sans-serif']);

        return $pdf->download('alumnos_'.$tipo.'_'.$departamento.'_'.$date->format('Y_m_d').'.pdf');

    }

    public function finalizarAlumno(int $num_cuenta){

    }

}


