<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EstudianteModel\Estudiante;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use PDF;
use DB;

class PDFController extends Controller
{
    public function vista(){
        return view('docente.pdfLaboral');
    }
    ///////////////////////////////
    public function generatePDF(Request $request)
    {    $idat = $request->idpdf;
         $idcur = $request->idcurso;
        if($idat==1){
            $consulta = DB::table('notas')->where('notas.id_curso', $idcur)
            ->where('notas.definitiva', '>=', '3')
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
        }else{
            if($idat==2){
                $consulta = DB::table('notas')->where('notas.id_curso', $idcur)
                ->where('notas.definitiva', '<', '3')
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
            }else{
                $consulta = DB::table('notas')->where('notas.id_curso', $idcur)
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
            }

        }
       
        $info = DB::table('notas')->where('notas.id_curso', $idcur)
        ->join('cursos','notas.id_curso', '=', 'cursos.id')
        ->join('asignaturas','cursos.id_asignatura', '=', 'asignaturas.id')
        ->join('tipo_curso','cursos.id_tipo_curso', '=', 'tipo_curso.id')
        ->join('docente','cursos.id_docente', '=', 'docente.id')
        ->join('desempenos','notas.id_desempenio', '=', 'desempenos.id')
        ->select('asignaturas.nombre as asignatura', 'tipo_curso.descripcion as curso', 
                'docente.nombre as nomdoc', 'docente.apellido as apedoc', 'cursos.anio', 
                'cursos.periodo')
        ->first();

        $obj = DB::table('objetivos')->where('id_asignaturas', $idcur)->select('objetivos.descripcion as objetivo')->get();

        $data = [
            'obj' => $obj,
            'info' => $info,
            'consulta' => $consulta,
        ]; 
            
        $pdf = PDF::loadView('myPDF', $data);
     
        return $pdf->download('notas_inesur.pdf');
    }
    //generar constancia

