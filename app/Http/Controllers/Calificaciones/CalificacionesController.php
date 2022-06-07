<?php

namespace App\Http\Controllers\Calificaciones;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\CalificacionesModel\Notas;

class CalificacionesController extends Controller
{
    public function listado($id, $anio, $per){
        $estumat = DB::table('matriculas')
                ->where('id_curso', $id)
                ->where('anio', $anio)->where('periodo', $per)
                ->join('estudiante', 'matriculas.id_estudiante', '=', 'estudiante.id')
                ->join('tipo_curso', 'matriculas.id_curso', '=', 'tipo_curso.id')
                ->join('tipo_documento', 'estudiante.id_tipo_doc', '=', 'tipo_documento.id')
                ->select('matriculas.id as idmat', 'matriculas.id_estudiante as idest', 
                        'matriculas.id_curso as idcur', 'estudiante.first_nom as nombre', 'estudiante.second_nom as segundonom', 
                        'estudiante.second_ape as segundoape', 'estudiante.firts_ape as primerape',
                        'estudiante.telefono', 'estudiante.num_doc', 'tipo_documento.descripcion as destipo', 
                        'tipo_curso.descripcion as nomcurso', 'matriculas.periodo as per', 'matriculas.anio as an')
                ->get();
       /* $estumat=DB::table('matriculas')->where('id_curso', '=', $i)
        ->join('estudiante', 'matriculas.id_estudiante', '=', 'estudiante.id')
        ->join('tipo_curso', 'matriculas.id_curso', '=', 'tipo_curso.id')
        ->join('tipo_documento', 'estudiante.id_tipo_doc', '=', 'tipo_documento.id')
        ->select('matriculas.id as idmat', 'matriculas.id_estudiante as idest', 
        'matriculas.id_curso as idcur', 'estudiante.first_nom as nombre', 'estudiante.second_nom as segundonom', 
        'estudiante.second_ape as segundoape', 'estudiante.firts_ape as primerape',
        'estudiante.telefono', 'estudiante.num_doc', 'tipo_documento.descripcion as destipo', 
        'tipo_curso.descripcion as nomcurso')
        ->get();
       */
               // ->with('estumat',$estumat)

            $as=DB::table('cursos')
                    ->where('id_tipo_curso','=',$id)
                    ->where('anio','=',$anio)
                    ->where('periodo','=',$per)
                    ->join('tipo_curso','cursos.id_tipo_curso','=','tipo_curso.id')
                    ->join('asignaturas','cursos.id_asignatura','=','asignaturas.id')
                    ->join('docente','cursos.id_docente','=','docente.id')
                    ->select('cursos.id as idcur','id_asignatura','asignaturas.nombre','tipo_curso.descripcion', 
                              'docente.nombre as nomdoc', 'docente.apellido as apedoc')
                    ->get();
        
           return view('calificaciones.calificaciones')->with('estumat',$estumat)->with('as',$as);
    }

    public function regnotas(Request $request){
        $n1 = $request->nota1;
        $p1 = $request->porcentaje1;
        $n2 = $request->nota2;
        $p2 = $request->porcentaje2;
        $n3 = $request->nota3;
        $p3 = $request->porcentaje3;
        $n4 = $request->nota4;
        $p4 = $request->porcentaje4;
        $final = ($n1*$p1)+($n2*$p2)+($n3*$p3)+($n4*$p4);
        $category = new Notas();
        $category->nota1= $request->input('nota1');
        $category->por1= $request->input('porcentaje1');
        $category->nota2= $request->input('nota2');
        $category->por2= $request->input('porcentaje2');
        $category->nota3= $request->input('nota3');
        $category->por3= $request->input('porcentaje3');
        $category->nota4= $request->input('nota4');
        $category->por4= $request->input('porcentaje4');
        $category->definitiva= $final;
        $category->id_curso = $request->input('idcur');
        $category->save();
        return back();
    }
    
}
