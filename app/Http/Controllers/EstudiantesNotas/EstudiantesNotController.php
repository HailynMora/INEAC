<?php

namespace App\Http\Controllers\EstudiantesNotas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class EstudiantesNotController extends Controller
{
    public function vista(Request $request){
        $idlog=auth()->id();
        $idestu = DB::table('estudiante')->where('id_usuario', $idlog)->select('estudiante.id as ides')->first();
       
        $datos = DB::table('notas')->join('cursos', 'notas.id_curso', '=', 'cursos.id')
                     ->join('estudiante', 'notas.id_estudiante', '=', 'estudiante.id')
                     ->join('asignaturas', 'cursos.id_asignatura', '=', 'asignaturas.id')
                     ->join('tipo_curso', 'cursos.id_tipo_curso', '=', 'tipo_curso.id')
                     ->join('docente', 'cursos.id_docente', '=', 'docente.id')
                     ->select('notas.id as idnota', 'notas.nota1', 'notas.nota2', 'notas.nota3', 'notas.nota4', 'notas.por1', 'notas.por2', 'notas.por3', 'notas.por4', 'notas.definitiva', 
                              'asignaturas.nombre as asignatura', 'tipo_curso.descripcion as curso', 'tipo_curso.cursodes as descur', 'docente.nombre as nomdoc', 'docente.apellido as apedoc',
                              'docente.num_doc as numdoc', 'estudiante.first_nom as primernom', 'estudiante.second_nom as segnom', 'estudiante.firts_ape as primerape', 'estudiante.second_ape as segape')
                     ->where('notas.id_estudiante', $idestu->ides)
                     ->where('cursos.anio', $request->anio)
                     ->where('cursos.periodo', $request->periodo)->get();
                     
        return view('estudiantes.notas')->with('datos', $datos);
    }
}
