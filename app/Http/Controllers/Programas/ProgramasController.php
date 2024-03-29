<?php

namespace App\Http\Controllers\Programas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AsignaturaModel\Programas;
use App\Models\EstadoModel\Estado;
use App\Models\AsignaturaModel\Asignatura;
use App\Models\AsignaturaModel\AsigProgram;
use Illuminate\Support\Facades\DB;
use App\Models\AsignaturaModel\ProgramasTecnicos;
use App\Models\TrimestresModel\TrimestresTecnicos;
use App\Models\AsignaturaModel\AsigTecnicos;
use App\Models\AsignacionDoModel\AsignacionDoTec;
use App\Models\DocenteModel\Docente;
use App\Models\AsignaturaModel\AsignaturaTecnicos;
use App\Models\Archivo;
use Carbon\Carbon;
use Session;


class ProgramasController extends Controller
{
    public function index(){

        $estado=Estado::all();
        
        return view('programas.registro')->with('estado', $estado);

    }
    public function tec(){

        $estado=Estado::all();
        return view('programas.resgistrotecnicos')->with('estado', $estado);

    }
    public function registro(Request $request){
        $cod=$request->codigo;
        $buscod = DB::table('tipo_curso')->where('codigo', '=', $cod)->count();
        $busnom = DB::table('tipo_curso')->where('descripcion', '=', $request->nombre)->count();
        if($buscod!=0){//validacion con ajax
            return \Response::json([
                'error'  => 'Error datos'
            ],422);
        }else{

            if($busnom!=0){
                return \Response::json([
                    'error'  => 'Error datos'
                ],423);
            }else{
                $category = new Programas();
                $category->codigo = $request->input('codigo');
                $category->descripcion = $request->input('nombac');
                $category->id_estado = $request->input('estado');
                $category->cursodes = $request->input('des');
                $category->jornada = $request->input('jornada');
                $category->save();
    
            }

        }
        
        return back();

    }

    public function registro_tecnicos(Request $request){
        $cod=$request->codigo;
        $buscod = DB::table('programa_tecnico')->where('codigotec', '=', $cod)->count();
        $busnom = DB::table('programa_tecnico')->where('nombretec', '=', $request->nomtec)->count();
        if($buscod!=0){//validacion con ajax
            return \Response::json([
                'error'  => 'Error datos'
            ],422);
        }else{

            if($busnom!=0){
                return \Response::json([
                    'error'  => 'Error datos'
                ],423);
            }else{
                 $category = new ProgramasTecnicos();
                $category->codigotec = $request->input('codigo');
                $category->nombretec = $request->input('nomtec');
                $category->id_estado = $request->input('estado');
                $category->descripcion = $request->input('descripcion');
                $category->jornada = $request->input('jornada');
                $category->save();
            }

        }
       
        return back();

    }

    public function vincular(){
        $curso=Programas::all();
        $asig=Asignatura::all();
        return view('programas.vincularsig')->with('curso', $curso)->with('asignatura', $asig);

    }

    public function regasigcurso(Request $request){
        $r=$request->curso; 
        $r1=$request->asig; 

        $resdatos=DB::table('cursos')
                 ->where('id_asignatura', '=', $r1)
                 ->where('id_tipo_curso', '=', $r)
                 ->where('anio', '=', $request->anio)
                 ->where('periodo', '=', $request->periodo)
                 ->count();


        if($resdatos!=0){
               return \Response::json([
                'error'  => 'Error datos'
            ],422);
            
        }else{
           
            $category = new AsigProgram();
            $category->id_asignatura = $request->input('asig');
            $category->id_tipo_curso = $request->input('curso');
            $category->id_docente = $request->input('docente');
            $category->anio = $request->input('anio');
            $category->periodo = $request->input('periodo');
            $category->save();
            return back();   
            
        }

    }
    
