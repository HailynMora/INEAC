<?php

namespace App\Http\Controllers\Resportes;

use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Exports\EstudiantesBachiExport;
use App\Exports\TecniosExcel;
use App\Models\MatriculasModel\Matricula;
use App\Exports\NotasBachiExcel;
use App\Exports\NotasTecnicoExcel;
use App\Exports\NotasCurso;
use App\Exports\NotasTec;
use App\Models\MatriculasModel\MatriculaTec;
use App\Models\CalificacionesModel\Notas;
use App\Models\CalificacionesModel\NotasTecnico;
use App\Models\Niveltec; //se agrego
//#####################3
use App\Models\SaludModel\SistemaSalud; //se agrego para borrar
use App\Models\ParentescoModel\Acudiente; //se agrego para borrar
use App\Models\Nivelacion;
use App\Models\ObjetivosModel\ObjetivosTec;
use App\Models\ObjetivosModel\Objetivos;
use App\Models\EstudianteModel\Estudiante;
use App\Models\AsignaturaModel\AsigProgram;
use App\Models\AsignaturaModel\AsigTecnicos;
use App\Models\DocenteModel\Docente;
use App\Models\AsignaturaModel\Asignatura;
use App\Models\AsignaturaModel\AsignaturaTecnicos;
use App\Models\Archivos\Cargarchivo;
use App\Models\PerfilModel\Perfil;
use App\Models\AsignaturaModel\ProgramasTecnicos;
use App\Models\Archivo;
use App\Models\AsignaturaModel\Programas;
use App\Models\User;
//###################### 
use PDF;
use Session;
use DB;


class ReportesController extends Controller
{
    public function reporte_bachillerato($id){
        
       // 
    }
    public function reporte_matriculados(){
        $mat = DB::table('matriculas')
                 ->join('tipo_curso', 'matriculas.id_curso', '=', 'tipo_curso.id')
                 ->select('matriculas.id_curso as idcur', 'tipo_curso.codigo', 'tipo_curso.descripcion as nomcurso')->distinct()->get();
       
        $matec = DB::table('matricula_tecnico')
                    ->join('programa_tecnico', 'matricula_tecnico.id_tecnico', '=', 'programa_tecnico.id')
                    ->select('matricula_tecnico.id_tecnico as idtec','programa_tecnico.codigotec','programa_tecnico.nombretec')
                    ->distinct()
                    ->get();
        $res =DB::table('matriculas')->select('matriculas.anio')->distinct()->get();
        $resanio =DB::table('matricula_tecnico')->select('matricula_tecnico.anio')->distinct()->get();
        //consultar el trimestre
        $trimestre =DB::table('trimestre_tecnicos')->select('trimestre_tecnicos.id', 'trimestre_tecnicos.nombretri as nombre')->get();

        //reporte de asignaturas bachi
        $asig = DB::table('asignaturas')
                ->join('cursos','asignaturas.id','=','cursos.id_asignatura')
                ->join('tipo_curso','cursos.id_tipo_curso','tipo_curso.id')
        ->select('asignaturas.id as idasig', 'asignaturas.nombre','cursos.id_tipo_curso as idcurso')->get();
        $asigtec = DB::table('asig_tecnicos')
                ->join('asignaturas_tecnicos','asig_tecnicos.id','=','asignaturas_tecnicos.id_asignaturas')
                ->join('programa_tecnico','asignaturas_tecnicos.id_tecnico','programa_tecnico.id')
                ->select('asig_tecnicos.id as ida', 'asig_tecnicos.nombreasig','asignaturas_tecnicos.id_tecnico as idte')->get();
    
        return view('matriculas.reporte')->with('mat', $mat)->with('matec', $matec)->with('res', $res)->with('resanio', $resanio)->with('trimestre', $trimestre)->with('asig', $asig)->with('asigtec', $asigtec);
    }
    
    public function filtrar(Request $request){
           $id = $request->idc;
           $per =  $request->periodo;
           $anio =  $request->anio;
           //validar
           $val = DB::table('matriculas')->where('matriculas.id_curso', $id)
                    ->where('matriculas.anio', $anio)
                    ->where('matriculas.periodo', $per)
                    ->join('estudiante', 'matriculas.id_estudiante', '=', 'estudiante.id')
                    ->join('tipo_curso', 'matriculas.id_curso', '=', 'tipo_curso.id')
                    ->join('aprobado', 'matriculas.id_aprobado', '=', 'aprobado.id')
                    ->select('estudiante.first_nom', 'estudiante.second_nom', 'estudiante.firts_ape',
                    'estudiante.second_ape', 'estudiante.num_doc', 'estudiante.telefono', 'tipo_curso.codigo', 'tipo_curso.descripcion',
                    'matriculas.anio', 'matriculas.periodo', 'matriculas.fec_matricula', 'aprobado.nombre')
                    ->count();
            if($val != 0){
                return Excel::download(new EstudiantesBachiExport($id, $anio, $per), 'listado.xlsx');
            }else{
                Session::flash('excel', 'Lo sentimos! No se encontró información para la solicitud.');
                return back();
            }
                    //end validar
    }

