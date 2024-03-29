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

    /*
    * @brief Función encargada de retornar la vista home del coordinador con los alumnos activos de su coordinación
    * @return La vista home con la lista de alumnos realizando el servicio social
    */
    public function index(){
        $data = array();
        $jefe = JefeDepartamento::findOrFail(Session::get('loginId'));
        //Obtenemos el departamento al que pertenece el coordinador
        $departamento = Departamento::where('jefe_departamento_id',Session::get('loginId'))->first();
        //Obtenemos la lista de alumnos. En caso de ser el DSA indicamos que queremos la lista de superusuario.
        $alumnos = (Session::get('departamento') == 'DSA') ? $departamento->getAlumnosAceptados(true) : $departamento->getAlumnosAceptados();
        $departamento = $departamento->getAbreviatura();
        return view('coordinador.homeDepartamento')
            ->with('jefe',$jefe)
            ->with('alumnos',$alumnos)
            ->with('departamento',$departamento);
    }

    /*
    * @brief Función que retorna los alumnos con estado de PENDIENTE de cada departamento
    * @return La vista de alumnos pendientes con la lista de alumnos a mostrar
    */
    public function getPendientes(){
        $data = array();
        $jefe = JefeDepartamento::findOrFail(Session::get('loginId'));
        //Obtenemos el departamento al que pertenece el coordinador
        $departamento = Departamento::where('jefe_departamento_id',Session::get('loginId'))->first();
        //Obtenemos la lista de alumnos. En caso de ser el DSA indicamos que queremos la lista de superusuario.
        $alumnos = (Session::get('departamento') == 'DSA') ? $departamento->getAlumnosPendientes(true) : $departamento->getAlumnosPendientes();
        $departamento = $departamento->getAbreviatura();
        return view('coordinador.alumnosPendientes')
            ->with('jefe',$jefe)
            ->with('alumnos',$alumnos)
            ->with('departamento',$departamento);
    }

    /*
    * @brief Función que retorna los alumnos con estado de RECHAZADO de cada departamento
    * @return La vista de alumnos rechazados con la lista de alumnos a mostrar
    */
    public function getRechazados(){
        $data = array();
        $jefe = JefeDepartamento::findOrFail(Session::get('loginId'));
        //Obtenemos el departamento al que pertenece el coordinador
        $departamento = Departamento::where('jefe_departamento_id',Session::get('loginId'))->first();
        //Obtenemos la lista de alumnos. En caso de ser el DSA indicamos que queremos la lista de superusuario.
        $alumnos = (Session::get('departamento') == 'DSA') ? $departamento->getAlumnosRechazados(true) : $departamento->getAlumnosRechazados();
        $departamento = $departamento->getAbreviatura();
        return view('coordinador.alumnosRechazados')
            ->with('jefe',$jefe)
            ->with('alumnos',$alumnos)
            ->with('departamento',$departamento);
    }

    /*
    * @brief Función que retorna el formulario inicial del alumno con sus datos
    * @param El número de cuenta del alumno que se desea observar
    * @return En caso de existir el alumno con el número de cuenta ingresado se retorna la vista con sus datos
    * @return En caso de no existir el alumno con el número de cuenta ingresados se regresa a la vista anterior.
    */
    public function getDatosAlumno(int $num_cuenta){
        $alumno = Alumno::where('numero_cuenta',$num_cuenta)->first();
        //Comprobamos que la consulta retornara datos
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

    /*
    * @brief Función encargada de dar de baja a un alumno
    * @param El número de cuenta del alumno a dar de baja
    * @return Se envía un correo al alumno y se retorna la vista anterior con un mensaje de éxito en caso de existir el alumno
    * @return En caso de no existir el alumno se retorna la vista anterior con un mensaje de fallo
    */
    public function bajaAlumno(int $num_cuenta){
        $alumno = Alumno::where('numero_cuenta',$num_cuenta)->first();
        if($alumno){
            $departamento = Departamento::findOrFail($alumno->departamento_id);
            //Cambiamos el estado actual del alumno a baja
            $estado = Estado::findOrFail($alumno->estado_id);
            $estado->estado = 'BAJA';
            $estado->fecha_estado = Carbon::now();
            $estado->save();

            //En la tabla de historico indicamos que se cambió el estado del alumno
            $historico = new HistoricoEstado();
            $historico->fecha_estado = Carbon::now();
            $historico->estado_id = $estado->id;
            $historico->departamento_id = $alumno->departamento_id;
            $historico->alumno_id = $alumno->id;
            $historico->save();

            //Enviamos correo al alumno indicandole el cambio realizado
            Mail::to($alumno->correo)->send(new Baja($alumno->correo,$alumno->getNombre(),$departamento->departamento));

            return redirect()->back()->with('success','El alumno con número de cuenta: '.$num_cuenta." fue dado de baja exitosamente del sistema");
        }
        else{
            return redirect()->back()->with('fail','No existe alumno con número de cuenta: '.$num_cuenta);
        }
        
    }

    /*
    * @brief Función encargada de rechazar al solicitud de un alumno
    * @param El número de cuenta del alumno a rechazar
    * @return Se envía un correo al alumno y se retorna la vista anterior con un mensaje de éxito en caso de existir el alumno
    * @return En caso de no existir el alumno se retorna la vista anterior con un mensaje de fallo
    */
    public function rechazoAlumno(int $num_cuenta){
        $alumno = Alumno::where('numero_cuenta',$num_cuenta)->first();
        if($alumno){
            $departamento = Departamento::findOrFail($alumno->departamento_id);
            //Cambiamos el estado actual del alumno a baja
            $estado = Estado::findOrFail($alumno->estado_id);
            $estado->estado = 'BAJA';
            $estado->fecha_estado = Carbon::now();
            $estado->save();
            $alumno->estado_id = $estado->id;
            $alumno->save();

            //En la tabla de historico indicamos que se cambió el estado del alumno
            $historico = new HistoricoEstado();
            $historico->fecha_estado = Carbon::now();
            $historico->estado_id = $estado->id;
            $historico->departamento_id = $alumno->departamento_id;
            $historico->alumno_id = $alumno->id;
            $historico->save();

            //Enviamos correo al alumno indicandole el cambio realizado
            Mail::to($alumno->correo)->send(new Rechazo($alumno->correo,$alumno->getNombre(),$departamento->departamento));

            return redirect()->back()->with('success','El alumno con número de cuenta: '.$num_cuenta." fue dado de baja exitosamente del sistema");
        }
        else{
            return redirect()->back()->with('fail','No existe alumno con número de cuenta: '.$num_cuenta);
        }
    }

    /*
    * @brief Función encargada de aceptar al solicitud de un alumno
    * @param El número de cuenta del alumno a aceptar
    * @return Se envía un correo al alumno y se retorna la vista anterior con un mensaje de éxito en caso de existir el alumno
    * @return En caso de no existir el alumno se retorna la vista anterior con un mensaje de fallo
    */
    public function aceptarAlumno(int $num_cuenta){
        $alumno = Alumno::where('numero_cuenta',$num_cuenta)->first();
        if($alumno){

            $departamento = Departamento::findOrFail($alumno->departamento_id);

            //Cambiamos el estado actual del alumno a aceptado
            $estado = Estado::findOrFail($alumno->estado_id);
            $estado->estado = 'ACEPTADO';
            $estado->fecha_estado = Carbon::now();
            $estado->save();
            $alumno->estado_id = $estado->id;
            $alumno->save();

            //En la tabla de historico indicamos que se cambió el estado del alumno
            $historico = new HistoricoEstado();
            $historico->fecha_estado = Carbon::now();
            $historico->estado_id = $estado->id;
            $historico->departamento_id = $alumno->departamento_id;
            $historico->alumno_id = $alumno->id;
            $historico->save();
            
            //Enviamos correo al alumno indicandole el cambio realizado
            Mail::to($alumno->correo)->send(new Aceptacion($alumno->correo,$alumno->getNombre(),$departamento->departamento));

            return redirect()->back()->with('success','Se acaba de dar de alta al alumno con número de cuenta: '.$num_cuenta);
        }
        else{
            return redirect()->back()->with('fail','No existe alumno con número de cuenta: '.$num_cuenta);
        }
    }

    /*
    * @brief Función encargada de descargar la tabla mostrada en la vista del coordinador en formato de tabla de excel
    * @param El departamento del coordinador
    * @param El tipo de estatus de los alumnos
    * @return Descarga un archivo de excel con los datos de los alumnos
    */
    public function descargarTablaExcel(string $tipo, string $departamento){
        $date = Carbon::now();
        return Excel::download(new AlumnosExport($tipo,$departamento),'alumnos_'.$tipo.'_'.$departamento.'_'.$date->format('Y_m_d').'.xlsx');
    }

    /*
    * @brief Función encargada de descargar la tabla mostrada en la vista del coordinador como un archivo pdf
    * @param El departamento del coordinador
    * @param El tipo de estatus de los alumnos
    * @return Descarga un archivo pdf con los datos de los alumnos
    */
    public function descargarTablaPDF(string $tipo, string $departamento){
        $date = Carbon::now();
        $departamento = Departamento::where('jefe_departamento_id',Session::get('loginId'))->first();
        $alumnos = array();
        
        //Obtenemos la tabla de alumnos en función al estado buscado
        if(strcmp($tipo,'ACEPTADO') == 0)
            $alumnos = (Session::get('departamento') == 'DSA') ? $departamento->getAlumnosAceptados(true) : $departamento->getAlumnosAceptados();
        else if(strcmp($tipo,'PENDIENTE') == 0)
            $alumnos = (Session::get('departamento') == 'DSA') ? $departamento->getAlumnosPendientes(true) : $departamento->getAlumnosPendientes();
        else
            $alumnos = (Session::get('departamento') == 'DSA') ? $departamento->getAlumnosRechazados(true) : $departamento->getAlumnosRechazados();
        
        $departamento = $departamento->getAbreviatura();

        //Creamos las variables de datos a usar en el archivo pdf
        $data = [
            "alumnos" => $alumnos,
            "departamento" => $departamento,
            "estado" => "estado ".$tipo,
            "dato" => $tipo,
        ];

        //Creamos el pdf con la vista tablaAlumnos
        $pdf = PDF::loadview('pdf.tablaAlumnos', $data)->setOptions(['defaultFont' => 'sans-serif']);

        //Retornamos la descarga del pdf
        return $pdf->download('alumnos_'.$tipo.'_'.$departamento.'_'.$date->format('Y_m_d').'.pdf');

    }

    /*
    * @brief Función encargada de indicar la finalización del servicio social del alumno
    * @param El número de cuenta del alumno a finalizar
    * @return Se envía un correo al alumno y se retorna la vista anterior con un mensaje de éxito en caso de existir el alumno
    * @return En caso de no existir el alumno se retorna la vista anterior con un mensaje de fallo
    */
    public function finalizarAlumno(int $num_cuenta){
        $alumno = Alumno::where('numero_cuenta',$num_cuenta)->first();
        if($alumno){

            $departamento = Departamento::findOrFail($alumno->departamento_id);

            //Cambiamos el estado actual del alumno a FINALIZADO su servicio
            $estado = Estado::findOrFail($alumno->estado_id);
            $estado->estado = 'FINALIZADO';
            $estado->fecha_estado = Carbon::now();
            $estado->save();
            $alumno->estado_id = $estado->id;
            $alumno->save();

            //En la tabla de historico indicamos que se cambió el estado del alumno
            $historico = new HistoricoEstado();
            $historico->fecha_estado = Carbon::now();
            $historico->estado_id = $estado->id;
            $historico->departamento_id = $alumno->departamento_id;
            $historico->alumno_id = $alumno->id;
            $historico->save();
            
            //Enviamos correo al alumno indicandole el cambio realizado
            Mail::to($alumno->correo)->send(new Finalizacion($alumno->correo,$alumno->getNombre(),$departamento->departamento));

            return redirect()->back()->with('success','Se acaba de terminal el servicio del alumno con número de cuenta: '.$num_cuenta);
        }
        else{
            return redirect()->back()->with('fail','No existe alumno con número de cuenta: '.$num_cuenta);
        }
    }

    /*
    * @brief Función encargada de retornar la vista de estadísticas de los alumnos
    * @return La vista de estadísticas con los datos que se pueden usar para filtar a los alumnos
    */
    public function getEstadistica(){
        $data = array();
        $jefe = JefeDepartamento::findOrFail(Session::get('loginId'));
        $departamento = Departamento::where('jefe_departamento_id',Session::get('loginId'))->first();
        $departamento = $departamento->getAbreviatura();
        $años = array();
        $semestre_max = 2;
        $semestre_min = 2;
        //Obtenemos todos los distintos géneros en la base de datos
        $generos = DB::table('alumno')
            ->select('genero')
            ->distinct()->get();
        //Obtenemos todas las distintas carreras en la base de datos
        $carreras = DB::table('carrera')
            ->select('carrera')
            ->distinct()->get();
        //Obtenemos la fecha más nueva de la base de datos
        $max_fecha = DB::table('alumno')
            ->max('fecha_fin');
        $max_año = (int) Carbon::createFromFormat('Y-m-d', $max_fecha)->format('Y');
        $max_mes = (int) Carbon::createFromFormat('Y-m-d', $max_fecha)->format('m');
        if($max_mes >= 8){
            $max_año++;
            $semestre_max = 1;
        }
        //Obtenemos la fecha más vieja de la base de datos
        $min_fecha = DB::table('alumno')
            ->min('fecha_inicio');
        $min_año = (int) Carbon::createFromFormat('Y-m-d', $min_fecha)->format('Y');
        $min_mes = (int) Carbon::createFromFormat('Y-m-d', $min_fecha)->format('m');
        if($min_mes >= 8){
            $min_año++;
            $semestre_min = 1;
        }
        //Creamos todos los semestres que existen entre la fecha más vieja y la más nueva
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

    /*
    * @brief Función encargada de retornar el documento con los alumnos que cumplen con los criterios seleccionados
    * @param Objeto de tipo request con los datos a usar para filtrar a los alumnos
    * @return Se retorna el tipo de documento seleccionado por el usuario con los datos de los alumnos
    */
    public function getDescargaEstadistica(Request $request){
        $obtained = $request->collect();
        $dataTypes = ["genero","carrera","interno","fecha"];
        //Inicializamos el mapa con los datos posibles para filtar
        $datos = ["fecha_inicio" => Null, "fecha_fin" => Null, "genero" => Null, "carrera" => Null, "interno" => Null, "estado" => Null, "becario"];
        $dato = '';
        //Iteramos los filtros seleccionados por el usuario
        foreach($obtained as $key=>$value){
            //Revisamos el nombre de los filtros retornados
            switch($key){
                //Si se seleccionó fecha cambiamos el formato de semestre a fecha de tipo YYYY-mm
                case "fecha":
                    $dato = $request['fecha'];
                    $elemFecha = explode('-',$dato);
                    $mes_inicio = 0;
                    $año_inicio = 0;
                    $mes_fin = 0;
                    $año_fin = 0;
                    //Si el formato es semestre-2 cambiamos a que la fecha es entre enero y agosto
                    if($elemFecha[1] == '2'){
                        $mes_inicio = '1';
                        $año_inicio = $elemFecha[0];
                        $mes_fin = '8';
                        $año_fin = $elemFecha[0]; 
                    //Si el formato es semestre-1 cambiamos a que la fecha es entre agosto y diciembre
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
                //Cambiamos el formato de interno/externo a booleano
                case "interno":
                    $datos["interno"] = ($request['interno'] == 'Interno') ? true : false;
                break;
                case "carrera":
                    $datos["carrera"] = $request['carrera'];
                break;

                case "estado":
                    $datos["estado"] = $request['estado'];
                //Cambiamos el formato de interno/externo a booleano
                case "becario":
                    $datos['becario'] = ($request['becario'] == 'Interno') ? true : false;
            }
        }
        //Obtenemos el jefe de departamento
        $jefe = JefeDepartamento::findOrFail(Session::get('loginId'));
        //Obtenemos el departamento
        $departamento = Departamento::where('jefe_departamento_id',Session::get('loginId'))->first();
        //Si el usuario indicó que desea un archivo de excel llamamos a la función encargada de generar archivos de excel, si desea un pdf llamamos a la función correspondiente.
        return ($request['boton_descarga'] == 'Excel') ? $this->getExcelEstadistica($request,$departamento->abreviatura_departamento,$datos) : $this->getPDFEstadistica($request,$departamento->abreviatura_departamento,$datos);
    }

    /*
    * @brief Función encargada de retornar el documento de excel con los alumnos filtrados
    * @param Objeto de tipo request con los datos ingresados por el usuario
    * @param Variable con el nombre del departamento buscado
    * @param Variable con los datos a utulizar para el filtrado
    * @return Se retorna el excel con los alumnos obtenidos
    */
    public function getExcelEstadistica(Request $request,$departamento,$datos){
        $date = Carbon::now();
        //Obtenemos la tabla con los alumnos
        $estadistica = new EstadisticaExport($request['tipo_dato_selector'],$departamento,$datos);
        $alumnos = $estadistica->collection();
        //Revisamos que haya algún alumno que cumpla con los criterios de búsqueda
        if(sizeof($alumnos) == 0){
            return redirect()->back()->with('fail','No hay alumnos que cumplan con los criterios de búsqueda seleccionados');
        }
        //Retornamos el documento de excel
        return Excel::download($estadistica,'alumnos_'.$request['tipo_dato_selector'].'_'.$departamento.'_'.$date->format('Y_m_d').'.xlsx');
    }

    /*
    * @brief Función encargada de retornar el documento de excel con los alumnos filtrados
    * @param Objeto de tipo request con los datos ingresados por el usuario
    * @param Variable con el nombre del departamento buscado
    * @param Variable con los datos a utulizar para el filtrado
    * @return Se retorna el excel con los alumnos obtenidos
    */
    public function getPDFEstadistica(Request $request,$departamento,$datos){ 
        $date = Carbon::now();
        //Obtenemos la tabla con los alumnos
        $estadistica = new EstadisticaExport($request['tipo_dato_selector'],$departamento,$datos);
        $alumnos = $estadistica->collection();
        //Revisamos que haya algún alumno que cumpla con los criterios de búsqueda
        if(sizeof($alumnos) == 0){
            return redirect()->back()->with('fail','No hay alumnos que cumplan con los criterios de búsqueda seleccionados');
        }
        //Creamos los datos a usar por el pdf
        $data = [
            "alumnos" => $alumnos,
            "departamento" => " todos los departamentos"
        ];

        //Creamos el pdf con la vista tablaAlumnos
        $pdf = PDF::loadView('pdf.tablaAlumnos', $data)->setOptions(['defaultFont' => 'sans-serif']);

        //Indicamos que se debe de descargar el pdf
        return $pdf->download('alumnos_'.$request['tipo_dato_selector'].'_'.$departamento.'_'.$date->format('Y_m_d').'.pdf');
    }

    /*
    * @brief Función encargada de retornar el documento de excel con los alumnos filtrados
    * @param Objeto de tipo request con el periodo y departamento seleccionados
    * @return Se retorna el pdf con los datos solicitados
    */
    public function getDocumentoDepartamento(Request $request){
        $date = Carbon::now();
        //Validamos que se ingresaran el periodo y el departamento
        $request->validate([
            'periodo' => 'required',
            'departamento' => 'required',
        ]);
        //Convertimos el periodo en fecha con formato YYYY-mm
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
        //Obtenemos los alumnos de la fecha y departamento seleccionados
        $toReturn = DB::Table('alumno')
            ->join('departamento','departamento.id', '=', 'alumno.departamento_id')
            ->select('alumno.nombres','alumno.apellido_paterno','alumno.apellido_materno','alumno.fecha_inicio','alumno.fecha_fin')
            ->whereBetween('alumno.fecha_inicio',[$fecha_inicio,$fecha_fin])
            ->where('departamento.abreviatura_departamento','=',$request["departamento"]);
        $alumnos = $toReturn->get();

        //Si no hay alumnos lo indicmos al usuario
        if(sizeof($alumnos) == 0){
            return redirect()->back()->with('fail','No hay alumnos inscritos en el periodo '.$dato.' en el departamento '.$request["departamento"]);
        }

        //Obtenemos los datos del departamento y del jefe de departamento
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
        //Obtenemos el género del jefe de departamento
        $genero = ($jefe->nombres[strlen($jefe->nombres)-1] == "a") ? true : false;
        $genero_2 = ($jefe_departamento_documento->nombres[strlen($jefe_departamento_documento->nombres)-1] == "a") ? true : false;

        //Creamos la lista con los datos a utilizar en el pdf
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

        //Creamos el pdf a partir de la vista servicio_social_division
        $pdf = PDF::loadView('pdf.servicio_social_division', $data)->setOptions(['defaultFont' => 'sans-serif']);

        //Mandamos a descargar el pdf
        return $pdf->download('ServSocial_'.$request["departamento"].'_'.$request["periodo"].'.pdf');
    }
}