    public function listarvinculacion(Request $request){
    
        $asigpro=DB::table('cursos')
                ->select('cursos.id','id_asignatura','id_tipo_curso','asignaturas.codigo as codas',
                        'asignaturas.nombre as asig','tipo_curso.codigo as codcur',
                        'tipo_curso.descripcion as curso','docente.nombre as nomdoc',
                        'docente.apellido as apedoc', 'cursos.anio', 'cursos.periodo')
                ->join('asignaturas','id_asignatura','=','asignaturas.id')
                ->join('tipo_curso','id_tipo_curso','=','tipo_curso.id')
                ->join('docente','id_docente','=','docente.id')
                ->where('cursos.anio', $request->anio)
                ->where('cursos.periodo', $request->periodo)
                ->where('cursos.id_tipo_curso', $request->cursoid)
                 ->paginate(5); //hacer paginacion de las vistas
       
        return view('programas.listarvinculacion')->with('asigpro',$asigpro);

    }

    public function consulta(){
        return view('programas.consultar');
    }

    public function search(Request $request){
        $results = Programas::where('descripcion', 'LIKE', "%{$request->search}%")->get();
        return view('programas.results', compact('results'))->with(['search' => $request->search])->render();
    }
        
    public function show(Request $request){
        $post = DB::table('tipo_curso')->where('tipo_curso.id','=',$request->id)
        ->join('estado','id_estado','=','estado.id')
        ->select('tipo_curso.id','tipo_curso.codigo','tipo_curso.descripcion as programa','tipo_curso.id_estado','estado.descripcion as estado')
        ->get();
        $estado=Estado::all();
        return view('programas.post', compact('post','estado'))->render();
    }

    public function reporte(){
        $rep=DB::table('tipo_curso')
            ->select('tipo_curso.id','tipo_curso.codigo','tipo_curso.descripcion as programa','tipo_curso.cursodes','estado.descripcion as estado','tipo_curso.jornada')
            ->join('estado','id_estado','=','estado.id')
            ->orderBy('tipo_curso.id', 'ASC')
            ->paginate(10); //hacer paginacion de las vistas
            //##################### listado
            $anio=DB::table('cursos')
                     ->select('cursos.anio')->distinct()->get();
            $period=DB::table('cursos')
                     ->select('cursos.periodo')->distinct()->get();         
        return view('programas.reporte_bachillerato')->with('rep',$rep)->with('anio',$anio)->with('period',$period);
    }

    public function reporte_tecnico(){
        $rep=DB::table('programa_tecnico')
            ->select('programa_tecnico.id','programa_tecnico.codigotec','programa_tecnico.descripcion','programa_tecnico.nombretec','programa_tecnico.jornada','estado.descripcion as estado')
            ->join('estado','id_estado','=','estado.id')
            ->orderBy('programa_tecnico.id', 'ASC')
            //->paginate(5); //hacer paginacion de las vistas
            ->get();
        $anio=DB::table('asignaturas_tecnicos')->select('asignaturas_tecnicos.anio')->distinct()->get(); //hacer paginacion de las vistas
        $tri=DB::table('asignaturas_tecnicos')
                ->join('trimestre_tecnicos','asignaturas_tecnicos.id_trimestre','=','trimestre_tecnicos.id')
                ->select('asignaturas_tecnicos.id_trimestre', 'trimestre_tecnicos.nombretri')
                ->distinct()->get(); //hacer paginacion de las vistas
        return view('programas.reporte_tecnico')->with('rep',$rep)->with('anio',$anio)->with('tri',$tri);
    }

    public function form_actualizar($id){
        $d =$id;
        $prog = DB::table('tipo_curso')->where('tipo_curso.id','=',$d)
        ->join('estado','id_estado','=','estado.id')
        ->select('tipo_curso.id','tipo_curso.codigo','tipo_curso.descripcion as programa','tipo_curso.cursodes','tipo_curso.id_estado','tipo_curso.jornada','estado.descripcion as estado')
        ->get();
        $estado=Estado::all();
        return view('programas.actualizar_programa', compact('prog','estado'));
    }