    public function notasSec(Request $request){
        $idcur = $request->idcur;
        $per =  $request->pernot;
        $anio =  $request->anionot;
        $asig =  $request->asig;
        //validar
        $valn = Notas::join('cursos','notas.id_curso', '=', 'cursos.id')
                    ->join('asignaturas','cursos.id_asignatura', '=', 'asignaturas.id')
                    ->join('tipo_curso','cursos.id_tipo_curso', '=', 'tipo_curso.id')
                    ->join('docente','cursos.id_docente', '=', 'docente.id')
                    ->join('estudiante','notas.id_estudiante', '=', 'estudiante.id')
                    ->join('desempenos','notas.id_desempenio', '=', 'desempenos.id')
                    ->where('cursos.id_tipo_curso', '=', $idcur)
                    ->where('cursos.anio', '=', $anio)
                    ->where('cursos.id_asignatura', '=', $asig)
                    ->count();
         if($valn != 0){
            return Excel::download(new NotasCurso($idcur, $anio, $per, $asig), 'listado_notas.xlsx');
         }else{
            Session::flash('excel', 'Lo sentimos! No se encontró información para la solicitud.');
            return back();
         }
         
   }
   public function notasTec(Request $request){
        $idtec = $request->idtec;
        $per =  $request->pernot;
        $anio =  $request->anionot;
        $asig =  $request->asig;
        //validar
        $valnt = NotasTecnico::join('asignaturas_tecnicos','notas_tecnico.id_tecnicos', '=', 'asignaturas_tecnicos.id')
                ->join('asig_tecnicos','asignaturas_tecnicos.id_asignaturas', '=', 'asig_tecnicos.id')
                ->join('programa_tecnico','asignaturas_tecnicos.id_tecnico', '=', 'programa_tecnico.id')
                ->join('trimestre_tecnicos','asignaturas_tecnicos.id_trimestre','=','trimestre_tecnicos.id')
                ->join('docente','asignaturas_tecnicos.id_docente', '=', 'docente.id')
                ->join('estudiante','notas_tecnico.id_estudiante', '=', 'estudiante.id')
                ->join('desempenos','notas_tecnico.id_desempenio', '=', 'desempenos.id')
                ->where('asignaturas_tecnicos.id_tecnico', '=', $idtec)
                ->where('asignaturas_tecnicos.anio', '=', $anio)
                ->where('asignaturas_tecnicos.id_asignaturas', '=', $asig)
                ->count();
        if($valnt != 0){
            return Excel::download(new NotasTec($idtec, $anio, $per, $asig), 'listado_notas.xlsx');
        }else{
            Session::flash('excel', 'Lo sentimos! No se encontró información para la solicitud.');
            return back();
        }
        
   }

