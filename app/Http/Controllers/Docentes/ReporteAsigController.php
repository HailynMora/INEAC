<?php

namespace App\Http\Controllers\Docentes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ObjetivosModel\Objetivos;
use Illuminate\Support\Facades\Auth;
use App\Models\ObjetivosModel\ObjetivosTec;
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
        ->select('cursos.id','asignaturas.codigo','asignaturas.nombre as asig',
                 'intensidad_horaria','val_habilitacion','estado.descripcion as estado',
                 'tipo_curso.descripcion as curso', 'cursos.anio', 'cursos.periodo')
        ->get();
                       
     return response(json_decode($busasigc,JSON_UNESCAPED_UNICODE),200)->header('Content-type', 'text/plain');
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

    //filtrar objetivos de la asig
    
    public function filtrarobjec(Request $request){
        $idlog=auth()->id();
        $doc=DB::table('docente')->where('docente.id_usuario', '=', $idlog)->select('docente.id')->first();
        $d= $doc->id;
        $rep=DB::table('cursos')
        ->where('cursos.id_docente',$d)
        ->where('cursos.periodo',$request->periodo)
        ->where('cursos.anio',$request->anio)
        ->join('asignaturas','cursos.id_asignatura','=','asignaturas.id')
        ->join('estado','id_estado','=','estado.id')
        ->join('tipo_curso','cursos.id_tipo_curso','=','tipo_curso.id')
        ->select('asignaturas.id as idasig', 'asignaturas.codigo',
        'asignaturas.nombre as asig','intensidad_horaria',
        'val_habilitacion','estado.descripcion as estado',
        'tipo_curso.descripcion as curso', 'cursos.anio',
        'cursos.periodo', 'cursos.id as ida', 'cursos.id_tipo_curso as idcurso')
        ->get();
       
        //consultar si existe objetivos
        $val=DB::table('objetivos')->count();
        if($val!=0){
            $b=1;
            $ob = DB::table('objetivos')->get();
        }else{
            $b=0;
            $ob=0;
        }
        //validar si muestra el boton
        $ver=DB::table('asignaturas_tecnicos')->where('asignaturas_tecnicos.id_docente', $d)->count();
       
        return view('asignatura.reporte_asig_docc')->with('rep',$rep)->with('ob',$ob)->with('b',$b)->with('boton',$ver);
    }

    public function filtrar_tec_as(Request $request){
          
            $idlog=auth()->id();
            $doc=DB::table('docente')->where('docente.id_usuario', '=', $idlog)->select('docente.id as iddoc')->first();
            $tri = DB::table('trimestre_tecnicos')->where('nombretri', $request->trimestre)->select('id')->first();
            $d= $doc->iddoc;
            $repe=DB::table('asignaturas_tecnicos')
            ->where('asignaturas_tecnicos.id_docente',$d)
            ->where('asignaturas_tecnicos.periodo',$request->periodo)
            ->where('asignaturas_tecnicos.anio',$request->anio)
            ->where('asignaturas_tecnicos.id_trimestre',$tri->id)
            ->join('asig_tecnicos','asignaturas_tecnicos.id_asignaturas','=','asig_tecnicos.id')
            ->join('estado','asig_tecnicos.id_estado','=','estado.id')
            ->join('programa_tecnico','asignaturas_tecnicos.id_tecnico','=','programa_tecnico.id')
            ->join('trimestre_tecnicos','asignaturas_tecnicos.id_trimestre','=','trimestre_tecnicos.id')
            ->select('asignaturas_tecnicos.id as idastec','asig_tecnicos.codigoasig','asig_tecnicos.id as idasig',
                 'asig_tecnicos.nombreasig as asig','intensidad_horaria',
                 'val_habilitacion','programa_tecnico.id as idtec','programa_tecnico.nombretec', 'asignaturas_tecnicos.anio', 
                 'asignaturas_tecnicos.periodo','trimestre_tecnicos.id as idtri', 'trimestre_tecnicos.nombretri as trimestre')
            ->get();

            $val=DB::table('objetivostec')->count();
           
            if($val!=0){
                $b=1;
                $ob = DB::table('objetivostec')->get();
            }else{
                $b=0;
                $ob=0;
            }
            return view('asignatura.reporte_asig_doc')->with('repe',$repe)->with('b',$b)->with('ob',$ob);

    }

    public function regobtec(Request $request){
       // return $request;
        $category = new ObjetivosTec();
        $category->id_asignaturas = $request->input('idasigna');
        $category->descripcion = $request->input('objetivo');
        $category->save();
        Session::flash('msjobjetivo','Objetivos registrados de manera exitosa!');
        return back();
    }

    //eliminar objetivos de la asignatura tecnicos
    public function elim_objtec($id){
        DB::table('objetivostec')->where('objetivostec.id', $id)->delete();
        Session::flash('elimi','Objetivo eliminado de manera exitosa!');
        return back();
    }

}