    public function actualizar_programa(Request $request,$id){
        $category = Programas::FindOrFail($id);
        $category->codigo = $request->input('codigo');
        $category->descripcion = $request->input('nombre');
        $category->id_estado = $request->input('estado');
        $category->cursodes = $request->input('des');
        $category->jornada = $request->input('jornada');
        $category->save();
        return redirect('/programas/reporte_programas');

    }
    public function form_actualizar_tecnico($id){
        $d =$id;
        $prog = DB::table('programa_tecnico')->where('programa_tecnico.id','=',$d)
        ->join('estado','id_estado','=','estado.id')
        ->select('programa_tecnico.id','programa_tecnico.codigotec','programa_tecnico.descripcion','programa_tecnico.nombretec','programa_tecnico.id_estado','programa_tecnico.jornada','estado.descripcion as estado')
        ->get();
        $estado=Estado::all();
        return view('programas.actualizar_programa_tecnico', compact('prog','estado'));
    }

    public function actualizar_programa_tecnico(Request $request,$id){
        $category = ProgramasTecnicos::FindOrFail($id);
        $category->codigotec = $request->input('codigo');
        $category->nombretec = $request->input('nombre');
        $category->descripcion = $request->input('descripcion');
        $category->jornada = $request->input('jornada');
        $category->id_estado = $request->input('estado');
        $category->save();
        return redirect('/programas/reporte_programas_tecnicos');

    }
    public function cambiar_pro($id){
        $pro = Programas::find($id);
        $es = $pro->id_estado;
        if($es==2){
            $pro->id_estado = 1;
            $pro->save();
        }else{
            $pro->id_estado = 2;
            $pro->save();
        }        
        $nombre = $pro->descripcion;
        return redirect('/programas/reporte_programas');
    }
    public function cambiar_pro_tec($id){
        $pro = ProgramasTecnicos::find($id);
        $es = $pro->id_estado;
        if($es==2){
            $pro->id_estado = 1;
            $pro->save();
        }else{
            $pro->id_estado = 2;
            $pro->save();
        }        
        return redirect('/programas/reporte_programas_tecnicos');
    }
    public function vincu($id){
        $date = Carbon::now()->locale('es')->translatedFormat('Y');
        $curso=Programas::find($id);
        //$asig=Asignatura::all();
        $asig=DB::table('asignaturas')->where('id_estado', '=', '1')->get();
        $docente=DB::table('docente')->where('id_estado', '=', '1')->get();
        return view('programas.vincularsig')->with('curso', $curso)->with('asignatura', $asig)->with('docente', $docente)->with('date', $date);

    }
    public function vincu_asig($id){
        $date = Carbon::now()->locale('es')->translatedFormat('Y');
        $curso=ProgramasTecnicos::find($id);
        $asig=DB::table('asig_tecnicos')->where('id_estado', '=', '1')->get();
        $tri=TrimestresTecnicos::all();
        $docente=DB::table('docente')->where('id_estado', '=', '1')->get();
        ////////////////////////////
        $asigpro=DB::table('asignaturas_tecnicos')
        ->join('asig_tecnicos','asignaturas_tecnicos.id_asignaturas','=','asig_tecnicos.id')
        ->join('trimestre_tecnicos','asignaturas_tecnicos.id_trimestre','=','trimestre_tecnicos.id')
        ->join('docente','asignaturas_tecnicos.id_docente','=','docente.id')
        ->join('programa_tecnico','asignaturas_tecnicos.id_tecnico','=','programa_tecnico.id')
        ->select('asignaturas_tecnicos.id','id_asignaturas','id_trimestre','asig_tecnicos.codigoasig as codas',
                  'asig_tecnicos.nombreasig as asig', 'asig_tecnicos.intensidad_horaria as horas', 
                  'programa_tecnico.codigotec','programa_tecnico.nombretec',
                  'trimestre_tecnicos.nombretri','docente.nombre as nomdoc','docente.apellido as apedoc',
                  'asignaturas_tecnicos.anio', 'asignaturas_tecnicos.periodo')
        ->orderBy('asignaturas_tecnicos.periodo', 'ASC')
        ->get(); //hacer paginacion de las vistas
        ///////////////////////////
        return view('programas.vincular_asig_tecnico')->with('curso', $curso)
              ->with('asignatura', $asig)->with('trimestre', $tri)->with('docente', $docente)
              ->with('asigpro',$asigpro)->with('date',$date);

    }

