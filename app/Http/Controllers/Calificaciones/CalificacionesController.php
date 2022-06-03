<?php

namespace App\Http\Controllers\Calificaciones;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
                    ->select('id_asignatura','asignaturas.nombre','tipo_curso.descripcion', 
                              'docente.nombre as nomdoc', 'docente.apellido as apedoc')
                    ->get();
        
           return view('calificaciones.calificaciones')->with('estumat',$estumat)->with('as',$as);
    }
    
}
