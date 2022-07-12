<?php

namespace App\Http\Controllers\Calificaciones;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Carbon\Carbon;

class HabilitacionesController extends Controller
{
    public function vista(){
        $idlog=auth()->id();
        $idocente = DB::table('docente')->where('docente.id_usuario', '=', $idlog)->select('docente.id as idoc')->first();
        $con = DB::table('cursos')->where('id_docente', '=', $idocente->idoc)
              ->join('asignaturas', 'cursos.id_asignatura', '=', 'asignaturas.id')
              ->join('tipo_curso', 'cursos.id_tipo_curso', '=', 'tipo_curso.id')
              ->select('asignaturas.nombre', 'asignaturas.val_habilitacion', 'tipo_curso.descripcion')
              ->distinct()
              ->get();
        return view('docente.listaHabil')->with('con', $con);
    }

    public function laboral(){
        $idl=auth()->id();
        $idc = DB::table('docente')->where('docente.id_usuario', '=', $idl)->first();
        return view('docente.certificado')->with('idc', $idc);
    }
    public function estudiantil($id){
        $idc = DB::table('estudiante')->where('estudiante.id', '=', $id)
                    ->join('matriculas','estudiante.id','=','matriculas.id_estudiante')
                    ->join('tipo_curso','matriculas.id_curso','=','tipo_curso.id')
                    ->join('tipo_documento','estudiante.id_tipo_doc','=','tipo_documento.id')
                    ->select('estudiante.id as ides','matriculas.anio','matriculas.periodo','tipo_curso.codigo','tipo_curso.descripcion','tipo_curso.jornada','tipo_curso.cursodes','estudiante.first_nom as nombre', 'estudiante.second_nom as segundonom', 'estudiante.second_ape as segundoape', 'estudiante.firts_ape as primerape', 'estudiante.num_doc', 'tipo_documento.descripcion as destipo')
                    ->first();
        $asig = DB::table('notas')->where('notas.id_estudiante',$id)
                    ->join('cursos','notas.id_curso','=','cursos.id')
                    ->join('desempenos','notas.id_desempenio','=','desempenos.id')
                    ->join('asignaturas','cursos.id_asignatura','=','asignaturas.id')
                    ->select('definitiva','asignaturas.nombre','desempenos.descripcion as desem')
                    ->get();
        $ide = $id;
        return view('estudiantes.certificadoes')->with('idc', $idc)->with('asig', $asig)->with('ide', $ide);
    }

    public function estudiantiltec($id){
        $ides=$id;
        return view('tecnico.certificados')->with('ides',$ides);
    }
}
