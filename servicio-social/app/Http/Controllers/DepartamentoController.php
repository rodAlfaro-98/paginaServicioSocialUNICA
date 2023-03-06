<?php
namespace App\Http\Controllers;
use PDF;
use Auth;
use Input;
use Session;
use Redirect;
use Mpdf\Mpdf;
use App\Mail\Baja;
use Carbon\Carbon;
use App\Mail\Rechazo;
use App\Models\Alumno;
use App\Models\Estado;
use App\Models\Carrera;
use App\Mail\Aceptacion;
use App\Mail\Finalizacion;
use App\Models\Departamento;
use Illuminate\Http\Request;
use App\Exports\AlumnosExport;
use App\Models\HistoricoEstado;
use App\Models\JefeDepartamento;
use App\Exports\EstadisticaExport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Html\HtmlServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

class DepartamentoController extends Controller {

    public function index(){
        $data = array();
        $jefe = JefeDepartamento::findOrFail(Session::get('loginId'));
        $departamento = Departamento::where('jefe_departamento_id',Session::get('loginId'))->first();
        $alumnos = (Session::get('departamento') == 'DSA') ? $departamento->getAlumnosAceptados(true) : $departamento->getAlumnosAceptados();
        $departamento = $departamento->getAbreviatura();
        return view('coordinador.homeDepartamento')
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
        return view('coordinador.alumnosPendientes')
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
        return view('coordinador.alumnosRechazados')
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
            return view('coordinador.datos_alumno')
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
            $estado->estado = 'BAJA';
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
            "estado" => "estado ".$tipo,
            "dato" => $tipo,
        ];

        $pdf = PDF::loadview('pdf.tablaAlumnos', $data)->setOptions(['defaultFont' => 'sans-serif']);