    public function filtrartec(Request $request){
        $idtec = $request->idtecni;
        $pertec = $request->periodo;
        $aniotec =$request->anio; 
        $trim = $request->tri;
        //validar
         $valt =  MatriculaTec::query()
                ->where('id_tecnico', $idtec)
                ->where('anio', $aniotec)
                ->where('periodo', $pertec)
                ->where('id_trimestre', $trim)
                ->join('estudiante', 'id_estudiante', '=', 'estudiante.id')
                ->join('programa_tecnico', 'id_tecnico', '=', 'programa_tecnico.id')
                ->join('aprobado', 'id_aprobado', '=', 'aprobado.id')
                ->join('trimestre_tecnicos', 'id_trimestre', '=', 'trimestre_tecnicos.id')
                ->select('estudiante.first_nom', 'estudiante.second_nom', 'estudiante.firts_ape',
                'estudiante.second_ape', 'estudiante.num_doc', 'estudiante.telefono', 'programa_tecnico.codigotec', 'programa_tecnico.nombretec',
                'anio', 'periodo', 'fec_matricula', 'trimestre_tecnicos.nombretri', 'aprobado.nombre')
                ->count();
        if($valt != 0){
            return Excel::download(new TecniosExcel($idtec, $aniotec, $pertec, $trim), 'listado_tecnicos.xlsx');
        }else{
            Session::flash('excel', 'Lo sentimos! No se encontró información para la solicitud.');
            return back();
        }
        

    }

//////////////////////////////////////////////////////
    public function excelNotas(Request $request){
         $id = $request->idcurso;
         $idnota = $request->idexcel;
         //validar
         if($idnota == 1){
            $res = Notas::where('notas.id_curso',  $id)->where('notas.definitiva', '>=', '3')
                    ->join('cursos','notas.id_curso', '=', 'cursos.id')
                    ->join('asignaturas','cursos.id_asignatura', '=', 'asignaturas.id')
                    ->join('tipo_curso','cursos.id_tipo_curso', '=', 'tipo_curso.id')
                    ->join('docente','cursos.id_docente', '=', 'docente.id')
                    ->join('estudiante','notas.id_estudiante', '=', 'estudiante.id')
                    ->join('desempenos','notas.id_desempenio', '=', 'desempenos.id')
                    ->count();
        }else{
            if($idnota == 2){
                $res = Notas::where('notas.id_curso',  $id)->where('notas.definitiva', '<', '3')
                ->join('cursos','notas.id_curso', '=', 'cursos.id')
                ->join('asignaturas','cursos.id_asignatura', '=', 'asignaturas.id')
                ->join('tipo_curso','cursos.id_tipo_curso', '=', 'tipo_curso.id')
                ->join('docente','cursos.id_docente', '=', 'docente.id')
                ->join('estudiante','notas.id_estudiante', '=', 'estudiante.id')
                ->join('desempenos','notas.id_desempenio', '=', 'desempenos.id')
                ->count();
            }else{
                $res = Notas::where('notas.id_curso',  $id)
                ->join('cursos','notas.id_curso', '=', 'cursos.id')
                ->join('asignaturas','cursos.id_asignatura', '=', 'asignaturas.id')
                ->join('tipo_curso','cursos.id_tipo_curso', '=', 'tipo_curso.id')
                ->join('docente','cursos.id_docente', '=', 'docente.id')
                ->join('estudiante','notas.id_estudiante', '=', 'estudiante.id')
                ->join('desempenos','notas.id_desempenio', '=', 'desempenos.id')
                ->count();
            }
        }

        if($res != 0){
            return Excel::download(new NotasBachiExcel($id, $idnota), 'listado_notas_bach.xlsx');
        }else{
            Session::flash('notas', 'Lo sentimos! No se encontró información para la solicitud.');
            return back();
        }
     }
////////////////////////////////////////////////////////////
     public function  exNotasTecnico(Request $request){
        $id = $request->idcurso;
        $idnota = $request->idexcel;
        //validar 
        if($idnota == 1){
            $res = DB::table('notas_tecnico')->where('notas_tecnico.id_tecnicos','=', $id)
                    ->where('notas_tecnico.definitiva', '>=', '3')
                    ->join('asignaturas_tecnicos','notas_tecnico.id_tecnicos', '=', 'asignaturas_tecnicos.id')
                    ->join('asig_tecnicos','asignaturas_tecnicos.id_asignaturas', '=', 'asig_tecnicos.id')
                    ->join('programa_tecnico','asignaturas_tecnicos.id_tecnico', '=', 'programa_tecnico.id')
                    ->join('docente','asignaturas_tecnicos.id_docente', '=', 'docente.id')
                    ->join('estudiante','notas_tecnico.id_estudiante', '=', 'estudiante.id')
                    ->join('desempenos','notas_tecnico.id_desempenio', '=', 'desempenos.id')
                    ->count();

        }else{
            if($idnota == 2){
                $res = DB::table('notas_tecnico')->where('notas_tecnico.id_tecnicos','=', $id)
                        ->where('notas_tecnico.definitiva', '<', '3')
                        ->join('asignaturas_tecnicos','notas_tecnico.id_tecnicos', '=', 'asignaturas_tecnicos.id')
                        ->join('asig_tecnicos','asignaturas_tecnicos.id_asignaturas', '=', 'asig_tecnicos.id')
                        ->join('programa_tecnico','asignaturas_tecnicos.id_tecnico', '=', 'programa_tecnico.id')
                        ->join('docente','asignaturas_tecnicos.id_docente', '=', 'docente.id')
                        ->join('estudiante','notas_tecnico.id_estudiante', '=', 'estudiante.id')
                        ->join('desempenos','notas_tecnico.id_desempenio', '=', 'desempenos.id')
                        ->count();
                
            }else{
                    $res = DB::table('notas_tecnico')->where('notas_tecnico.id_tecnicos','=', $id)
                            ->join('asignaturas_tecnicos','notas_tecnico.id_tecnicos', '=', 'asignaturas_tecnicos.id')
                            ->join('asig_tecnicos','asignaturas_tecnicos.id_asignaturas', '=', 'asig_tecnicos.id')
                            ->join('programa_tecnico','asignaturas_tecnicos.id_tecnico', '=', 'programa_tecnico.id')
                            ->join('docente','asignaturas_tecnicos.id_docente', '=', 'docente.id')
                            ->join('estudiante','notas_tecnico.id_estudiante', '=', 'estudiante.id')
                            ->join('desempenos','notas_tecnico.id_desempenio', '=', 'desempenos.id')
                            ->count();
               

            }
        }
        //end validar
        if($res != 0){
            return Excel::download(new NotasTecnicoExcel($id, $idnota), 'listado_notas_tecnico.xlsx');
        }else{
            Session::flash('pdft', 'Lo sentimos! No se encontró información para la solicitud.');
            return back();
        }
       
    }
    
