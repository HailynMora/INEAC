<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EstudianteModel\Estudiante;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Session;
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

             //validar
             $valc1 = DB::table('notas')->where('notas.id_curso', $idcur)
                        ->where('notas.definitiva', '>=', '3')
                        ->join('cursos','notas.id_curso', '=', 'cursos.id')
                        ->join('asignaturas','cursos.id_asignatura', '=', 'asignaturas.id')
                        ->join('tipo_curso','cursos.id_tipo_curso', '=', 'tipo_curso.id')
                        ->join('docente','cursos.id_docente', '=', 'docente.id')
                        ->join('estudiante','notas.id_estudiante', '=', 'estudiante.id')
                        ->join('desempenos','notas.id_desempenio', '=', 'desempenos.id')
                        ->count();
            if($valc1 != 0){
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
                Session::flash('notas', 'Lo sentimos! No se encontró información para la solicitud.');
                return back();
            }
                    
        }else{
            if($idat==2){
                //validar
                $valc2 = DB::table('notas')->where('notas.id_curso', $idcur)
                            ->where('notas.definitiva', '<', '3')
                            ->join('cursos','notas.id_curso', '=', 'cursos.id')
                            ->join('asignaturas','cursos.id_asignatura', '=', 'asignaturas.id')
                            ->join('tipo_curso','cursos.id_tipo_curso', '=', 'tipo_curso.id')
                            ->join('docente','cursos.id_docente', '=', 'docente.id')
                            ->join('estudiante','notas.id_estudiante', '=', 'estudiante.id')
                            ->join('desempenos','notas.id_desempenio', '=', 'desempenos.id')
                            ->count();
            if($valc2 != 0){
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
                Session::flash('notas', 'Lo sentimos! No se encontró información para la solicitud.');
                return back();
             }
            }else{
                $valc3 = DB::table('notas')->where('notas.id_curso', $idcur)
                            ->join('cursos','notas.id_curso', '=', 'cursos.id')
                            ->join('asignaturas','cursos.id_asignatura', '=', 'asignaturas.id')
                            ->join('tipo_curso','cursos.id_tipo_curso', '=', 'tipo_curso.id')
                            ->join('docente','cursos.id_docente', '=', 'docente.id')
                            ->join('estudiante','notas.id_estudiante', '=', 'estudiante.id')
                            ->join('desempenos','notas.id_desempenio', '=', 'desempenos.id')
                            ->count();
                //validar
                if($valc3 != 0){
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
                }else{
                    Session::flash('notas', 'Lo sentimos! No se encontró información para la solicitud.');
                    return back();
                }
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

    public function cerLaboral(Request $request)
    {   
        $dia = date('d', time()); 
        $mes = date('m', time()); 
        $anio = date('Y', time()); 
        $idl=auth()->id();
        $validar = DB::table('docente')->where('docente.num_doc', '=', $request->docu)->count();
        
        if($validar != 0){
            $docente = DB::table('docente')->where('docente.num_doc', '=', $request->docu)->first();
            $data = [
                'docente' => $docente,
                'dia' => $dia,
                'mes' => $mes,
                'anio' => $anio,
            ];     
            $pdf = PDF::loadView('docente.pdfLaboral', $data);
            return $pdf->download('certificado_laboral.pdf');
        }else{
            //Session::flash('pdf','Lo sentimos! el usuario no esta registrado.');
            $r= 0;
            return view('inicio.vista')->with('r', $r);
        }
       
    }

    //certificado de notas
    public function cerEstudiantil(Request $request)
    {   
       
        $dia = date('d', time()); 
        $mes = date('m', time()); 
        $anio = date('Y', time()); 
        //validar si existe el estudiante
        $validares = DB::table('matriculas')
                    ->where('matriculas.id_estudiante', '=', $request->ides)
                    ->where('matriculas.anio', '=', $request->anio)
                    ->where('matriculas.periodo', '=', $request->periodo)
                    ->join('estudiante','estudiante.id','=','matriculas.id_estudiante')
                    ->join('tipo_curso','matriculas.id_curso','=','tipo_curso.id')
                    ->join('tipo_documento','estudiante.id_tipo_doc','=','tipo_documento.id')
                    ->select('estudiante.id as ides','matriculas.anio','matriculas.periodo','tipo_curso.codigo','tipo_curso.descripcion','tipo_curso.jornada','tipo_curso.cursodes','estudiante.first_nom as nombre', 'estudiante.second_nom as segundonom', 'estudiante.second_ape as segundoape', 'estudiante.firts_ape as primerape', 'estudiante.num_doc', 'tipo_documento.descripcion as destipo')
                    ->count();
        //validar si existe nota
        $valasig = DB::table('notas')
                    ->join('cursos','notas.id_curso','=','cursos.id')
                    ->join('desempenos','notas.id_desempenio','=','desempenos.id')
                    ->join('asignaturas','cursos.id_asignatura','=','asignaturas.id')
                    ->join('tipo_curso', 'cursos.id_tipo_curso', '=', 'tipo_curso.id')
                    ->join('matriculas','tipo_curso.id','=','matriculas.id_curso')
                    ->where('notas.id_estudiante',$request->ides)
                    ->where('cursos.anio', '=', $request->anio)
                    ->where('cursos.periodo', '=', $request->periodo)
                    ->where('matriculas.id_aprobado', '=', '5')
                    ->select('notas.definitiva','asignaturas.nombre','desempenos.descripcion as desem','notas.id_curso', 'cursos.anio', 'cursos.periodo', 'tipo_curso.descripcion')
                    ->count();
        //###############################
        if($validares != 0 && $valasig != 0){
        $estudiante= DB::table('matriculas')
                    ->where('matriculas.id_estudiante', '=', $request->ides)
                    ->where('matriculas.anio', '=', $request->anio)
                    ->where('matriculas.periodo', '=', $request->periodo)
                    ->join('estudiante','estudiante.id','=','matriculas.id_estudiante')
                    ->join('tipo_curso','matriculas.id_curso','=','tipo_curso.id')
                    ->join('tipo_documento','estudiante.id_tipo_doc','=','tipo_documento.id')
                    ->select('estudiante.id as ides','matriculas.anio','matriculas.periodo','tipo_curso.codigo','tipo_curso.descripcion','tipo_curso.jornada','tipo_curso.cursodes','estudiante.first_nom as nombre', 'estudiante.second_nom as segundonom', 'estudiante.second_ape as segundoape', 'estudiante.firts_ape as primerape', 'estudiante.num_doc', 'tipo_documento.descripcion as destipo')
                    ->first();
        $asig = DB::table('notas')
                    ->join('cursos','notas.id_curso','=','cursos.id')
                    ->join('desempenos','notas.id_desempenio','=','desempenos.id')
                    ->join('asignaturas','cursos.id_asignatura','=','asignaturas.id')
                    ->join('tipo_curso', 'cursos.id_tipo_curso', '=', 'tipo_curso.id')
                    ->join('matriculas','tipo_curso.id','=','matriculas.id_curso')
                    ->where('notas.id_estudiante',$request->ides)
                    ->where('cursos.anio', '=', $request->anio)
                    ->where('cursos.periodo', '=', $request->periodo)
                    ->where('matriculas.id_aprobado', '=', '5')
                    ->select('notas.definitiva','asignaturas.nombre','desempenos.descripcion as desem','notas.id_curso', 'cursos.anio', 'cursos.periodo', 'tipo_curso.descripcion')
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
            'dia' => $dia,
            'mes' => $mes,
            'anio' => $anio,
        ];     
        $pdf = PDF::loadView('estudiantes.pdfEstudiantil', $data);
        return $pdf->download('certificado_estudiantil.pdf');
      }else{
        if($validares == 0){
            Session::flash('est','Lo sentimos! el estudiante no esta matriculado en el año y periodo académico seleccionado.');
        }else{
            if($valasig == 0){
            Session::flash('est','Lo sentimos! el estudiante no tiene notas vinculadas.');
            }
        }
        return back();
      }
    }
    public function pdfTec(Request $request){
        $idat = $request->idpdf;
        $idcur = $request->idcurso;
        if($idat==1){
            $val1 = DB::table('notas_tecnico')->where('notas_tecnico.id_tecnicos','=',$idcur)
                    ->where('notas_tecnico.definitiva', '>=', '3')
                    ->join('asignaturas_tecnicos','notas_tecnico.id_tecnicos', '=', 'asignaturas_tecnicos.id')
                    ->join('asig_tecnicos','asignaturas_tecnicos.id_asignaturas', '=', 'asig_tecnicos.id')
                    ->join('programa_tecnico','asignaturas_tecnicos.id_tecnico', '=', 'programa_tecnico.id')
                    ->join('docente','asignaturas_tecnicos.id_docente', '=', 'docente.id')
                    ->join('estudiante','notas_tecnico.id_estudiante', '=', 'estudiante.id')
                    ->join('desempenos','notas_tecnico.id_desempenio', '=', 'desempenos.id')
                    ->count();
             //#######################################################################
            if($val1 != 0){
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
                Session::flash('pdft','Lo sentimos! No se encontro información para la solicitud.');
                return back();
            }
        }else{
            if($idat==2){
                $val1 =DB::table('notas_tecnico')->where('notas_tecnico.id_tecnicos','=', $idcur)
                        ->where('notas_tecnico.definitiva', '<', '3')
                        ->join('asignaturas_tecnicos','notas_tecnico.id_tecnicos', '=', 'asignaturas_tecnicos.id')
                        ->join('asig_tecnicos','asignaturas_tecnicos.id_asignaturas', '=', 'asig_tecnicos.id')
                        ->join('programa_tecnico','asignaturas_tecnicos.id_tecnico', '=', 'programa_tecnico.id')
                        ->join('docente','asignaturas_tecnicos.id_docente', '=', 'docente.id')
                        ->join('estudiante','notas_tecnico.id_estudiante', '=', 'estudiante.id')
                        ->join('desempenos','notas_tecnico.id_desempenio', '=', 'desempenos.id')
                        ->count();
                //###################################################################################
                if($val1 != 0){
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
                    Session::flash('pdft','Lo sentimos! No se encontro información para la solicitud.');
                    return back();
                }
            }else{
                $val1 = DB::table('notas_tecnico')->where('notas_tecnico.id_tecnicos','=', $idcur)
                        ->join('asignaturas_tecnicos','notas_tecnico.id_tecnicos', '=', 'asignaturas_tecnicos.id')
                        ->join('asig_tecnicos','asignaturas_tecnicos.id_asignaturas', '=', 'asig_tecnicos.id')
                        ->join('programa_tecnico','asignaturas_tecnicos.id_tecnico', '=', 'programa_tecnico.id')
                        ->join('docente','asignaturas_tecnicos.id_docente', '=', 'docente.id')
                        ->join('estudiante','notas_tecnico.id_estudiante', '=', 'estudiante.id')
                        ->join('desempenos','notas_tecnico.id_desempenio', '=', 'desempenos.id')
                        ->count();
                //#####################################################################################
                if($val1 != 0){
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
                }else{
                    Session::flash('pdft','Lo sentimos! No se encontro información para la solicitud.');
                    return back();
                }
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
        
        //validar si exixte el estudiante
        $validares= DB::table('matriculas')
                    ->where('matriculas.id_estudiante', '=', $request->ides)
                    ->where('matriculas.anio', '=', $request->anio)
                    ->where('matriculas.periodo', '=', $request->periodo)
                    ->join('estudiante','estudiante.id','=','matriculas.id_estudiante')
                    ->join('tipo_curso','matriculas.id_curso','=','tipo_curso.id')
                    ->join('tipo_documento','estudiante.id_tipo_doc','=','tipo_documento.id')
                    ->join('aprobado','matriculas.id_aprobado','=','aprobado.id')
                    ->select('estudiante.id as ides','matriculas.anio','matriculas.periodo','tipo_curso.codigo','tipo_curso.descripcion','tipo_curso.jornada','tipo_curso.cursodes','estudiante.first_nom as nombre', 'estudiante.second_nom as segundonom', 'estudiante.second_ape as segundoape', 'estudiante.firts_ape as primerape', 'estudiante.num_doc', 'tipo_documento.descripcion as destipo','aprobado.nombre as apo')
                    ->count();
        //#############################################################
        if($validares != 0){

        $estudiante= DB::table('matriculas')
                    ->where('matriculas.id_estudiante', '=', $request->ides)
                    ->where('matriculas.anio', '=', $request->anio)
                    ->where('matriculas.periodo', '=', $request->periodo)
                    //->where('matriculas.id_aprobado', '=', '1')
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
    }else{
        Session::flash('est','Lo sentimos! el estudiante no esta matriculado en el año y periodo académico seleccionado.');
        return back();
    }
    }

    public function boletin_es(Request $request){

       //validar el estudiante
       $vest= DB::table('matriculas')
                    ->where('matriculas.id_estudiante', '=', $request->ides)
                    ->where('matriculas.anio', '=', $request->anio)
                    ->where('matriculas.periodo', '=', $request->periodo)
                    //->where('matriculas.id_aprobado', '=', '5')
                    ->join('estudiante','estudiante.id','=','matriculas.id_estudiante')
                    ->join('tipo_curso','matriculas.id_curso','=','tipo_curso.id')
                    ->join('tipo_documento','estudiante.id_tipo_doc','=','tipo_documento.id')
                    ->select('estudiante.id as ides','matriculas.anio','matriculas.periodo','tipo_curso.codigo',
                            'tipo_curso.descripcion','tipo_curso.jornada','tipo_curso.cursodes',
                            'estudiante.first_nom as nombre', 'estudiante.second_nom as segundonom', 
                            'estudiante.second_ape as segundoape', 'estudiante.firts_ape as primerape', 
                            'estudiante.num_doc', 'tipo_documento.descripcion as destipo')
                    ->count();
        //validar si existe notas
        $notasval = DB::table('notas')->where('notas.id_estudiante',$request->ides)
                    ->join('cursos','notas.id_curso','=','cursos.id')
                    ->join('docente', 'cursos.id_docente', '=', 'docente.id')
                    ->join('asignaturas', 'cursos.id_asignatura', '=', 'asignaturas.id')
                    ->join('desempenos','notas.id_desempenio','=','desempenos.id')
                    ->join('tipo_curso', 'cursos.id_tipo_curso', '=', 'tipo_curso.id')
                    ->join('matriculas', 'tipo_curso.id', '=', 'matriculas.id_curso')
                    ->where('cursos.anio', '=', $request->anio)
                    ->where('cursos.periodo', '=', $request->periodo)
                    //->where('matriculas.id_aprobado', '=', '5')
                    ->select('definitiva', 'desempenos.descripcion as desem', 'notas.id_curso', 'docente.nombre', 'docente.apellido', 'asignaturas.nombre as nomasig', 'asignaturas.intensidad_horaria as ih')
                    ->count();
        //##########################################
        if($vest != 0 && $notasval != 0){
        $estudiante= DB::table('matriculas')
                    ->where('matriculas.id_estudiante', '=', $request->ides)
                    ->where('matriculas.anio', '=', $request->anio)
                    ->where('matriculas.periodo', '=', $request->periodo)
                    //->where('matriculas.id_aprobado', '=', '5')
                    ->join('estudiante','estudiante.id','=','matriculas.id_estudiante')
                    ->join('tipo_curso','matriculas.id_curso','=','tipo_curso.id')
                    ->join('tipo_documento','estudiante.id_tipo_doc','=','tipo_documento.id')
                    ->select('estudiante.id as ides','matriculas.anio','matriculas.periodo','tipo_curso.codigo',
                            'tipo_curso.descripcion','tipo_curso.jornada','tipo_curso.cursodes',
                            'estudiante.first_nom as nombre', 'estudiante.second_nom as segundonom', 
                            'estudiante.second_ape as segundoape', 'estudiante.firts_ape as primerape', 
                            'estudiante.num_doc', 'tipo_documento.descripcion as destipo')
                    ->first();
       
        $notas = DB::table('notas')->where('notas.id_estudiante',$request->ides)
                    ->join('cursos','notas.id_curso','=','cursos.id')
                    ->join('docente', 'cursos.id_docente', '=', 'docente.id')
                    ->join('asignaturas', 'cursos.id_asignatura', '=', 'asignaturas.id')
                    ->join('desempenos','notas.id_desempenio','=','desempenos.id')
                    ->join('tipo_curso', 'cursos.id_tipo_curso', '=', 'tipo_curso.id')
                    ->join('matriculas', 'tipo_curso.id', '=', 'matriculas.id_curso')
                    ->where('cursos.anio', '=', $request->anio)
                    ->where('cursos.periodo', '=', $request->periodo)
                    //->where('matriculas.id_aprobado', '=', '5')
                    ->select('definitiva', 'desempenos.descripcion as desem', 'notas.id_curso', 'docente.nombre', 'docente.apellido', 'asignaturas.nombre as nomasig', 'asignaturas.intensidad_horaria as ih')
                    ->get();
        
       
       // return $notas;
        $cur = DB::table('objetivos')->select('objetivos.descripcion as desob', 'objetivos.id_asignaturas as idasig')->get();
        
        $data = [
            'estudiante' => $estudiante,
            'notas' => $notas,
            'cur' => $cur,
        ];     

        $pdf = PDF::loadView('estudiantes.pdfBoletin', $data);
        return $pdf->download('boletin_academico.pdf');
    }else{
        if($vest == 0){
            Session::flash('est','Lo sentimos! no se encontro información del estudiante en el año y periodo académico seleccionado.');
        }else{
            if($notasval == 0){
            Session::flash('est','Lo sentimos! el estudiante no tiene notas vinculadas.');
            }
        }
        return back();
    }

    }

     public function cerNota(Request $request)
    {   
        //validar si existe el estudiante
        $estuvali= DB::table('matricula_tecnico')
                    ->where('matricula_tecnico.id_estudiante', '=', $request->ides)
                    ->where('matricula_tecnico.anio', '=', $request->anio)
                    ->where('matricula_tecnico.periodo', '=', $request->periodo)
                    ->where('matricula_tecnico.id_trimestre', '=', $request->trimestre)
                    ->join('estudiante','estudiante.id','=','matricula_tecnico.id_estudiante')
                    ->join('programa_tecnico','matricula_tecnico.id_tecnico','=','programa_tecnico.id')
                    ->join('tipo_documento','estudiante.id_tipo_doc','=','tipo_documento.id')
                    ->join('trimestre_tecnicos','matricula_tecnico.id_trimestre','=','trimestre_tecnicos.id')
                    ->select('estudiante.id as ides','matricula_tecnico.anio','matricula_tecnico.periodo','programa_tecnico.codigotec','programa_tecnico.nombretec','programa_tecnico.jornada','estudiante.first_nom as nombre', 'estudiante.second_nom as segundonom', 'estudiante.second_ape as segundoape', 'estudiante.firts_ape as primerape', 'estudiante.num_doc', 'tipo_documento.descripcion as destipo','trimestre_tecnicos.nombretri')
                    ->count();
         //validar notas
         $asigv = DB::table('notas_tecnico')
                ->where('notas_tecnico.id_estudiante',$request->ides)
                ->where('asignaturas_tecnicos.anio', '=', $request->anio)
                ->where('asignaturas_tecnicos.periodo', '=', $request->periodo)
                ->join('asignaturas_tecnicos','notas_tecnico.id_tecnicos','=','asignaturas_tecnicos.id')
                ->join('desempenos','notas_tecnico.id_desempenio','=','desempenos.id')
                ->join('asig_tecnicos','asignaturas_tecnicos.id_asignaturas','=','asig_tecnicos.id')
                ->select('definitiva','asig_tecnicos.nombreasig','desempenos.descripcion as desem','id_tecnicos')
                ->count();
        //############################################
        if($estuvali != 0 && $asigv != 0){
        $estudiante= DB::table('matricula_tecnico')
                    ->where('matricula_tecnico.id_estudiante', '=', $request->ides)
                    ->where('matricula_tecnico.anio', '=', $request->anio)
                    ->where('matricula_tecnico.periodo', '=', $request->periodo)
                    ->where('matricula_tecnico.id_trimestre', '=', $request->trimestre)
                    ->join('estudiante','estudiante.id','=','matricula_tecnico.id_estudiante')
                    ->join('programa_tecnico','matricula_tecnico.id_tecnico','=','programa_tecnico.id')
                    ->join('tipo_documento','estudiante.id_tipo_doc','=','tipo_documento.id')
                    ->join('trimestre_tecnicos','matricula_tecnico.id_trimestre','=','trimestre_tecnicos.id')
                    ->select('estudiante.id as ides','matricula_tecnico.anio','matricula_tecnico.periodo','programa_tecnico.codigotec','programa_tecnico.nombretec','programa_tecnico.jornada','estudiante.first_nom as nombre', 'estudiante.second_nom as segundonom', 'estudiante.second_ape as segundoape', 'estudiante.firts_ape as primerape', 'estudiante.num_doc', 'tipo_documento.descripcion as destipo','trimestre_tecnicos.nombretri')
                    ->first();
        $asig = DB::table('notas_tecnico')
                    ->where('notas_tecnico.id_estudiante',$request->ides)
                    ->where('asignaturas_tecnicos.anio', '=', $request->anio)
                    ->where('asignaturas_tecnicos.periodo', '=', $request->periodo)
                    ->join('asignaturas_tecnicos','notas_tecnico.id_tecnicos','=','asignaturas_tecnicos.id')
                    ->join('desempenos','notas_tecnico.id_desempenio','=','desempenos.id')
                    ->join('asig_tecnicos','asignaturas_tecnicos.id_asignaturas','=','asig_tecnicos.id')
                    ->select('definitiva','asig_tecnicos.nombreasig','desempenos.descripcion as desem','id_tecnicos')
                    ->get();
        $not = DB::table('notas_tecnico')->where('notas_tecnico.id_estudiante',$request->ides)
                    ->where('notas_tecnico.definitiva','<',3)
                    ->where('asignaturas_tecnicos.anio', '=', $request->anio)
                    ->where('asignaturas_tecnicos.periodo', '=', $request->periodo)
                    ->join('asignaturas_tecnicos','notas_tecnico.id_tecnicos','=','asignaturas_tecnicos.id')
                    ->join('desempenos','notas_tecnico.id_desempenio','=','desempenos.id')
                    ->join('asig_tecnicos','asignaturas_tecnicos.id_tecnico','=','asig_tecnicos.id')
                    ->count();
        $data = [
            'estudiante' => $estudiante,
            'asig' => $asig,
            'not' => $not,
        ];     
        $pdf = PDF::loadView('tecnico.cernotas', $data);
        return $pdf->download('certificado_estudiantil.pdf');
     }else{
        if($estuvali == 0){
            Session::flash('est','Lo sentimos! no se encontró información en el año y periodo académico seleccionado.');
        }else{
           if($asigv == 0){
            Session::flash('est','Lo sentimos! el estudiante tiene notas vinculadas.');
           }
        }
        return back();
     }
    }

    public function mattecEstudiantil(Request $request)
    {   
        //fecha
        $dia = date('d', time()); 
        $mes = date('m', time()); 
        $anio = date('Y', time()); 
        
        //validar estudiante
        $estval= DB::table('matricula_tecnico')
                    ->where('matricula_tecnico.id_estudiante', '=', $request->ides)
                    ->where('matricula_tecnico.anio', '=', $request->anio)
                    ->where('matricula_tecnico.periodo', '=', $request->periodo)
                    ->join('estudiante','estudiante.id','=','matricula_tecnico.id_estudiante')
                    ->join('programa_tecnico','matricula_tecnico.id_tecnico','=','programa_tecnico.id')
                    ->join('tipo_documento','estudiante.id_tipo_doc','=','tipo_documento.id')
                    ->join('aprobado','matricula_tecnico.id_aprobado','=','aprobado.id')
                    ->join('trimestre_tecnicos','matricula_tecnico.id_trimestre','=','trimestre_tecnicos.id')
                    ->select('estudiante.id as ides','matricula_tecnico.anio','matricula_tecnico.periodo','programa_tecnico.codigotec','programa_tecnico.nombretec','programa_tecnico.jornada','estudiante.first_nom as nombre', 'estudiante.second_nom as segundonom', 'estudiante.second_ape as segundoape', 'estudiante.firts_ape as primerape', 'estudiante.num_doc', 'tipo_documento.descripcion as destipo','aprobado.nombre as apo','trimestre_tecnicos.nombretri')
                    ->count();
        //##################################
        if($estval != 0){
        $estudiante= DB::table('matricula_tecnico')
                    ->where('matricula_tecnico.id_estudiante', '=', $request->ides)
                    ->where('matricula_tecnico.anio', '=', $request->anio)
                    ->where('matricula_tecnico.periodo', '=', $request->periodo)
                    ->join('estudiante','estudiante.id','=','matricula_tecnico.id_estudiante')
                    ->join('programa_tecnico','matricula_tecnico.id_tecnico','=','programa_tecnico.id')
                    ->join('tipo_documento','estudiante.id_tipo_doc','=','tipo_documento.id')
                    ->join('aprobado','matricula_tecnico.id_aprobado','=','aprobado.id')
                    ->join('trimestre_tecnicos','matricula_tecnico.id_trimestre','=','trimestre_tecnicos.id')
                    ->select('estudiante.id as ides','matricula_tecnico.anio','matricula_tecnico.periodo','programa_tecnico.codigotec','programa_tecnico.nombretec','programa_tecnico.jornada','estudiante.first_nom as nombre', 'estudiante.second_nom as segundonom', 'estudiante.second_ape as segundoape', 'estudiante.firts_ape as primerape', 'estudiante.num_doc', 'tipo_documento.descripcion as destipo','aprobado.nombre as apo','trimestre_tecnicos.nombretri')
                    ->first();
        $data = [
            'estudiante' => $estudiante,
            'dia' => $dia,
            'mes' => $mes,
            'anio' => $anio,
        ];     
        $pdf = PDF::loadView('tecnico.cermatricula', $data);
        return $pdf->download('certificado_estudiantil_matricula.pdf');
      }else{
        Session::flash('est','Lo sentimos! el estudiante no esta matriculado en el año y periodo académico seleccionado.');
        return back();
      }
    }

    //listado pdf docentes
    public function listapdf(){
        $dia = date('d', time()); 
        $mes = date('m', time()); 
        $anio = date('Y', time()); 

        $validar = DB::table('docente')->count();
        $contar =DB::table('cursos')->count();
        if($validar != 0){
            $docente = DB::table('docente')
                    ->join('tipo_documento','docente.id_tipo_doc','=','tipo_documento.id')
                    ->join('genero','docente.id_genero','=','genero.id')
                    ->join('estado','docente.id_estado','=','estado.id')
                    ->select('docente.id as id', 'docente.nombre', 'apellido', 'num_doc', 'fec_vinculacion',
                            'correo', 'telefono', 'direccion', 'genero.descripcion as genero', 'tipo_documento.descripcion',
                            'estado.descripcion as estado')
                    
                    ->orderBy('apellido')
                    ->get();
                   
            for($i=0; $i<count($docente); ++$i){
                    $condoc[$i]= DB::table('cursos')->join('asignaturas','cursos.id_asignatura','=','asignaturas.id')
                                ->join('tipo_curso', 'cursos.id_tipo_curso', '=', 'tipo_curso.id')
                                ->where('cursos.id_docente', '=', $docente[$i]->id)
                                ->select('asignaturas.nombre as asig', 'tipo_curso.descripcion as cur', 'id_docente', 'asignaturas.intensidad_horaria as horas', 'asignaturas.codigo as cod')
                                ->distinct()
                                ->get();
            }
            $data = [
                'docente' => $docente,
                'dia' => $dia,
                'mes' => $mes,
                'anio' => $anio,
                'condoc' => $condoc,
            ];     
            $pdf = PDF::loadView('docente.pdfListado', $data);
            return $pdf->download('lista_Docentes.pdf');
        }else{
            Session::flash('pdf','Lo sentimos! no hay docentes registrados.');
            return back();
        }
    }
}