    public function cerLaboral()
    {   
        $idl=auth()->id();
        $docente = DB::table('docente')->where('docente.id_usuario', '=', $idl)->first();
        $data = [
            'docente' => $docente,
        ];     
        $pdf = PDF::loadView('docente.pdfLaboral', $data);
        return $pdf->download('certificado_laboral.pdf');
    }
    public function cerEstudiantil(Request $request)
    {   
        $estudiante= DB::table('matriculas')
                    ->where('matriculas.id_estudiante', '=', $request->ides)
                    ->where('matriculas.anio', '=', $request->anio)
                    ->where('matriculas.periodo', '=', $request->periodo)
                    ->join('estudiante','estudiante.id','=','matriculas.id_estudiante')
                    ->join('tipo_curso','matriculas.id_curso','=','tipo_curso.id')
                    ->join('tipo_documento','estudiante.id_tipo_doc','=','tipo_documento.id')
                    ->select('estudiante.id as ides','matriculas.anio','matriculas.periodo','tipo_curso.codigo','tipo_curso.descripcion','tipo_curso.jornada','tipo_curso.cursodes','estudiante.first_nom as nombre', 'estudiante.second_nom as segundonom', 'estudiante.second_ape as segundoape', 'estudiante.firts_ape as primerape', 'estudiante.num_doc', 'tipo_documento.descripcion as destipo')
                    ->first();
        $asig = DB::table('notas')->where('notas.id_estudiante',$request->ides)
                    ->where('cursos.anio', '=', $request->anio)
                    ->where('cursos.periodo', '=', $request->periodo)
                    ->join('cursos','notas.id_curso','=','cursos.id')
                    ->join('desempenos','notas.id_desempenio','=','desempenos.id')
                    ->join('asignaturas','cursos.id_asignatura','=','asignaturas.id')
                    ->select('definitiva','asignaturas.nombre','desempenos.descripcion as desem','id_curso')
                    ->get();
        $not = DB::table('notas')->where('notas.id_estudiante',$request->ides)
                    ->where('notas.definitiva','<',3)
                    ->where('cursos.anio', '=', $request->anio)
                    ->where('cursos.periodo', '=', $request->periodo)
                    ->join('cursos','notas.id_curso','=','cursos.id')
                    ->join('desempenos','notas.id_desempenio','=','desempenos.id')
                    ->join('asignaturas','cursos.id_asignatura','=','asignaturas.id')
                    ->count();
        $data = [
            'estudiante' => $estudiante,
            'asig' => $asig,
            'not' => $not,
        ];     
        $pdf = PDF::loadView('estudiantes.pdfEstudiantil', $data);
        return $pdf->download('certificado_estudiantil.pdf');
    }
    public function pdfTec(Request $request){
        $idat = $request->idpdf;
        $idcur = $request->idcurso;
        if($idat==1){
            $consulta = DB::table('notas_tecnico')->where('notas_tecnico.id_tecnicos','=',$idcur)
                       ->where('notas_tecnico.definitiva', '>=', '3')
                        ->join('asignaturas_tecnicos','notas_tecnico.id_tecnicos', '=', 'asignaturas_tecnicos.id')
                        ->join('asig_tecnicos','asignaturas_tecnicos.id_asignaturas', '=', 'asig_tecnicos.id')
                        ->join('programa_tecnico','asignaturas_tecnicos.id_tecnico', '=', 'programa_tecnico.id')
                        ->join('docente','asignaturas_tecnicos.id_docente', '=', 'docente.id')
                        ->join('estudiante','notas_tecnico.id_estudiante', '=', 'estudiante.id')
                        ->join('desempenos','notas_tecnico.id_desempenio', '=', 'desempenos.id')
                        ->select('estudiante.first_nom as nomes', 'estudiante.second_nom as segnom', 
                                'estudiante.firts_ape as apes', 'estudiante.second_ape as sedape', 
                                'asig_tecnicos.nombreasig as asignatura', 'programa_tecnico.nombretec as curso', 
                                'docente.nombre as nomdoc', 'docente.apellido as apedoc', 'asignaturas_tecnicos.anio', 
                                'asignaturas_tecnicos.periodo', 'notas_tecnico.id as idnota', 'notas_tecnico.nota1', 'notas_tecnico.nota2', 'notas_tecnico.nota3', 'notas_tecnico.nota4', 'notas_tecnico.definitiva',
                                'notas_tecnico.por1', 'notas_tecnico.id_tecnicos as idcur', 'notas_tecnico.por2', 'notas_tecnico.por3', 'notas_tecnico.por4', 'desempenos.descripcion as desem')
                        ->get();
        }else{
            if($idat==2){
                $consulta = DB::table('notas_tecnico')->where('notas_tecnico.id_tecnicos','=', $idcur)
                            ->where('notas_tecnico.definitiva', '<', '3')
                            ->join('asignaturas_tecnicos','notas_tecnico.id_tecnicos', '=', 'asignaturas_tecnicos.id')
                            ->join('asig_tecnicos','asignaturas_tecnicos.id_asignaturas', '=', 'asig_tecnicos.id')
                            ->join('programa_tecnico','asignaturas_tecnicos.id_tecnico', '=', 'programa_tecnico.id')
                            ->join('docente','asignaturas_tecnicos.id_docente', '=', 'docente.id')
                            ->join('estudiante','notas_tecnico.id_estudiante', '=', 'estudiante.id')
                            ->join('desempenos','notas_tecnico.id_desempenio', '=', 'desempenos.id')
                            ->select('estudiante.first_nom as nomes', 'estudiante.second_nom as segnom', 
                                    'estudiante.firts_ape as apes', 'estudiante.second_ape as sedape', 
                                    'asig_tecnicos.nombreasig as asignatura', 'programa_tecnico.nombretec as curso', 
                                    'docente.nombre as nomdoc', 'docente.apellido as apedoc', 'asignaturas_tecnicos.anio', 
                                    'asignaturas_tecnicos.periodo', 'notas_tecnico.id as idnota', 'notas_tecnico.nota1', 'notas_tecnico.nota2', 'notas_tecnico.nota3', 'notas_tecnico.nota4', 'notas_tecnico.definitiva',
                                    'notas_tecnico.por1', 'notas_tecnico.id_tecnicos as idcur', 'notas_tecnico.por2', 'notas_tecnico.por3', 'notas_tecnico.por4', 'desempenos.descripcion as desem')
                            ->get();
            }else{
                $consulta = DB::table('notas_tecnico')->where('notas_tecnico.id_tecnicos','=', $idcur)
                            ->join('asignaturas_tecnicos','notas_tecnico.id_tecnicos', '=', 'asignaturas_tecnicos.id')
                            ->join('asig_tecnicos','asignaturas_tecnicos.id_asignaturas', '=', 'asig_tecnicos.id')
                            ->join('programa_tecnico','asignaturas_tecnicos.id_tecnico', '=', 'programa_tecnico.id')
                            ->join('docente','asignaturas_tecnicos.id_docente', '=', 'docente.id')
                            ->join('estudiante','notas_tecnico.id_estudiante', '=', 'estudiante.id')
                            ->join('desempenos','notas_tecnico.id_desempenio', '=', 'desempenos.id')
                            ->select('estudiante.first_nom as nomes', 'estudiante.second_nom as segnom', 
                                    'estudiante.firts_ape as apes', 'estudiante.second_ape as sedape', 
                                    'asig_tecnicos.nombreasig as asignatura', 'programa_tecnico.nombretec as curso', 
                                    'docente.nombre as nomdoc', 'docente.apellido as apedoc', 'asignaturas_tecnicos.anio', 
                                    'asignaturas_tecnicos.periodo', 'notas_tecnico.id as idnota', 'notas_tecnico.nota1', 'notas_tecnico.nota2', 'notas_tecnico.nota3', 'notas_tecnico.nota4', 'notas_tecnico.definitiva',
                                    'notas_tecnico.por1', 'notas_tecnico.id_tecnicos as idcur', 'notas_tecnico.por2', 'notas_tecnico.por3', 'notas_tecnico.por4', 'desempenos.descripcion as desem')
                            ->get();
                }

            }
       
            $info = DB::table('notas_tecnico')->where('notas_tecnico.id_tecnicos','=', $idcur)
                    ->join('asignaturas_tecnicos','notas_tecnico.id_tecnicos', '=', 'asignaturas_tecnicos.id')
                    ->join('asig_tecnicos','asignaturas_tecnicos.id_asignaturas', '=', 'asig_tecnicos.id')
                    ->join('programa_tecnico','asignaturas_tecnicos.id_tecnico', '=', 'programa_tecnico.id')
                    ->join('docente','asignaturas_tecnicos.id_docente', '=', 'docente.id')
                    ->join('estudiante','notas_tecnico.id_estudiante', '=', 'estudiante.id')
                    ->join('desempenos','notas_tecnico.id_desempenio', '=', 'desempenos.id')
                    ->select('asig_tecnicos.nombreasig as asignatura', 'programa_tecnico.nombretec as curso', 
                            'docente.nombre as nomdoc', 'docente.apellido as apedoc', 'asignaturas_tecnicos.anio', 
                            'asignaturas_tecnicos.periodo')
                   ->first();

            $obj = DB::table('objetivostec')->where('id_asignaturas', $idcur)->select('objetivostec.descripcion as objetivo')->get();

            $data = [
                'obj' => $obj,
                'info' => $info,
                'consulta' => $consulta,
            ]; 
                
            $pdf = PDF::loadView('calificaciones.pdfnotastec', $data);
        
            return $pdf->download('notas_inesur_tecnicos.pdf');

    }