    public function listadoEsTec(Request $request){

        //##############################################33
        $datosv = MatriculaTec::where('id_tecnico', $request->cursoba)
                ->where('anio', $request->anio)
                ->where('periodo', $request->periodo)
                ->where('id_trimestre', $request->trim)
                ->where('id_aprobado', '!=', '4')
                ->join('estudiante', 'id_estudiante', '=', 'estudiante.id')
                ->join('tipo_documento', 'estudiante.id_tipo_doc', '=', 'tipo_documento.id')
                ->join('genero', 'estudiante.id_genero', '=', 'genero.id')
                ->join('programa_tecnico', 'id_tecnico', '=', 'programa_tecnico.id')
                ->join('aprobado', 'id_aprobado', '=', 'aprobado.id')
                ->join('acudiente', 'estudiante.id', '=', 'acudiente.id_estudiante')
                ->join('parentezco', 'acudiente.id_parentesco', '=', 'parentezco.id')
                ->join('sistema_salud', 'estudiante.id', '=', 'sistema_salud.id_estudiante')
                ->join('etnia', 'sistema_salud.id_etnia', '=', 'etnia.id')
                ->join('tipo_documento as tipo', 'acudiente.id_tipo_doc', '=', 'tipo.id')
                ->join('trimestre_tecnicos', 'id_trimestre', '=', 'trimestre_tecnicos.id')
                ->count();
        //###############################################
       if ($datosv != 0){
        $datos = MatriculaTec::where('id_tecnico', $request->cursoba)
                    ->where('anio', $request->anio)
                    ->where('periodo', $request->periodo)
                    ->where('id_trimestre', $request->trim)
                    ->where('id_aprobado', '!=', '4')
                    ->join('estudiante', 'id_estudiante', '=', 'estudiante.id')
                    ->join('tipo_documento', 'estudiante.id_tipo_doc', '=', 'tipo_documento.id')
                    ->join('genero', 'estudiante.id_genero', '=', 'genero.id')
                    ->join('programa_tecnico', 'id_tecnico', '=', 'programa_tecnico.id')
                    ->join('aprobado', 'id_aprobado', '=', 'aprobado.id')
                    ->join('acudiente', 'estudiante.id', '=', 'acudiente.id_estudiante')
                    ->join('parentezco', 'acudiente.id_parentesco', '=', 'parentezco.id')
                    ->join('sistema_salud', 'estudiante.id', '=', 'sistema_salud.id_estudiante')
                    ->join('etnia', 'sistema_salud.id_etnia', '=', 'etnia.id')
                    ->join('tipo_documento as tipo', 'acudiente.id_tipo_doc', '=', 'tipo.id')
                    ->join('trimestre_tecnicos', 'id_trimestre', '=', 'trimestre_tecnicos.id')
                    ->select('estudiante.id as idest', 'estudiante.first_nom as primernom', 'estudiante.second_nom as segnom', 'estudiante.firts_ape as priape',
                    'estudiante.second_ape as segape', 'estudiante.num_doc', 'estudiante.telefono', 'programa_tecnico.codigotec', 'programa_tecnico.nombretec',
                    'anio', 'periodo', 'fec_matricula', 'trimestre_tecnicos.nombretri', 'aprobado.nombre', 
                    'estudiante.tiposangre', 'estudiante.dirresidencia', 'estudiante.dptresidencia', 'estudiante.munresidencia', 'estudiante.zona',
                    'estudiante.barrio', 'estudiante.telefono', 'estudiante.num_doc', 'estudiante.dpt_expedicion', 'estudiante.mun_expedicion', 'estudiante.fecnacimiento',
                    'estudiante.dpt_nacimiento', 'estudiante.mun_nacimiento',  'estudiante.correo', 'estudiante.estrato', 'tipo_documento.descripcion as tdoces',
                    'genero.descripcion as generoestu',  'acudiente.lastname as nomacu', 'parentezco.descripcion as paren',  'acudiente.telefono as telacu', 'acudiente.num_doc as numacu',
                    'acudiente.direccion as diracu', 'sistema_salud.regimen', 'sistema_salud.eps', 'sistema_salud.nivelformacion', 'sistema_salud.ocupacion', 'sistema_salud.discapacidad', 'etnia.descripcion as etniades',
                     'tipo.descripcion as tdocacu')
                    ->paginate(10);
       }else{
           $datos = array();
           Session::flash('info', 'Lo sentimos! No se encontró información para la solicitud.');
       }

       $dat = [ 'anio' => $request->anio, 
                'per' => $request->periodo,
                'curso' => $request->cursoba
            ];

        return view('docente.vistaListadoEsTecnicos')->with('datos', $datos)->with('dat', $dat);
    }

