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
}