    public function cervista(){
        return view('estudiantes.pdfEstudiantil'); 

    }
    
    //aqui modificar 
    public function matEstudiantil(Request $request)
    {   
        //fecha
        $dia = date('d', time()); 
        $mes = date('m', time()); 
        $anio = date('Y', time()); 
        
        //
        $estudiante= DB::table('matriculas')
                    ->where('matriculas.id_estudiante', '=', $request->ides)
                    ->where('matriculas.anio', '=', $request->anio)
                    ->where('matriculas.periodo', '=', $request->periodo)
                    ->join('estudiante','estudiante.id','=','matriculas.id_estudiante')
                    ->join('tipo_curso','matriculas.id_curso','=','tipo_curso.id')
                    ->join('tipo_documento','estudiante.id_tipo_doc','=','tipo_documento.id')
                    ->join('aprobado','matriculas.id_aprobado','=','aprobado.id')
                    ->select('estudiante.id as ides','matriculas.anio','matriculas.periodo','tipo_curso.codigo','tipo_curso.descripcion','tipo_curso.jornada','tipo_curso.cursodes','estudiante.first_nom as nombre', 'estudiante.second_nom as segundonom', 'estudiante.second_ape as segundoape', 'estudiante.firts_ape as primerape', 'estudiante.num_doc', 'tipo_documento.descripcion as destipo','aprobado.nombre as apo')
                    ->first();
        $data = [
            'estudiante' => $estudiante,
            'dia' => $dia,
            'mes' => $mes,
            'anio' => $anio,
        ];     
        $pdf = PDF::loadView('estudiantes.cermatricula', $data);
        return $pdf->download('certificado_estudiantil_matricula.pdf');
    }

    public function boletin_es(Request $request){
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
        $data = [
            'estudiante' => $estudiante,
            'notas' => $notas,
            'cur' => $cur,
        ];     
        $pdf = PDF::loadView('estudiantes.pdfBoletin', $data);
        return $pdf->download('boletin_academico.pdf');
    }
}