    //#####################33
       public function pdfestutec($anio, $per, $cur){
        $dia = date('d', time()); 
        $mes = date('m', time()); 
        $anio = date('Y', time());

        $idlog=auth()->id();
        $doc = DB::table('docente')->where('id_usuario', '=', $idlog)->select('nombre', 'apellido')->get();
        ///////////////////////////////////////////////////////////////////////
        $estudiante = MatriculaTec::where('id_tecnico', $cur)
                    ->where('anio', $anio)
                    ->where('periodo', $per)
                    ->where('id_aprobado', '!=', '4')
                    ->join('estudiante', 'id_estudiante', '=', 'estudiante.id')
                    ->join('tipo_documento', 'estudiante.id_tipo_doc', '=', 'tipo_documento.id')
                    ->join('genero', 'estudiante.id_genero', '=', 'genero.id')
                    ->join('programa_tecnico', 'id_tecnico', '=', 'programa_tecnico.id')
                    ->join('aprobado', 'id_aprobado', '=', 'aprobado.id')
                    ->join('acudiente', 'estudiante.id', '=', 'acudiente.id_estudiante')
                    ->join('parentezco', 'acudiente.id_parentesco', '=', 'parentezco.id')
                    ->join('sistema_salud', 'estudiante.id', '=', 'sistema_salud.id_estudiante')
                    ->join('etnia', 'sistema_salud.id_etnia', '=', 'etnia.id')
                    ->join('tipo_documento as tipo', 'acudiente.id_tipo_doc', '=', 'tipo.id')
                    ->join('trimestre_tecnicos', 'id_trimestre', '=', 'trimestre_tecnicos.id')
                    ->select('estudiante.id', 'estudiante.first_nom', 'estudiante.second_nom', 'estudiante.firts_ape',
                    'estudiante.second_ape')
                    ->get();
        //////////////////////////////////////////////////////////////////////
        $data = [
            'estudiante' => $estudiante,
            'dia' => $dia,
            'mes' => $mes,
            'anio' => $anio,
            'doc' => $doc,
        ];  
        ////////////////////////////////
        $pdf = PDF::loadView('docente.pdflista_tecnico', $data);
        return $pdf->download('listado_estudiantes_tecnicos.pdf');

       }
    //########################

    public function nivelTecnicos(Request $request){
        
        $p= $request->programa;
        $a =$request->anio;
        $pe = $request->periodo;

        //validar
        $valtec= DB::table('notas_tecnico')
                    ->join('asignaturas_tecnicos','notas_tecnico.id_tecnicos','=','asignaturas_tecnicos.id')
                    ->join('estudiante','notas_tecnico.id_estudiante','=','estudiante.id')
                    ->join('asig_tecnicos','asignaturas_tecnicos.id_asignaturas','=','asig_tecnicos.id')
                    ->join('docente','asignaturas_tecnicos.id_docente','=','docente.id')
                    ->join('programa_tecnico','asignaturas_tecnicos.id_tecnico','=','programa_tecnico.id')
                    ->join('trimestre_tecnicos','asignaturas_tecnicos.id_trimestre','=','trimestre_tecnicos.id')
                    ->where('definitiva','<','3')
                    ->where('asignaturas_tecnicos.anio','=',$a)
                    ->where('asignaturas_tecnicos.id_tecnico','=',$p)
                    ->count();
        if( $valtec != 0){
        //end validar
            $mat= DB::table('notas_tecnico')
            ->join('asignaturas_tecnicos','notas_tecnico.id_tecnicos','=','asignaturas_tecnicos.id')
            ->join('estudiante','notas_tecnico.id_estudiante','=','estudiante.id')
            ->join('asig_tecnicos','asignaturas_tecnicos.id_asignaturas','=','asig_tecnicos.id')
            ->join('docente','asignaturas_tecnicos.id_docente','=','docente.id')
            ->join('programa_tecnico','asignaturas_tecnicos.id_tecnico','=','programa_tecnico.id')
            ->join('trimestre_tecnicos','asignaturas_tecnicos.id_trimestre','=','trimestre_tecnicos.id')
            ->where('definitiva','<','3')
            ->where('asignaturas_tecnicos.anio','=',$a)
            ->where('asignaturas_tecnicos.id_tecnico','=',$p)
            ->select('notas_tecnico.id as idnot', 'asig_tecnicos.val_habilitacion as valor','asig_tecnicos.nombreasig as nomasig',
                      'docente.nombre as nomdoc','docente.apellido as apedoc','programa_tecnico.nombretec as descu', 'estudiante.id as idest',
                      'estudiante.first_nom as nom1','estudiante.second_nom as nom2','estudiante.firts_ape as ape1',
                      'estudiante.second_ape as ape2','estudiante.num_doc','notas_tecnico.definitiva','notas_tecnico.nota1',
                      'notas_tecnico.nota2','notas_tecnico.nota3','notas_tecnico.nota4','trimestre_tecnicos.nombretri')
            ->orderby('descu','asc')
            ->get();
            return view('nivelaciones.listaTec')->with('re',$mat)->with('anio',$a)->with('programa',$p); //agregar
        }else{
            Session::flash('niv', 'Lo sentimos! No se encontró información para la solicitud.');
            return view('nivelaciones.listaTec')->with('anio',$a)->with('programa',$p);
        }

    }

