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


class ProgramasController extends Controller
{
    public function index(){

        $estado=Estado::all();
        
        return view('programas.registro')->with('estado', $estado);

    }
    public function tec(){

        $estado=Estado::all();
        $trimestre=TrimestresTecnicos::all();
        return view('programas.resgistrotecnicos')->with('estado', $estado)->with('trimestre', $trimestre);

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
                $category->id_trimestre = $request->input('trimestre');
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
        ->select('tipo_curso.id','tipo_curso.codigo','tipo_curso.descripcion as programa','estado.descripcion as estado')
        ->join('estado','id_estado','=','estado.id')
        ->orderBy('tipo_curso.id', 'ASC')
        ->paginate(5); //hacer paginacion de las vistas
        return view('programas.reporte_bachillerato')->with('rep',$rep);
    }

    public function reporte_tecnico(){
        $rep=DB::table('programa_tecnico')
        ->select('programa_tecnico.id','programa_tecnico.codigotec','programa_tecnico.nombretec','programa_tecnico.id_trimestre','estado.descripcion as estado','trimestre_tecnicos.id as is_tri', 'trimestre_tecnicos.nombretri')
        ->join('estado','id_estado','=','estado.id')
        ->join('trimestre_tecnicos','id_trimestre','=','trimestre_tecnicos.id')
        ->orderBy('programa_tecnico.id', 'ASC')
        //->paginate(5); //hacer paginacion de las vistas
        ->get();
        return view('programas.reporte_tecnico')->with('rep',$rep);
    }

    public function form_actualizar($id){
        $d =$id;
        $prog = DB::table('tipo_curso')->where('tipo_curso.id','=',$d)
        ->join('estado','id_estado','=','estado.id')
        ->select('tipo_curso.id','tipo_curso.codigo','tipo_curso.descripcion as programa','tipo_curso.id_estado','estado.descripcion as estado')
        ->get();
        $estado=Estado::all();
        return view('programas.actualizar_programa', compact('prog','estado'));
    }

    public function actualizar_programa(Request $request,$id){
        $category = Programas::FindOrFail($id);
        $category->codigo = $request->input('codigo');
        $category->descripcion = $request->input('nombre');
        $category->id_estado = $request->input('estado');
        $category->save();
        return redirect('/asignatura/reporte_asignatura');

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
    public function vincu($id){
        $curso=Programas::find($id);
        $asig=Asignatura::all();
        return view('programas.vincularsig')->with('curso', $curso)->with('asignatura', $asig);

    }
    public function desvincular($id){
        AsigProgram::find($id)->delete();
        return redirect('/programas/listado_vinculacion');
    }

}
