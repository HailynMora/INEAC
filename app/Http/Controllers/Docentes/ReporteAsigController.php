<?php

namespace App\Http\Controllers\Docentes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ObjetivosModel\Objetivos;
use Illuminate\Support\Facades\Auth;
use DB;
Use Session;


class ReporteAsigController extends Controller
{
    public function busquedares_asigc(Request $request){
        /*$busasigc =  $rep=DB::table('asignaturas')->where('asignaturas.nombre','=',$request->nombre)
                            ->select('asignaturas.id','asignaturas.codigo','asignaturas.nombre as asig','intensidad_horaria','val_habilitacion','estado.descripcion as estado')
                            ->join('estado','id_estado','=','estado.id')
                        ->get();*/
        $idlog=auth()->id();
        $doc=DB::table('docente')->where('docente.id_usuario',$idlog)->select('docente.id')->get();
        $d= $doc[0]->id;
        $busasigc=DB::table('cursos')
        ->where('cursos.id_docente',$d)
        ->where('asignaturas.nombre','=',$request->nombre)
        ->join('asignaturas','cursos.id_asignatura','=','asignaturas.id')
        ->join('estado','id_estado','=','estado.id')
        ->join('tipo_curso','cursos.id_tipo_curso','=','tipo_curso.id')
        ->select('asignaturas.id','asignaturas.codigo','asignaturas.nombre as asig','intensidad_horaria','val_habilitacion','estado.descripcion as estado','tipo_curso.descripcion as curso')
        ->get();
                       
     return response(json_decode($busasigc,JSON_UNESCAPED_UNICODE),200)->header('Content-type', 'text/plain');
    }

    public function busquedares_asigt(Request $request){
        /*$busasigt = $rep=DB::table('asig_tecnicos')->where('asig_tecnicos.nombreasig','=',$request->nombre)
                    ->select('asig_tecnicos.id','asig_tecnicos.codigoasig','asig_tecnicos.nombreasig as asig','intensidad_horaria','val_habilitacion','estado.descripcion as estado')
                    ->join('estado','id_estado','=','estado.id')
                    ->get();*/
        $idlog=auth()->id();
        $doc=DB::table('docente')->where('docente.id_usuario',$idlog)->select('docente.id')->get();
        $d= $doc[0]->id;
        $busasigt=DB::table('asignaturas_tecnicos')
        ->where('asignaturas_tecnicos.id_docente',$d)
        ->where('asig_tecnicos.nombreasig','LIKE',$request->nombre)
        ->select('asig_tecnicos.id','asig_tecnicos.codigoasig','asig_tecnicos.nombreasig as asig','intensidad_horaria','val_habilitacion','programa_tecnico.nombretec')
        ->join('programa_tecnico','asignaturas_tecnicos.id_tecnico','=','programa_tecnico.id')
        ->join('asig_tecnicos','asignaturas_tecnicos.id_asignaturas','=','asig_tecnicos.id')
        ->get();
     return response(json_decode($busasigt,JSON_UNESCAPED_UNICODE),200)->header('Content-type', 'text/plain');
    }
    
    public function reg(Request $request){
        $category = new Objetivos();
        $category->id_asignaturas= $request->input('idasigna');
        $category->descripcion = $request->input('objetivo');
        $category->save();
        Session::flash('msjobjetivo','Objetivos registrados de manera exitosa!');
        return back();
    }

    //eliminar objetivos de la asignatura
    public function elim_obj($id){
        DB::table('objetivos')->where('objetivos.id', $id)->delete();
        Session::flash('elimi','Objetivo eliminado de manera exitosa!');
        return back();
    }

}