    //reporte de notas de tecnicos estudiante
    public function notasEsTec(Request $request){
        $ides = auth()->user()->id;
        $val= DB::table('estudiante')->where('id_usuario', '=', $ides)->select('estudiante.id as idestu')->first();

        $estudiante= DB::table('matricula_tecnico')
                    ->where('matricula_tecnico.id_estudiante', '=', $val->idestu)
                    ->where('matricula_tecnico.anio', '=', $request->anio)
                    ->where('matricula_tecnico.periodo', '=', $request->periodo)
                    ->where('matricula_tecnico.id_tecnico', '=', $request->tecnico)
                    ->join('estudiante','estudiante.id','=','matricula_tecnico.id_estudiante')
                    ->join('programa_tecnico','matricula_tecnico.id_tecnico','=','programa_tecnico.id')
                    ->join('tipo_documento','estudiante.id_tipo_doc','=','tipo_documento.id')
                    ->join('trimestre_tecnicos','matricula_tecnico.id_trimestre','=','trimestre_tecnicos.id')
                    ->select('estudiante.id as ides','matricula_tecnico.anio','matricula_tecnico.periodo','programa_tecnico.codigotec',
                            'programa_tecnico.nombretec','programa_tecnico.jornada','estudiante.first_nom as nombre',
                            'estudiante.second_nom as segundonom', 'estudiante.second_ape as segundoape', 'estudiante.firts_ape as primerape', 
                            'estudiante.num_doc', 'tipo_documento.descripcion as destipo','trimestre_tecnicos.nombretri')
                    ->first();
                  //validar 
                  $notasv = DB::table('notas_tecnico')
                  ->where('notas_tecnico.id_estudiante',$val->idestu)
                  ->where('asignaturas_tecnicos.anio', '=', $request->anio)
                  ->where('asignaturas_tecnicos.periodo', '=', $request->periodo)
                  ->where('programa_tecnico.id', '=', $request->tecnico)
                  ->join('asignaturas_tecnicos','notas_tecnico.id_tecnicos','=','asignaturas_tecnicos.id')
                  ->join('programa_tecnico', 'asignaturas_tecnicos.id_tecnico', '=', 'programa_tecnico.id')
                  ->join('desempenos','notas_tecnico.id_desempenio','=','desempenos.id')
                  ->join('asig_tecnicos','asignaturas_tecnicos.id_asignaturas','=','asig_tecnicos.id')
                  ->join('docente', 'asignaturas_tecnicos.id_docente', '=', 'docente.id')
                  ->count();
                 //end valida
                 if($notasv != 0){ 
                    $notas = DB::table('notas_tecnico')
                        ->where('notas_tecnico.id_estudiante',$val->idestu)
                        ->where('asignaturas_tecnicos.anio', '=', $request->anio)
                        ->where('asignaturas_tecnicos.periodo', '=', $request->periodo)
                        ->join('asignaturas_tecnicos','notas_tecnico.id_tecnicos','=','asignaturas_tecnicos.id')
                        ->join('desempenos','notas_tecnico.id_desempenio','=','desempenos.id')
                        ->join('asig_tecnicos','asignaturas_tecnicos.id_asignaturas','=','asig_tecnicos.id')
                        ->join('docente', 'asignaturas_tecnicos.id_docente', '=', 'docente.id')
                        ->select('definitiva','asig_tecnicos.nombreasig','asig_tecnicos.codigoasig','desempenos.descripcion as desem',
                        'docente.nombre', 'docente.apellido','id_tecnicos','asig_tecnicos.intensidad_horaria as ih')
                        ->get();
                    $ob = DB::table('objetivostec')->select('objetivostec.descripcion as desob', 'objetivostec.id_asignaturas as idasig')->get();
                    
                    return view('tecnico.notastec')->with('estudiante', $estudiante)->with('notas', $notas)->with('ob', $ob);

                 }else{
                    $notas = array();
                    $ob = array();
                    $res = 0;
                    return view('tecnico.notastec')->with('notas', $notas)->with('ob', $ob)->with('res', $res);
                 }
    }