    public function vinculacion_tec(Request $request){
        $valores=DB::table('asignaturas_tecnicos')
                    ->join('asig_tecnicos','asignaturas_tecnicos.id_asignaturas','=','asig_tecnicos.id')
                    ->join('trimestre_tecnicos','asignaturas_tecnicos.id_trimestre','=','trimestre_tecnicos.id')
                    ->join('docente','asignaturas_tecnicos.id_docente','=','docente.id')
                    ->join('programa_tecnico','asignaturas_tecnicos.id_tecnico','=','programa_tecnico.id')
                    ->where('asignaturas_tecnicos.id_tecnico', '=', $request->cursoid)
                    ->where('asignaturas_tecnicos.id_trimestre', '=', $request->trim)
                    ->where('asignaturas_tecnicos.anio', '=', $request->aniot)
                    ->select('asignaturas_tecnicos.id','id_asignaturas','id_trimestre','asig_tecnicos.codigoasig as codas',
                            'asig_tecnicos.nombreasig as asig', 'asig_tecnicos.intensidad_horaria as horas', 
                            'programa_tecnico.codigotec','programa_tecnico.nombretec',
                            'trimestre_tecnicos.nombretri','docente.nombre as nomdoc','docente.apellido as apedoc',
                            'asignaturas_tecnicos.anio', 'asignaturas_tecnicos.periodo')
                    ->orderBy('asignaturas_tecnicos.periodo', 'ASC')
                    ->get(); //hacer paginacion de las vistas
        ///////////////////////////
        return view('programas.asignaturasvintec')->with('asigpro',$valores);

    } 

    public function asig_tec(Request $request){
        
        $r=$request->curso; 
        $r1=$request->asig; 
        $r2=$request->tri;
        $r3=$request->docente;
        $r4 = $request->anio;
     if($r1 != 0 && $r2 != 0 && $r3 != 0 && $r4 != NULL){
        $resdatos=DB::table('asignaturas_tecnicos')
                  ->where('id_asignaturas', '=', $r1)
                  ->where('id_tecnico', '=', $r)
                  ->where('id_trimestre', '=', $r2)
                  ->where('anio', '=', $request->anio)
                  ->where('periodo', '=', $request->periodo)
                  ->count();

        if($resdatos!=0){

            Session::flash('mensaje', 'Datos Repetidos! Asignatura ya esta vinculada.');
              
            
        }else{
           
            $category = new AsigTecnicos();
            $category->id_asignaturas = $request->input('asig');
            $category->id_tecnico = $request->input('curso');
            $category->id_trimestre = $request->input('tri');
            $category->id_docente = $request->input('docente');
            $category->anio = $request->input('anio');
            $category->periodo = $request->input('periodo');
            $category->save();
            Session::flash('mensajeconf', 'Asignatura Vinculada exitosamente!.');
            
        }
    }else{
        Session::flash('mensaje', 'Campos vacios! Por favor seleccione todos los campos.');
    }

        return back();   

    }
    
    public function desvincular($id){
        $val = DB::table('notas')->where('id_curso', $id)->count();
        if($val==0){
            AsigProgram::find($id)->delete();
            Session::flash('mensaje', 'Registro eliminado de manera exitosa!.');
        }else{
            Session::flash('mensaje', 'No se puede eliminar este campo, la asignatura ya tiene notas.');
        }
        return redirect('/programas/reporte_programas');
    }


    public function listarvinculaciontec(){
        $asigpro=DB::table('asignaturas_tecnicos')
        ->select('asignaturas_tecnicos.id','id_asignaturas','id_trimestre','asignaturas.codigo as codas','asignaturas.nombre as asig','programa_tecnico.codigotec','programa_tecnico.nombretec','trimestre_tecnicos.nombretri','docente.nombre as nomdoc','docente.apellido as apedoc')
        ->join('asignaturas','id_asignaturas','=','asignaturas.id')
        ->join('trimestre_tecnicos','id_trimestre','=','trimestre_tecnicos.id')
        ->join('docente','id_docente','=','docente.id')
        ->join('programa_tecnico','id_tecnico','=','programa_tecnico.id')
        ->orderBy('asignaturas_tecnicos.id_tecnico', 'ASC')
        ->paginate(5); //hacer paginacion de las vistas
        return view('programas.listado_vinculacion_tec')->with('asigpro',$asigpro);

    }