        return $pdf->download('alumnos_'.$tipo.'_'.$departamento.'_'.$date->format('Y_m_d').'.pdf');

    }

    public function finalizarAlumno(int $num_cuenta){
        $alumno = Alumno::where('numero_cuenta',$num_cuenta)->first();
        if($alumno){

            $departamento = Departamento::findOrFail($alumno->departamento_id);

            $estado = Estado::findOrFail($alumno->estado_id);
            $estado->estado = 'FINALIZADO';
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
            
            Mail::to($alumno->correo)->send(new Finalizacion($alumno->correo,$alumno->getNombre(),$departamento->departamento));

            return redirect()->back()->with('success','Se acaba de terminal el servicio del alumno con número de cuenta: '.$num_cuenta);
        }
        else{
            return redirect()->back()->with('fail','No existe alumno con número de cuenta: '.$num_cuenta);
        }
    }

    public function getEstadistica(){
        $data = array();
        $jefe = JefeDepartamento::findOrFail(Session::get('loginId'));
        $departamento = Departamento::where('jefe_departamento_id',Session::get('loginId'))->first();
        $departamento = $departamento->getAbreviatura();
        $años = array();
        $semestre_max = 2;
        $semestre_min = 2;
        $generos = DB::table('alumno')
            ->select('genero')
            ->distinct()->get();
        $carreras = DB::table('carrera')
            ->select('carrera')
            ->distinct()->get();
        $max_fecha = DB::table('alumno')
            ->max('fecha_fin');
        $max_año = (int) Carbon::createFromFormat('Y-m-d', $max_fecha)->format('Y');
        $max_mes = (int) Carbon::createFromFormat('Y-m-d', $max_fecha)->format('m');
        if($max_mes >= 8){
            $max_año++;
            $semestre_max = 1;
        }
        $min_fecha = DB::table('alumno')
            ->min('fecha_inicio');
        $min_año = (int) Carbon::createFromFormat('Y-m-d', $min_fecha)->format('Y');
        $min_mes = (int) Carbon::createFromFormat('Y-m-d', $min_fecha)->format('m');
        if($min_mes >= 8){
            $min_año++;
            $semestre_min = 1;
        }
        for($i = $min_año; $i <= $max_año; $i++){
            array_push($años,$i);
        }
        return view('coordinador.estadisticas')
            ->with('jefe',$jefe)
            ->with('departamento',$departamento)
            ->with('generos',$generos)
            ->with('carreras',$carreras)
            ->with('años',$años)
            ->with('min_año',$min_año)
            ->with('max_año',$max_año)
            ->with('semestre_max',$semestre_max)
            ->with('semestre_min',$semestre_min);
    }

    public function getDescargaEstadistica(Request $request){
        $obtained = $request->collect();
        $dataTypes = ["genero","carrera","interno","fecha"];
        $datos = ["fecha_inicio" => Null, "fecha_fin" => Null, "genero" => Null, "carrera" => Null, "interno" => Null, "estado" => Null, "becario"];
        $dato = '';
        foreach($obtained as $key=>$value){
            switch($key){
                case "fecha":
                    $dato = $request['fecha'];
                    $elemFecha = explode('-',$dato);
                    $mes_inicio = 0;
                    $año_inicio = 0;
                    $mes_fin = 0;
                    $año_fin = 0;
                    if($elemFecha[1] == '2'){
                        $mes_inicio = '1';
                        $año_inicio = $elemFecha[0];
                        $mes_fin = '8';
                        $año_fin = $elemFecha[0]; 
                    }else{
                        $mes_inicio = '8';
                        $año_inicio = (string) ((int) $elemFecha[0] - 1);
                        $mes_fin = '12';
                        $año_fin = (string) ((int) $elemFecha[0] - 1); 
                    }
                    $datos["fecha_inicio"] = $año_inicio.'-'.$mes_inicio.'-01';
                    $datos["fecha_fin"] = $año_fin.'-'.$mes_fin.'-01';
                break;
                case "genero":
                    $datos["genero"] = $request['genero'];
                break;
                case "interno":
                    $datos["interno"] = ($request['interno'] == 'Interno') ? true : false;
                break;
                case "carrera":
                    $datos["carrera"] = $request['carrera'];
                break;

                case "estado":
                    $datos["estado"] = $request['estado'];
                case "becario":
                    $datos['becario'] = ($request['becario'] == 'Interno') ? true : false;
            }
        }
        $jefe = JefeDepartamento::findOrFail(Session::get('loginId'));
        $departamento = Departamento::where('jefe_departamento_id',Session::get('loginId'))->first();
        return ($request['boton_descarga'] == 'Excel') ? $this->getExcelEstadistica($request,$departamento->abreviatura_departamento,$datos) : $this->getPDFEstadistica($request,$departamento->abreviatura_departamento,$datos);
    }

    public function getExcelEstadistica(Request $request,$departamento,$datos){
        $date = Carbon::now();
        $estadistica = new EstadisticaExport($request['tipo_dato_selector'],$departamento,$datos);
        $alumnos = $estadistica->collection();
        if(sizeof($alumnos) == 0){
            return redirect()->back()->with('fail','No hay alumnos que cumplan con los criterios de búsqueda seleccionados');
        }
        return Excel::download($estadistica,'alumnos_'.$request['tipo_dato_selector'].'_'.$departamento.'_'.$date->format('Y_m_d').'.xlsx');
    }

    public function getPDFEstadistica(Request $request,$departamento,$datos){ 
        $date = Carbon::now();
        $estadistica = new EstadisticaExport($request['tipo_dato_selector'],$departamento,$datos);
        $alumnos = $estadistica->collection();
        if(sizeof($alumnos) == 0){
            return redirect()->back()->with('fail','No hay alumnos que cumplan con los criterios de búsqueda seleccionados');
        }
        $data = [
            "alumnos" => $alumnos,
            "departamento" => " todos los departamentos"
        ];

        $pdf = PDF::loadView('pdf.tablaAlumnos', $data)->setOptions(['defaultFont' => 'sans-serif']);

        return $pdf->download('alumnos_'.$request['tipo_dato_selector'].'_'.$departamento.'_'.$date->format('Y_m_d').'.pdf');
    }

    public function getDocumentoDepartamento(Request $request){
        $date = Carbon::now();
        $request->validate([
            'periodo' => 'required',
            'departamento' => 'required',
        ]);
        $dato = $request['periodo'];
        $elemFecha = explode('-',$dato);
        $mes_inicio = 0;
        $año_inicio = 0;
        $mes_fin = 0;
        $año_fin = 0;
        if($elemFecha[1] == '2'){
            $mes_inicio = '1';
            $año_inicio = $elemFecha[0];
            $mes_fin = '8';
            $año_fin = $elemFecha[0]; 
        }else{
            $mes_inicio = '8';
            $año_inicio = (string) ((int) $elemFecha[0] - 1);
            $mes_fin = '12';
            $año_fin = (string) ((int) $elemFecha[0] - 1); 
        }
        $fecha_inicio = $año_inicio.'-'.$mes_inicio.'-01';
        $fecha_fin = $año_fin.'-'.$mes_fin.'-01';
        $toReturn = DB::Table('alumno')
            ->join('departamento','departamento.id', '=', 'alumno.departamento_id')
            ->select('alumno.nombres','alumno.apellido_paterno','alumno.apellido_materno','alumno.fecha_inicio','alumno.fecha_fin')
            ->whereBetween('alumno.fecha_inicio',[$fecha_inicio,$fecha_fin])
            ->where('departamento.abreviatura_departamento','=',$request["departamento"]);
        
        $alumnos = $toReturn->get();
        if(sizeof($alumnos) == 0){
            return redirect()->back()->with('fail','No hay alumnos inscritos en el periodo '.$dato.' en el departamento '.$request["departamento"]);
        }

        $departamento = Departamento::where('abreviatura_departamento',$request['departamento'])->first();
        $jefe_departamento_documento = $departamento->getJefeDepartamento();
        $spanish_months = array(
            'January' => 'enero',
            'February' => 'febrero',
            'March' => 'marzo',
            'April' => 'abril',
            'May' => 'mayo',
            'June' => 'junio',
            'July' => 'julio',
            'August' => 'agosto',
            'September' => 'septiembre',
            'October' => 'octubre',
            'November' => 'noviembre',
            'December' => 'diciembre'
        );

        $jefe = JefeDepartamento::findOrFail(Session::get('loginId'));
        $genero = ($jefe->nombres[strlen($jefe->nombres)-1] == "a") ? true : false;
        $genero_2 = ($jefe_departamento_documento->nombres[strlen($jefe_departamento_documento->nombres)-1] == "a") ? true : false;

        $data = [
            'alumnos'=>$alumnos,
            'periodo'=>$request['periodo'],
            'fecha'=>$date,
            'departamento'=>$departamento->getNombre(),
            'spanish_months'=>$spanish_months,
            'titulo' => $jefe->titulo,
            'nombre_completo' => $jefe->nombres.' '.$jefe->apellido_paterno.' '.$jefe->apellido_materno,
            'genero' => $genero,
            'nombre_completo_2' => $jefe_departamento_documento->nombres.' '.$jefe_departamento_documento->apellido_paterno.' '.$jefe_departamento_documento->apellido_materno,
            'titulo_2' => $jefe_departamento_documento->titulo,
            'genero_2' => $genero_2
        ];
        
        $pdf = PDF::loadView('pdf.servicio_social_division', $data)->setOptions(['defaultFont' => 'sans-serif']);

        return $pdf->download('ServSocial_'.$request["departamento"].'_'.$request["periodo"].'.pdf');
    }
}