    //###############################33333
    public function recibotecnico(Request $request){
        $a=$request->anio;
        $p=$request->programa;
        //######################################################
        $val = DB::table('nivelacionestec')->where('numrecibo','=',$request->numrecibo)->count();
        if($val == 0){
            $recibo = New Niveltec();
            $recibo->id_nota = $request->input('idnota');
            $recibo->descripcion = $request->input('desrecibo');
            $recibo->numrecibo = $request->input('numrecibo');
            $recibo->nota = $request->input('nota');
            if($request->hasFile('img')){             
                $file = $request->file('img');
                $val = "tecnico".time().".".$file->guessExtension();
                $ruta = public_path("dist/archivo/".$val);
               // if($file->guessExtension()=="pdf"){
                copy($file, $ruta);//ccopia el archivo de una ruta cualquiera a donde este
                $recibo->imgrecibo = $val;//ingresa el nombre de la ruta a la base de datos
               }
              $recibo->save();
              Session::flash('alerta','Datos registrados exitosamente');
        }else{
            Session::flash('alerta','Lo sentimos! el recibo ingresado ya se encuentra registrado.');
        }
        //consultar los datos para regresar al estado inicial
        $mat= DB::table('notas_tecnico')
                ->join('asignaturas_tecnicos','notas_tecnico.id_tecnicos','=','asignaturas_tecnicos.id')
                ->join('estudiante','notas_tecnico.id_estudiante','=','estudiante.id')
                ->join('asig_tecnicos','asignaturas_tecnicos.id_asignaturas','=','asig_tecnicos.id')
                ->join('docente','asignaturas_tecnicos.id_docente','=','docente.id')
                ->join('programa_tecnico','asignaturas_tecnicos.id_tecnico','=','programa_tecnico.id')
                ->join('trimestre_tecnicos','asignaturas_tecnicos.id_trimestre','=','trimestre_tecnicos.id')
                ->where('definitiva','<','3')
                ->where('asignaturas_tecnicos.anio','=', $a)
                ->where('asignaturas_tecnicos.id_tecnico','=',$p)
                ->select('notas_tecnico.id as idnot', 'asig_tecnicos.val_habilitacion as valor','asig_tecnicos.nombreasig as nomasig',
                        'docente.nombre as nomdoc','docente.apellido as apedoc','programa_tecnico.nombretec as descu', 'estudiante.id as idest',
                        'estudiante.first_nom as nom1','estudiante.second_nom as nom2','estudiante.firts_ape as ape1',
                        'estudiante.second_ape as ape2','estudiante.num_doc','notas_tecnico.definitiva','notas_tecnico.nota1',
                        'notas_tecnico.nota2','notas_tecnico.nota3','notas_tecnico.nota4','trimestre_tecnicos.nombretri')
                ->orderby('descu','asc')
                ->get();
        
        return view('nivelaciones.listaTec')->with('re',$mat)->with('anio',$a)->with('programa',$p);
    }
    
    //consultar recibos en tecnicos
    public function consulrecibos($a, $p){
        $val = DB::table('nivelacionestec')->count();
        $niv = 0;
        if($val != 0){
          $niv = DB::table('nivelacionestec')
                ->join('notas_tecnico','nivelacionestec.id_nota','=','notas_tecnico.id')
                ->join('estudiante','notas_tecnico.id_estudiante','=','estudiante.id')
                ->join('asignaturas_tecnicos','notas_tecnico.id_tecnicos','=','asignaturas_tecnicos.id')
                ->join('programa_tecnico','asignaturas_tecnicos.id_tecnico','=','programa_tecnico.id')
                ->join('asig_tecnicos','asignaturas_tecnicos.id_asignaturas','=','asig_tecnicos.id')
                ->join('docente','asignaturas_tecnicos.id_docente','=','docente.id')
                ->join('trimestre_tecnicos','asignaturas_tecnicos.id_trimestre','=','trimestre_tecnicos.id')
                ->where('asignaturas_tecnicos.anio','=',$a)
                ->where('asignaturas_tecnicos.id_tecnico','=',$p)
                ->select('nivelacionestec.id as idniv', 'nivelacionestec.descripcion', 'nivelacionestec.numrecibo', 'nivelacionestec.nota as notantigua',
                        'nivelacionestec.imgrecibo', 'estudiante.first_nom as primernom', 'estudiante.second_nom as segnom', 'estudiante.firts_ape as primerape', 
                        'estudiante.second_ape as segape', 'notas_tecnico.nota1', 'notas_tecnico.nota2', 'notas_tecnico.nota3', 'notas_tecnico.nota4', 'notas_tecnico.definitiva', 'notas_tecnico.por1', 'notas_tecnico.por2', 'notas_tecnico.por3', 
                        'notas_tecnico.por4', 'programa_tecnico.nombretec as cursonom', 'asig_tecnicos.nombreasig as nomasig', 'docente.nombre', 'docente.apellido', 'trimestre_tecnicos.nombretri', 'asignaturas_tecnicos.anio', 'asignaturas_tecnicos.periodo')
                ->get();
        }
     return view('nivelaciones.listarchivotec')->with('niv', $niv);
    
    }

