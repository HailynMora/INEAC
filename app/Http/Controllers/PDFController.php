<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EstudianteModel\Estudiante;
use PDF;
use DB;

class PDFController extends Controller
{
    public function vista($id){

        return view('myPDF');
    }
    ///////////////////////////////
    public function generatePDF($id)
    {
        $consulta = DB::table('notas')->where('notas.id_curso', $id)
        ->join('cursos','notas.id_curso', '=', 'cursos.id')
        ->join('asignaturas','cursos.id_asignatura', '=', 'asignaturas.id')
        ->join('tipo_curso','cursos.id_tipo_curso', '=', 'tipo_curso.id')
        ->join('docente','cursos.id_docente', '=', 'docente.id')
        ->join('estudiante','notas.id_estudiante', '=', 'estudiante.id')
        ->join('desempenos','notas.id_desempenio', '=', 'desempenos.id')
        ->select('estudiante.first_nom as nomes', 'estudiante.second_nom as segnom', 
                'estudiante.firts_ape as apes', 'estudiante.second_ape as sedape', 
                'asignaturas.nombre as asignatura', 'tipo_curso.descripcion as curso', 
                'docente.nombre as nomdoc', 'docente.apellido as apedoc', 'cursos.anio', 
                'cursos.periodo', 'notas.id as idnota', 'notas.nota1', 'notas.nota2', 'notas.nota3', 'notas.nota4', 'notas.definitiva',
                'notas.por1', 'notas.por2', 'notas.por3', 'notas.por4', 'desempenos.descripcion as desem')
        ->get();

        $info = DB::table('notas')->where('notas.id_curso', $id)
        ->join('cursos','notas.id_curso', '=', 'cursos.id')
        ->join('asignaturas','cursos.id_asignatura', '=', 'asignaturas.id')
        ->join('tipo_curso','cursos.id_tipo_curso', '=', 'tipo_curso.id')
        ->join('docente','cursos.id_docente', '=', 'docente.id')
        ->join('desempenos','notas.id_desempenio', '=', 'desempenos.id')
        ->select('asignaturas.nombre as asignatura', 'tipo_curso.descripcion as curso', 
                'docente.nombre as nomdoc', 'docente.apellido as apedoc', 'cursos.anio', 
                'cursos.periodo')
        ->first();

        $obj = DB::table('objetivos')->where('id_asignaturas', $id)->select('objetivos.descripcion as objetivo')->get();

        $data = [
            'obj' => $obj,
            'info' => $info,
            'consulta' => $consulta,
        ]; 
            
        $pdf = PDF::loadView('myPDF', $data);
     
        return $pdf->download('notas_inesur.pdf');
    }
}
