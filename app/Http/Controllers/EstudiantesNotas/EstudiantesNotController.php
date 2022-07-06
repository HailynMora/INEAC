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
    public function certificados(Request $request){
        $idc = DB::table('matriculas')
                    ->where('matriculas.id_estudiante', '=', $ide)
                    ->where('matriculas.anio', '=', $request->anio)
                    ->where('matriculas.periodo', '=', $request->periodo)
                    ->join('estudiante','estudiante.id','=','matriculas.id_estudiante')
                    ->join('tipo_curso','matriculas.id_curso','=','tipo_curso.id')
                    ->join('tipo_documento','estudiante.id_tipo_doc','=','tipo_documento.id')
                    ->select('estudiante.id as ides','matriculas.anio','matriculas.periodo','tipo_curso.codigo','tipo_curso.descripcion','tipo_curso.jornada','tipo_curso.cursodes','estudiante.first_nom as nombre', 'estudiante.second_nom as segundonom', 'estudiante.second_ape as segundoape', 'estudiante.firts_ape as primerape', 'estudiante.num_doc', 'tipo_documento.descripcion as destipo')
                    ->first();
        $asig = DB::table('notas')->where('notas.id_estudiante',$idd)
                    ->where('cursos.anio', '=', $request->anio)
                    ->where('cursos.periodo', '=', $request->periodo)
                    ->join('cursos','notas.id_curso','=','cursos.id')
                    ->join('desempenos','notas.id_desempenio','=','desempenos.id')
                    ->join('asignaturas','cursos.id_asignatura','=','asignaturas.id')
                    ->select('definitiva','asignaturas.nombre','desempenos.descripcion as desem')
                    ->get();
        return view('estudiantes.certificados')->with('idc', $idc)->with('asig', $asig);
    }
    public function certificadom(Request $request){
        
        $idc = DB::table('matriculas')
                    ->where('matriculas.id_estudiante', '=', $ide)
                    ->where('matriculas.anio', '=', $request->anio)
                    ->where('matriculas.periodo', '=', $request->periodo)
                    ->where('matriculas.id_aprobado', '=', 1)
                    ->join('estudiante','estudiante.id','=','matriculas.id_estudiante')
                    ->join('tipo_curso','matriculas.id_curso','=','tipo_curso.id')
                    ->join('tipo_documento','estudiante.id_tipo_doc','=','tipo_documento.id')
                    ->select('estudiante.id as ides','matriculas.anio','matriculas.periodo','tipo_curso.codigo','tipo_curso.descripcion','tipo_curso.jornada','tipo_curso.cursodes','estudiante.first_nom as nombre', 'estudiante.second_nom as segundonom', 'estudiante.second_ape as segundoape', 'estudiante.firts_ape as primerape', 'estudiante.num_doc', 'tipo_documento.descripcion as destipo')
                    ->first();
        
        return view('estudiantes.cermatricula')->with('idc', $idc);
    }
    public function boletin(Request $request){
        $estudiante= DB::table('matriculas')
                    ->where('matriculas.id_estudiante', '=', $request->ides)
                    ->where('matriculas.anio', '=', $request->anio)
                    ->where('matriculas.periodo', '=', $request->periodo)
                    ->join('estudiante','estudiante.id','=','matriculas.id_estudiante')
                    ->join('tipo_curso','matriculas.id_curso','=','tipo_curso.id')
                    ->join('tipo_documento','estudiante.id_tipo_doc','=','tipo_documento.id')
                    ->select('estudiante.id as ides','matriculas.anio','matriculas.periodo','tipo_curso.codigo','tipo_curso.descripcion','tipo_curso.jornada','tipo_curso.cursodes','estudiante.first_nom as nombre', 'estudiante.second_nom as segundonom', 'estudiante.second_ape as segundoape', 'estudiante.firts_ape as primerape', 'estudiante.num_doc', 'tipo_documento.descripcion as destipo')
                    ->first();
        $notas = DB::table('notas')->where('notas.id_estudiante',$request->ides)
                    ->where('cursos.anio', '=', $request->anio)
                    ->where('cursos.periodo', '=', $request->periodo)
                    ->join('cursos','notas.id_curso','=','cursos.id')
                    ->join('desempenos','notas.id_desempenio','=','desempenos.id')
                    ->select('definitiva','desempenos.descripcion as desem','id_curso')
                    ->get();
        $cur = DB::table('cursos')->join('asignaturas','cursos.id_asignatura','=','asignaturas.id')->get();
        $obj = DB::table('objetivos')->get();
                return view('estudiantes.boletin')->with('estudiante',$estudiante)->with('notas',$notas)->with('cur',$cur)->with('obj',$obj);
    }
}