    //actualizar 
   public function recibotecnicoactu(Request $request){
    $recibo = Niveltec::findOrfail($request->idniv);    
    $recibo->descripcion = $request->input('desrecibo');
    $recibo->numrecibo = $request->input('numrecibo');
    if($request->hasFile('img')){             
        $file = $request->file('img');
        $val = "tecnico".time().".".$file->guessExtension();
        $ruta = public_path("dist/archivo/".$val);
       // if($file->guessExtension()=="pdf"){
        copy($file, $ruta);//ccopia el archivo de una ruta cualquiera a donde este
        $recibo->imgrecibo = $val;//ingresa el nombre de la ruta a la base de datos
       }
    $recibo->save();
    Session::flash('inf','El registro se actualizó de manera exitosa.');
    return back();
   }

   public function elimrecibotec($id){
        $elim = Niveltec::findOrfail($id);   
        $elim->delete();
        Session::flash('inf','El registro se eliminó de manera exitosa.');
        return back();
   }

   //lista de archivos
   public function consultecarchivo($id, $a){
    $val = DB::table('nivelacionestec')
           ->join('notas_tecnico','nivelacionestec.id_nota','=','notas_tecnico.id')
           ->where('notas_tecnico.id_estudiante','=',$id)
           ->count();
        $niv = 0;
        if($val != 0){
          $niv = DB::table('nivelacionestec')
                ->join('notas_tecnico','nivelacionestec.id_nota','=','notas_tecnico.id')
                ->join('estudiante','notas_tecnico.id_estudiante','=','estudiante.id')
                ->join('asignaturas_tecnicos','notas_tecnico.id_tecnicos','=','asignaturas_tecnicos.id')
                ->join('programa_tecnico','asignaturas_tecnicos.id_tecnico','=','programa_tecnico.id')
                ->join('asig_tecnicos','asignaturas_tecnicos.id_asignaturas','=','asig_tecnicos.id')
                ->join('docente','asignaturas_tecnicos.id_docente','=','docente.id')
                ->join('trimestre_tecnicos','asignaturas_tecnicos.id_trimestre','=','trimestre_tecnicos.id')
                ->where('asignaturas_tecnicos.anio','=',$a)
                ->where('notas_tecnico.id_estudiante','=',$id)
                ->select('nivelacionestec.id as idniv', 'nivelacionestec.descripcion', 'nivelacionestec.numrecibo', 'nivelacionestec.nota as notantigua',
                        'nivelacionestec.imgrecibo', 'estudiante.first_nom as primernom', 'estudiante.second_nom as segnom', 'estudiante.firts_ape as primerape', 
                        'estudiante.second_ape as segape', 'notas_tecnico.nota1', 'notas_tecnico.nota2', 'notas_tecnico.nota3', 'notas_tecnico.nota4', 'notas_tecnico.definitiva', 'notas_tecnico.por1', 'notas_tecnico.por2', 'notas_tecnico.por3', 
                        'notas_tecnico.por4', 'programa_tecnico.nombretec as cursonom', 'asig_tecnicos.nombreasig as nomasig', 'docente.nombre', 'docente.apellido', 'trimestre_tecnicos.nombretri', 'asignaturas_tecnicos.anio', 'asignaturas_tecnicos.periodo')
                ->get();
        }
      return view('nivelaciones.listarchivotec')->with('niv', $niv);
   }

   //vaciar base de datos
   public function vaciardb(){
    SistemaSalud::all()->each->delete();

    Acudiente::all()->each->delete();

    Matricula::all()->each->delete();

    MatriculaTec::all()->each->delete();
    
    Nivelacion::all()->each->delete();

    Niveltec::all()->each->delete();
    
    Objetivos::all()->each->delete();
   
    ObjetivosTec::all()->each->delete();

    NotasTecnico::all()->each->delete();

    Notas::all()->each->delete();

    Estudiante::all()->each->delete();

    //###docentes
    AsigProgram::all()->each->delete();

    AsigTecnicos::all()->each->delete();

    Docente::all()->each->delete();
    
    Asignatura::all()->each->delete();

    AsignaturaTecnicos::all()->each->delete();

    Cargarchivo::all()->each->delete();

    Perfil::all()->each->delete();

    ProgramasTecnicos::all()->each->delete();

    Programas::all()->each->delete();

    User::all()->where('id_rol', '!=', '1')->each->delete();

    Session::flash('db','La base de datos se limpió de manera exitosa!.');
    return back();
   }

}