    public function eliminartec($id){
        $val = DB::table('notas_tecnico')->where('id_tecnicos', '=', $id)->count();
        if($val == 0){
            DB::table('asignaturas_tecnicos')->where('id','=',$id)->delete();
            Session::flash('mensaje', 'Registro eliminado de manera exitosa!.');
        }else{
            Session::flash('mensaje', 'No se puede eliminar este campo, la asignatura ya tiene notas.');
        }
        return redirect('/programas/reporte_programas_tecnicos');
    }

    //////////////////buscar ciclo////////////////////////
    public function busquedares_ciclo(Request $request){
        $nom=$request->nombre;
        $busciclo =  $tec=DB::table('tipo_curso')->where('tipo_curso.descripcion','=', $nom)
                        ->join('estado','id_estado','=','estado.id')
                        ->select('tipo_curso.id','tipo_curso.codigo','tipo_curso.descripcion','tipo_curso.cursodes','tipo_curso.jornada','estado.descripcion as estado')
                        ->get();
     return response(json_decode($busciclo,JSON_UNESCAPED_UNICODE),200)->header('Content-type', 'text/plain');
    }
    ////////////////////////////////////////
    //////////////////buscar tecnico////////////////////////
    public function busquedares_pro(Request $request){
        $nom=$request->nombre;
        $bustecnico =  $tec=DB::table('programa_tecnico')->where('programa_tecnico.nombretec','=', $nom)
                        ->join('estado','id_estado','=','estado.id')
                        ->select('programa_tecnico.id','programa_tecnico.codigotec','programa_tecnico.descripcion','programa_tecnico.nombretec','programa_tecnico.jornada','estado.descripcion as estado')
                        ->get();
        
     return response(json_decode($bustecnico,JSON_UNESCAPED_UNICODE),200)->header('Content-type', 'text/plain');
    }
    ////////////////////////////////////////
    //publicidad se debe copiar al server
    public function publi(){
       return view('programas.publicidad');
    }

    public function savepubli(Request $request){
          if($request->val == 1){
            $archivo = Archivo::FindOrFail(1);
            if($request->hasFile('img')){                 
                $file = $request->file('img');
                $val = "publicidad".time().".".$file->guessExtension();
                $ruta = public_path("dist/perfil/".$val);
                copy($file, $ruta);//ccopia el archivo de una ruta cualquiera a donde este
                $archivo->archivo = $val;//ingresa el nombre de la ruta a la base de datos
            }
            $archivo->descrip = $request->input('info'); 
            $archivo->estado = 1; 
        }else{

            $archivo = Archivo::FindOrFail(2);
            if($request->hasFile('img')){                 
                $file = $request->file('img');
                $val = "publicidadtec".time().".".$file->guessExtension();
                $ruta = public_path("dist/perfil/".$val);
                copy($file, $ruta);//ccopia el archivo de una ruta cualquiera a donde este
                $archivo->archivo = $val;//ingresa el nombre de la ruta a la base de datos
            }
            $archivo->descrip = $request->input('info');
            $archivo->estado = 1; 
        }
        $archivo->save(); 
        Session::flash('mensajepub', 'Información cargada de manera exitosa!.');
        $estado = DB::table('publicidad')->where('estado', '=', '1')->count();
        return view('programas.publicidad')->with('estado', $estado);
     }

     public function camestado($id){
        if($id == 1){
           $ar = Archivo::FindOrFail(1);
            $ar->estado = 1; 
            $ar->save();
            $ar2 = Archivo::FindOrFail(2);
            $ar2->estado = 1; 
            $ar2->save();
        }else{
            $ar = Archivo::FindOrFail(1);
            $ar->estado = 2; 
            $ar->save();
            $ar2 = Archivo::FindOrFail(2);
            $ar2->estado = 2; 
            $ar2->save();
        }
        Session::flash('mensajepub', 'Estado se actualizó de manera exitosa!.');
        $estado = DB::table('publicidad')->where('estado', '=', '1')->count();
        return view('programas.publicidad')->with('estado', $estado);
     }
   

}
