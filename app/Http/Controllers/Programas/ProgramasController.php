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
                $category->descripcion = $request->input('nombre');
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
        $busnom = DB::table('programa_tecnico')->where('nombretec', '=', $request->nombre)->count();
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
                $category->nombretec = $request->input('nombre');
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
        ->where('id_asignatura', '=', $r1)->where('id_tipo_curso', '=', $r)->count();


        if($resdatos!=0){
               return \Response::json([
                'error'  => 'Error datos'
            ],422);
            
        }else{
           
            $category = new AsigProgram();
            $category->id_asignatura = $request->input('asig');
            $category->id_tipo_curso = $request->input('curso');
            $category->fecha = $request->input('fecha');
            $category->save();
            return back();   
            
        }

    }
    
    public function listarvinculacion(){
        $asigpro=DB::table('cursos')
        ->select('cursos.id','id_asignatura','id_tipo_curso','asignaturas.codigo as codas','asignaturas.nombre as asig','tipo_curso.codigo as codcur','tipo_curso.descripcion as curso')
        ->join('asignaturas','id_asignatura','=','asignaturas.id')
        ->join('tipo_curso','id_tipo_curso','=','tipo_curso.id')
        ->orderBy('cursos.id_tipo_curso', 'ASC')
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
        ->paginate(5); //hacer paginacion de las vistas
        return view('programas.reporte_bachillerato')->with('rep',$rep);
    }

    public function reporte_tecnico(){
        $rep=DB::table('programa_tecnico')
        ->select('programa_tecnico.id','programa_tecnico.codigotec','programa_tecnico.descripcion','programa_tecnico.nombretec','programa_tecnico.jornada','estado.descripcion as estado')
        ->join('estado','id_estado','=','estado.id')
        ->orderBy('programa_tecnico.id', 'ASC')
        //->paginate(5); //hacer paginacion de las vistas
        ->get();
        return view('programas.reporte_tecnico')->with('rep',$rep);
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
        $curso=Programas::find($id);
        $asig=Asignatura::all();
        return view('programas.vincularsig')->with('curso', $curso)->with('asignatura', $asig);

    }
    public function vincu_asig($id){
        $curso=ProgramasTecnicos::find($id);
        $asig=AsignaturaTecnicos::all();
        $tri=TrimestresTecnicos::all();
        $docente=Docente::all();
        ////////////////////////////
        $asigpro=DB::table('asignaturas_tecnicos')
        ->select('asignaturas_tecnicos.id','id_asignaturas','id_trimestre','asignaturas.codigo as codas','asignaturas.nombre as asig','programa_tecnico.codigotec','programa_tecnico.nombretec','trimestre_tecnicos.nombretri','docente.nombre as nomdoc','docente.apellido as apedoc')
        ->join('asignaturas','id_asignaturas','=','asignaturas.id')
        ->join('trimestre_tecnicos','id_trimestre','=','trimestre_tecnicos.id')
        ->join('docente','id_docente','=','docente.id')
        ->join('programa_tecnico','id_tecnico','=','programa_tecnico.id')
        ->orderBy('asignaturas_tecnicos.id_tecnico', 'ASC')
        ->paginate(5); //hacer paginacion de las vistas
        ///////////////////////////
        return view('programas.vincular_asig_tecnico')->with('curso', $curso)->with('asignatura', $asig)->with('trimestre', $tri)->with('docente', $docente)->with('asigpro',$asigpro);

    }

    public function asig_tec(Request $request){
        $r=$request->curso; 
        $r1=$request->asig; 
        $r2=$request->tri;
        $r3=$request->docente;
        $resdatos=DB::table('asignaturas_tecnicos')
        ->where('id_asignaturas', '=', $r1)->where('id_tecnico', '=', $r)->where('id_trimestre', '=', $r2)->count();


        if($resdatos!=0){
               return \Response::json([
                'error'  => 'Error datos'
            ],422);
            
        }else{
           
            $category = new AsigTecnicos();
            $category->id_asignaturas = $request->input('asig');
            $category->id_tecnico = $request->input('curso');
            $category->id_trimestre = $request->input('tri');
            $category->id_docente = $request->input('docente');
            $category->save();
            return back();   
            
        }

    }
    

    public function desvincular($id){
        AsigProgram::find($id)->delete();
        return redirect('/programas/listado_vinculacion');
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
        DB::table('asignaturas_tecnicos')->where('id','=',$id)->delete();
        Session::flash('mensaje', 'Dato eliminado con éxito!');
        return back();
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

}
