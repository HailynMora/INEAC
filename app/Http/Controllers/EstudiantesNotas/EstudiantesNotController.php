<?php

namespace App\Http\Controllers\EstudiantesNotas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\EstudianteModel\Estudiante;
use App\Models\Nivelacion;
use App\Exports\NivelacionesExport;
use App\Exports\NivelacionesTecExport;
use Maatwebsite\Excel\Facades\Excel;
use Session;
use PDF;
use DB;

class EstudiantesNotController extends Controller
{
    public function vista(Request $request){
        $idlog=auth()->id();
        $idestu = DB::table('estudiante')->where('id_usuario', $idlog)->select('estudiante.id as ides')->first();
       
        //validar Datos
        $v = DB::table('notas')->join('cursos', 'notas.id_curso', '=', 'cursos.id')
                ->join('estudiante', 'notas.id_estudiante', '=', 'estudiante.id')
                ->join('asignaturas', 'cursos.id_asignatura', '=', 'asignaturas.id')
                ->join('tipo_curso', 'cursos.id_tipo_curso', '=', 'tipo_curso.id')
                ->join('docente', 'cursos.id_docente', '=', 'docente.id')
                ->where('notas.id_estudiante', $idestu->ides)
                ->where('cursos.anio', $request->anio)
                ->where('cursos.periodo', $request->periodo)->count();
        //end validar
        if($v != 0){
        $datos = DB::table('notas')->join('cursos', 'notas.id_curso', '=', 'cursos.id')
                     ->join('estudiante', 'notas.id_estudiante', '=', 'estudiante.id')
                     ->join('asignaturas', 'cursos.id_asignatura', '=', 'asignaturas.id')
                     ->join('tipo_curso', 'cursos.id_tipo_curso', '=', 'tipo_curso.id')
                     ->join('docente', 'cursos.id_docente', '=', 'docente.id')
                     ->select('notas.id as idnota', 'notas.nota1', 'notas.nota2', 'notas.nota3', 'notas.nota4', 'notas.por1', 'notas.por2', 'notas.por3', 'notas.por4', 'notas.definitiva', 
                              'asignaturas.nombre as asignatura', 'tipo_curso.descripcion as curso', 'tipo_curso.cursodes as descur', 'docente.nombre as nomdoc', 'docente.apellido as apedoc',
                              'docente.num_doc as numdoc', 'estudiante.first_nom as primernom', 'estudiante.second_nom as segnom', 'estudiante.firts_ape as primerape', 'estudiante.second_ape as segape', 'estudiante.num_doc as numes')
                     ->where('notas.id_estudiante', $idestu->ides)
                     ->where('cursos.anio', $request->anio)
                     ->where('cursos.periodo', $request->periodo)->get();
                     
        return view('estudiantes.notas')->with('datos', $datos);
        }else{
            $res=0;
            $datos=array();
            return view('estudiantes.notas')->with('datos', $datos)->with('res', $res);
        }
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
                    ->select('estudiante.id as ides','matriculas.anio','matriculas.periodo','tipo_curso.codigo','tipo_curso.descripcion','tipo_curso.jornada','tipo_curso.cursodes','estudiante.first_nom as nombre', 'estudiante.second_nom as segundonom', 'estudiante.second_ape as segundoape', 'estudiante.firts_ape as primerape', 'estudiante.num_doc', 'tipo_documento.descripcion  as destipo')
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

    public function nivelacion(Request $request){
        
        $p= $request->programa;
        $a =$request->anio;
        $pe = $request->periodo;
        
        if($request->val == 1){
            //validar
            $valmat= DB::table('notas')
                        ->join('cursos','notas.id_curso','=','cursos.id')
                        ->join('estudiante','notas.id_estudiante','=','estudiante.id')
                        ->join('asignaturas','cursos.id_asignatura','=','asignaturas.id')
                        ->join('docente','cursos.id_docente','=','docente.id')
                        ->join('tipo_curso','cursos.id_tipo_curso','=','tipo_curso.id')
                        ->where('definitiva','<','3')
                        ->where('cursos.anio','=',$a)
                        ->where('cursos.periodo','=',$pe)
                        ->where('cursos.id_tipo_curso','=',$p)
                        ->count();
            //end validar
            if($valmat != 0){

                $mat= DB::table('notas')
                ->join('cursos','notas.id_curso','=','cursos.id')
                ->join('estudiante','notas.id_estudiante','=','estudiante.id')
                ->join('asignaturas','cursos.id_asignatura','=','asignaturas.id')
                ->join('docente','cursos.id_docente','=','docente.id')
                ->join('tipo_curso','cursos.id_tipo_curso','=','tipo_curso.id')
                ->where('definitiva','<','3')
                ->where('cursos.anio','=',$a)
                ->where('cursos.periodo','=',$pe)
                ->where('cursos.id_tipo_curso','=',$p)
                ->select('estudiante.id as idest', 'notas.id as idnota', 'asignaturas.codigo as codasig','asignaturas.val_habilitacion as valor','asignaturas.nombre as nomasig','docente.nombre as nomdoc','docente.apellido as apedoc','tipo_curso.codigo as codcu','tipo_curso.descripcion as descu','estudiante.first_nom as nom1','estudiante.second_nom as nom2','estudiante.firts_ape as ape1','estudiante.second_ape as ape2','estudiante.num_doc','notas.definitiva','notas.nota1','notas.nota2','notas.nota3','notas.nota4')
                ->orderby('descu','asc')
                ->get();
                return view('nivelaciones.lista')->with('re',$mat)->with('p', $p)->with('a', $a)->with('pe', $pe);
            }else{
                Session::flash('niv', 'Lo sentimos! No se encontró información para la solicitud.');
                return view('nivelaciones.lista')->with('p', $p)->with('a', $a)->with('pe', $pe);//copiar esta linea 2023
            }
        }else{
            $mat= DB::table('notas_tecnico')
            ->join('asignaturas_tecnicos','notas_tecnico.id_tecnicos','=','asignaturas_tecnicos.id')
            ->join('estudiante','notas_tecnico.id_estudiante','=','estudiante.id')
            ->join('asig_tecnicos','asignaturas_tecnicos.id_asignaturas','=','asig_tecnicos.id')
            ->join('docente','asignaturas_tecnicos.id_docente','=','docente.id')
            ->join('programa_tecnico','asignaturas_tecnicos.id_tecnico','=','programa_tecnico.id')
            ->join('trimestre_tecnicos','asignaturas_tecnicos.id_trimestre','=','trimestre_tecnicos.id')
            ->where('definitiva','<','3')
            ->where('asignaturas_tecnicos.anio','=',$a)
            ->where('asignaturas_tecnicos.periodo','=',$pe)
            ->select('asig_tecnicos.val_habilitacion as valor','asig_tecnicos.nombreasig as nomasig','docente.nombre as nomdoc','docente.apellido as apedoc','programa_tecnico.nombretec as descu','estudiante.first_nom as nom1','estudiante.second_nom as nom2','estudiante.firts_ape as ape1','estudiante.second_ape as ape2','estudiante.num_doc','notas_tecnico.definitiva','notas_tecnico.nota1','notas_tecnico.nota2','notas_tecnico.nota3','notas_tecnico.nota4','trimestre_tecnicos.nombretri')
            ->orderby('descu','asc')
            ->get();
            return view('nivelaciones.listaTec')->with('re',$mat)->with('p', $p)->with('a', $a)->with('pe', $pe);
        }
        
    }
    public function boletintec(Request $request){
               
        //validar estudiante
        $estuval= DB::table('matricula_tecnico')
                    ->where('matricula_tecnico.id_estudiante', '=', $request->ides)
                    ->where('matricula_tecnico.anio', '=', $request->anio)
                    ->where('matricula_tecnico.periodo', '=', $request->periodo)
                    ->join('estudiante','estudiante.id','=','matricula_tecnico.id_estudiante')
                    ->join('programa_tecnico','matricula_tecnico.id_tecnico','=','programa_tecnico.id')
                    ->join('tipo_documento','estudiante.id_tipo_doc','=','tipo_documento.id')
                    ->join('trimestre_tecnicos','matricula_tecnico.id_trimestre','=','trimestre_tecnicos.id')
                    ->select('estudiante.id as ides','matricula_tecnico.anio','matricula_tecnico.periodo','programa_tecnico.codigotec','programa_tecnico.nombretec','programa_tecnico.jornada','estudiante.first_nom as nombre', 'estudiante.second_nom as segundonom', 'estudiante.second_ape as segundoape', 'estudiante.firts_ape as primerape', 'estudiante.num_doc', 'tipo_documento.descripcion as destipo','trimestre_tecnicos.nombretri')
                    ->count();
        //validar notas
        $valnot = DB::table('notas_tecnico')
                    ->where('notas_tecnico.id_estudiante',$request->ides)
                    ->where('asignaturas_tecnicos.anio', '=', $request->anio)
                    ->where('asignaturas_tecnicos.periodo', '=', $request->periodo)
                    ->join('asignaturas_tecnicos','notas_tecnico.id_tecnicos','=','asignaturas_tecnicos.id')
                    ->join('desempenos','notas_tecnico.id_desempenio','=','desempenos.id')
                    ->join('asig_tecnicos','asignaturas_tecnicos.id_asignaturas','=','asig_tecnicos.id')
                    ->join('docente', 'asignaturas_tecnicos.id_docente', '=', 'docente.id')
                    ->select('definitiva','asig_tecnicos.nombreasig','asig_tecnicos.codigoasig','desempenos.descripcion as desem','docente.nombre', 'docente.apellido','id_tecnicos','asig_tecnicos.intensidad_horaria as ih')
                    ->count();
        //###########################################
        if($estuval != 0 && $valnot != 0){
                $estudiante= DB::table('matricula_tecnico')
                    ->where('matricula_tecnico.id_estudiante', '=', $request->ides)
                    ->where('matricula_tecnico.anio', '=', $request->anio)
                    ->where('matricula_tecnico.periodo', '=', $request->periodo)
                    ->join('estudiante','estudiante.id','=','matricula_tecnico.id_estudiante')
                    ->join('programa_tecnico','matricula_tecnico.id_tecnico','=','programa_tecnico.id')
                    ->join('tipo_documento','estudiante.id_tipo_doc','=','tipo_documento.id')
                    ->join('trimestre_tecnicos','matricula_tecnico.id_trimestre','=','trimestre_tecnicos.id')
                    ->select('estudiante.id as ides','matricula_tecnico.anio','matricula_tecnico.periodo','programa_tecnico.codigotec','programa_tecnico.nombretec','programa_tecnico.jornada','estudiante.first_nom as nombre', 'estudiante.second_nom as segundonom', 'estudiante.second_ape as segundoape', 'estudiante.firts_ape as primerape', 'estudiante.num_doc', 'tipo_documento.descripcion as destipo','trimestre_tecnicos.nombretri')
                    ->first();
                    
                $notas = DB::table('notas_tecnico')
                    ->where('notas_tecnico.id_estudiante',$request->ides)
                    ->where('asignaturas_tecnicos.anio', '=', $request->anio)
                    ->where('asignaturas_tecnicos.periodo', '=', $request->periodo)
                    ->join('asignaturas_tecnicos','notas_tecnico.id_tecnicos','=','asignaturas_tecnicos.id')
                    ->join('desempenos','notas_tecnico.id_desempenio','=','desempenos.id')
                    ->join('asig_tecnicos','asignaturas_tecnicos.id_asignaturas','=','asig_tecnicos.id')
                    ->join('docente', 'asignaturas_tecnicos.id_docente', '=', 'docente.id')
                    ->select('definitiva','asig_tecnicos.nombreasig','asig_tecnicos.codigoasig','desempenos.descripcion as desem','docente.nombre', 'docente.apellido','id_tecnicos','asig_tecnicos.intensidad_horaria as ih')
                    ->get();
                
                $ob = DB::table('objetivostec')->select('objetivostec.descripcion as desob', 'objetivostec.id_asignaturas as idasig')->get();
                
                $data = [
                    'estudiante' => $estudiante,
                    'notas' => $notas,
                    'ob' => $ob
                ];   
                
                $pdf = PDF::loadView('tecnico.boletin', $data);
                return $pdf->download('boletin_academico_tecnico.pdf');
            }else{
                if($estuval == 0){
                    Session::flash('est','Lo sentimos! no se encontro información en el año y periodo académico seleccionado.');
                }else{
                    if($valnot == 0){
                        Session::flash('est','Lo sentimos! el estudiante no tiene notas vinculadas.');
                    }
                }
                return back();
            }
       }

    public function nivelaciones(Request $request){
        $anio = $request->anio;
        $periodo = $request->periodo;
        $programa = $request->programa;
        $idlog=auth()->id();
        $doc = DB::table('docente')->where('id_usuario', $idlog)->select('docente.id as idoc')->first();
        $docc=$doc->idoc;
        /////#################################################################
        $resv = DB::table('cursos')
                ->where('cursos.id_docente','=',$docc)
                ->where('cursos.anio','=',$anio)
                ->where('cursos.periodo','=',$periodo)
                ->where('cursos.id_tipo_curso','=',$programa)
                ->where('notas.definitiva','<',3)
                ->join('tipo_curso','cursos.id_tipo_curso','=','tipo_curso.id')
                ->join('asignaturas','cursos.id_asignatura','=','asignaturas.id')
                ->join('notas','cursos.id','=','notas.id_curso')
                ->join('estudiante','notas.id_estudiante','=','estudiante.id')
                ->join('tipo_documento','estudiante.id_tipo_doc','=','tipo_documento.id')
                ->join('docente','cursos.id_docente','=','docente.id')
                ->count();
         ////##################################################################
        if($resv != 0){
            return Excel::download(new NivelacionesExport($docc, $anio, $periodo,$programa), 'nivelaciones.xlsx');
        }else{
            $r = 0;
            return view('inicio.vista')->with('r',$r);
        }
       
    }

    //reporte nivelaciones tecnicos
    public function nivelTec(Request $request){
        $anio = $request->anio;
        $programa = $request->programa;
        $idlog=auth()->id();
        $validar = DB::table('docente')->where('id_usuario', $idlog)->select('docente.id as idoc')->count();
        if($validar != 0){
        $doc = DB::table('docente')->where('id_usuario', $idlog)->select('docente.id as idoc')->first();
        $docc=$doc->idoc;
        //###########################################################
        $resv = DB::table('asignaturas_tecnicos')
                ->where('asignaturas_tecnicos.id_docente','=',$docc)
                ->where('asignaturas_tecnicos.anio','=',$anio)
                ->where('asignaturas_tecnicos.id_tecnico','=',$programa)
                ->where('notas_tecnico.definitiva','<',3)
                ->join('notas_tecnico','asignaturas_tecnicos.id','=','notas_tecnico.id')
                ->join('programa_tecnico','asignaturas_tecnicos.id_tecnico','=','programa_tecnico.id')
                ->join('asig_tecnicos','asignaturas_tecnicos.id_asignaturas','asig_tecnicos.id')
                ->join('trimestre_tecnicos','asignaturas_tecnicos.id_trimestre','trimestre_tecnicos.id')
                ->join('estudiante','notas_tecnico.id_estudiante','=','estudiante.id')
                ->join('tipo_documento','estudiante.id_tipo_doc','=','tipo_documento.id')
                ->join('docente','asignaturas_tecnicos.id_docente','=','docente.id')
                ->count(); 
        //##########################################################
        if($resv != 0){
            return Excel::download(new NivelacionesTecExport($docc, $anio, $programa), 'nivelaciones_tecnicos.xlsx');
        }else{
            $r = 0;
            return view('inicio.vista')->with('r',$r);
        }
      }else{
            $r = 0;
            return view('inicio.vista')->with('r',$r);
      }
      
    }
    //nivelaciones
    public function nivel(){
        $idlog=auth()->id();
        $validar = DB::table('estudiante')->where('id_usuario', $idlog)->select('estudiante.id as ides')->count();
        if($validar != 0){
        $est = DB::table('estudiante')->where('id_usuario', $idlog)->select('estudiante.id as ides')->first();
        $idest=$est->ides;

        //validar nivelaciones bach
        $valnb = DB::table('notas')
                ->where('id_estudiante','=',$idest)
                ->where('notas.definitiva','<',3)
                ->join('cursos','notas.id_curso','=','cursos.id')
                ->join('asignaturas','cursos.id_asignatura','=','asignaturas.id')
                ->join('tipo_curso','cursos.id_tipo_curso','=','tipo_curso.id')
                ->join('docente','cursos.id_docente','=','docente.id')
                ->count();
        //validar tecnicos
        $valtec = DB::table('notas_tecnico')
                ->where('id_estudiante','=',$idest)
                ->where('definitiva','<',3)
                ->join('asignaturas_tecnicos','notas_tecnico.id_tecnicos','=','asignaturas_tecnicos.id')
                ->join('programa_tecnico','asignaturas_tecnicos.id_tecnico','=','programa_tecnico.id')
                ->join('docente','asignaturas_tecnicos.id_docente','=','docente.id')
                ->join('asig_tecnicos','asignaturas_tecnicos.id_asignaturas','=','asig_tecnicos.id')
                ->join('trimestre_tecnicos','asignaturas_tecnicos.id_trimestre','=','trimestre_tecnicos.id')
                ->count();
        //##############
        if($valnb != 0 || $valtec != 0){
        $bac = DB::table('notas')
                ->where('id_estudiante','=',$idest)
                ->where('notas.definitiva','<',3)
                ->join('cursos','notas.id_curso','=','cursos.id')
                ->join('asignaturas','cursos.id_asignatura','=','asignaturas.id')
                ->join('tipo_curso','cursos.id_tipo_curso','=','tipo_curso.id')
                ->join('docente','cursos.id_docente','=','docente.id')
                ->select('asignaturas.nombre as nombreasig','asignaturas.val_habilitacion','tipo_curso.descripcion as descur','docente.nombre as nomdoc','docente.apellido as apedoc','anio','periodo','notas.definitiva')
                ->orderby('descur','asc')
                ->get();
            $tec = DB::table('notas_tecnico')
                ->where('id_estudiante','=',$idest)
                ->where('definitiva','<',3)
                ->join('asignaturas_tecnicos','notas_tecnico.id_tecnicos','=','asignaturas_tecnicos.id')
                ->join('programa_tecnico','asignaturas_tecnicos.id_tecnico','=','programa_tecnico.id')
                ->join('docente','asignaturas_tecnicos.id_docente','=','docente.id')
                ->join('asig_tecnicos','asignaturas_tecnicos.id_asignaturas','=','asig_tecnicos.id')
                ->join('trimestre_tecnicos','asignaturas_tecnicos.id_trimestre','=','trimestre_tecnicos.id')
                ->select('programa_tecnico.nombretec','docente.nombre as nomdoc','docente.apellido as apedoc','asig_tecnicos.nombreasig','asig_tecnicos.val_habilitacion','trimestre_tecnicos.nombretri','anio','periodo','notas_tecnico.definitiva')
                ->orderby('nombretec','asc')
                ->get();
               
         return view('nivelaciones.nivelacionesest')->with('bac',$bac)->with('tec',$tec);
        }else{
            $res=0;
            return view('nivelaciones.nivelacionesest')->with('res',$res);
        }
    }else{
        $res=0;
        return view('nivelaciones.nivelacionesest')->with('res',$res);
    }
    }

    //################funcion de recibo
    public function guardar_recibo(Request $request){
        //variables 
        $p= $request->programa;
        $a =$request->anio;
        $pe = $request->periodo;
        //######################################################
        $val = DB::table('nivelaciones')->where('numrecibo','=',$request->numrecibo)->count();
        if($val == 0){
            $recibo = New Nivelacion();
            $recibo->id_estudiante = $request->input('idest');
            $recibo->id_nota = $request->input('idnota');
            $recibo->descripcion = $request->input('desrecibo');
            $recibo->numrecibo = $request->input('numrecibo');
            $recibo->nota = $request->input('nota');
            if($request->hasFile('img')){             
                $file = $request->file('img');
                $val = "recibo".time().".".$file->guessExtension();
                $ruta = public_path("dist/archivo/".$val);
               // if($file->guessExtension()=="pdf"){
                copy($file, $ruta);//ccopia el archivo de una ruta cualquiera a donde este
                $recibo->imgrecibo = $val;//ingresa el nombre de la ruta a la base de datos
               }
            $recibo->save();
        }else{
            Session::flash('rep','Lo sentimos! el recibo ingresado ya se encuentra registrado.');
        }
        //regresar datos
        $valmat= DB::table('notas')
                    ->join('cursos','notas.id_curso','=','cursos.id')
                    ->join('estudiante','notas.id_estudiante','=','estudiante.id')
                    ->join('asignaturas','cursos.id_asignatura','=','asignaturas.id')
                    ->join('docente','cursos.id_docente','=','docente.id')
                    ->join('tipo_curso','cursos.id_tipo_curso','=','tipo_curso.id')
                    ->where('definitiva','<','3')
                    ->where('cursos.anio','=',$request->anio)
                    ->where('cursos.periodo','=',$request->periodo)
                    ->where('cursos.id_tipo_curso','=',$request->programa)
                    ->count();
                    //end validar
        if($valmat != 0){

        $mat= DB::table('notas')
                ->join('cursos','notas.id_curso','=','cursos.id')
                ->join('estudiante','notas.id_estudiante','=','estudiante.id')
                ->join('asignaturas','cursos.id_asignatura','=','asignaturas.id')
                ->join('docente','cursos.id_docente','=','docente.id')
                ->join('tipo_curso','cursos.id_tipo_curso','=','tipo_curso.id')
                ->where('definitiva','<','3')
                ->where('cursos.anio','=',$request->anio)
                ->where('cursos.periodo','=',$request->periodo)
                ->where('cursos.id_tipo_curso','=',$request->programa)
                ->select('estudiante.id as idest', 'notas.id as idnota', 'asignaturas.codigo as codasig','asignaturas.val_habilitacion as valor','asignaturas.nombre as nomasig','docente.nombre as nomdoc','docente.apellido as apedoc','tipo_curso.codigo as codcu','tipo_curso.descripcion as descu','estudiante.first_nom as nom1','estudiante.second_nom as nom2','estudiante.firts_ape as ape1','estudiante.second_ape as ape2','estudiante.num_doc','notas.definitiva','notas.nota1','notas.nota2','notas.nota3','notas.nota4')
                ->orderby('descu','asc')
                ->get();
        return view('nivelaciones.lista')->with('re',$mat)->with('p', $p)->with('a', $a)->with('pe', $pe);
        }else{
            return redirect('/inicio');
        }
    }

    //vista archivo 
   public function verarchivo($id, $a){
    $val = DB::table('nivelaciones')->where('id_estudiante','=',$id)->count();
    $niv = 0;
    if($val != 0){
      $niv = DB::table('nivelaciones')
            ->join('estudiante','nivelaciones.id_estudiante','=','estudiante.id')
            ->join('notas','nivelaciones.id_nota','=','notas.id')
            ->join('cursos','notas.id_curso','=','cursos.id')
            ->join('asignaturas','cursos.id_asignatura','=','asignaturas.id')
            ->join('tipo_curso','cursos.id_tipo_curso','=','tipo_curso.id')
            ->join('docente','cursos.id_docente','=','docente.id')
            ->where('nivelaciones.id_estudiante','=',$id)
            ->where('cursos.anio','=',$a)
            ->select('nivelaciones.id as idniv', 'nivelaciones.descripcion', 'nivelaciones.numrecibo', 'nivelaciones.nota as notantigua',
                    'nivelaciones.imgrecibo', 'estudiante.first_nom as primernom', 'estudiante.second_nom as segnom', 'estudiante.firts_ape as primerape', 
                    'estudiante.second_ape as segape', 'notas.nota1', 'notas.nota2', 'notas.nota3', 'notas.nota4', 'notas.definitiva', 'notas.por1', 'notas.por2', 'notas.por3', 
                    'notas.por4', 'tipo_curso.descripcion as cursonom', 'asignaturas.nombre as nomasig', 'docente.nombre', 'docente.apellido', 'cursos.anio', 'cursos.periodo')
            ->get();
           
    }
    return view('nivelaciones.listarchivo')->with('niv', $niv);
   }

   //actualizar informacion recibo
   public function actualizar_recibo(Request $request){
      $recibo = Nivelacion::findOrfail($request->idniv);    
      $recibo->descripcion = $request->input('desrecibo');
      $recibo->numrecibo = $request->input('numrecibo');
      if($request->hasFile('img')){             
          $file = $request->file('img');
          $val = "recibo".time().".".$file->guessExtension();
          $ruta = public_path("dist/archivo/".$val);
         // if($file->guessExtension()=="pdf"){
          copy($file, $ruta);//ccopia el archivo de una ruta cualquiera a donde este
          $recibo->imgrecibo = $val;//ingresa el nombre de la ruta a la base de datos
         }
      $recibo->save();
      Session::flash('inf','El registro se actualizó de manera exitosa.');
      return back();
   }

   public function eliminararchivo($id){
    $elim = Nivelacion::findOrfail($id);   
    $elim->delete();
    Session::flash('inf','El registro se eliminó de manera exitosa.');
    return back();
   }
   //listado archivos
   public function listaarchi($p, $a, $pe){

    $val = DB::table('nivelaciones')->count();
    $niv = 0;
    if($val != 0){
      $niv = DB::table('nivelaciones')
            ->join('estudiante','nivelaciones.id_estudiante','=','estudiante.id')
            ->join('notas','nivelaciones.id_nota','=','notas.id')
            ->join('cursos','notas.id_curso','=','cursos.id')
            ->join('asignaturas','cursos.id_asignatura','=','asignaturas.id')
            ->join('tipo_curso','cursos.id_tipo_curso','=','tipo_curso.id')
            ->join('docente','cursos.id_docente','=','docente.id')
            ->where('cursos.id_tipo_curso','=',$p)
            ->where('cursos.anio','=',$a)
            ->where('cursos.periodo','=',$pe)
            ->select('nivelaciones.id as idniv', 'nivelaciones.descripcion', 'nivelaciones.numrecibo', 'nivelaciones.nota as notantigua',
                    'nivelaciones.imgrecibo', 'estudiante.first_nom as primernom', 'estudiante.second_nom as segnom', 'estudiante.firts_ape as primerape', 
                    'estudiante.second_ape as segape', 'notas.nota1', 'notas.nota2', 'notas.nota3', 'notas.nota4', 'notas.definitiva', 'notas.por1', 'notas.por2', 'notas.por3', 
                    'notas.por4', 'tipo_curso.descripcion as cursonom', 'asignaturas.nombre as nomasig',  'docente.nombre', 'docente.apellido', 'cursos.anio', 'cursos.periodo')
            ->get();
           
    }
    return view('nivelaciones.listarchivo')->with('niv', $niv); 

   }

   //################## funcion para estudiantes
   public function listanivestu(){
      $idlog=auth()->id();
      $validar = DB::table('estudiante')->where('id_usuario', $idlog)->select('estudiante.id as ides')->count();
    if($validar != 0){
      $est = DB::table('estudiante')->where('id_usuario', $idlog)->select('estudiante.id as ides')->first();
      $idest=$est->ides;
       //consultar datos
       $val = DB::table('nivelaciones')->where('id_estudiante','=',$idest)->count();
       $niv = 0;
       if($val != 0){
         $niv = DB::table('nivelaciones')
               ->join('estudiante','nivelaciones.id_estudiante','=','estudiante.id')
               ->join('notas','nivelaciones.id_nota','=','notas.id')
               ->join('cursos','notas.id_curso','=','cursos.id')
               ->join('asignaturas','cursos.id_asignatura','=','asignaturas.id')
               ->join('tipo_curso','cursos.id_tipo_curso','=','tipo_curso.id')
               ->join('docente','cursos.id_docente','=','docente.id')
               ->where('nivelaciones.id_estudiante','=',$idest)
               ->select('nivelaciones.id as idniv', 'nivelaciones.descripcion', 'nivelaciones.numrecibo', 'nivelaciones.nota as notantigua',
                       'nivelaciones.imgrecibo', 'estudiante.first_nom as primernom', 'estudiante.second_nom as segnom', 'estudiante.firts_ape as primerape', 
                       'estudiante.second_ape as segape', 'notas.nota1', 'notas.nota2', 'notas.nota3', 'notas.nota4', 'notas.definitiva', 'notas.por1', 'notas.por2', 'notas.por3', 
                       'notas.por4', 'tipo_curso.descripcion as cursonom', 'asignaturas.nombre as nomasig', 'docente.nombre', 'docente.apellido', 'cursos.anio', 'cursos.periodo')
               ->get();
              
       }
       $nivtec = DB::table('nivelacionestec')
                ->join('notas_tecnico','nivelacionestec.id_nota','=','notas_tecnico.id')
                ->join('estudiante','notas_tecnico.id_estudiante','=','estudiante.id')
                ->join('asignaturas_tecnicos','notas_tecnico.id_tecnicos','=','asignaturas_tecnicos.id')
                ->join('programa_tecnico','asignaturas_tecnicos.id_tecnico','=','programa_tecnico.id')
                ->join('asig_tecnicos','asignaturas_tecnicos.id_asignaturas','=','asig_tecnicos.id')
                ->join('docente','asignaturas_tecnicos.id_docente','=','docente.id')
                ->join('trimestre_tecnicos','asignaturas_tecnicos.id_trimestre','=','trimestre_tecnicos.id')
                ->where('notas_tecnico.id_estudiante','=',$idest)
                ->select('nivelacionestec.id as idniv', 'nivelacionestec.descripcion', 'nivelacionestec.numrecibo', 'nivelacionestec.nota as notantigua',
                        'nivelacionestec.imgrecibo', 'estudiante.first_nom as primernom', 'estudiante.second_nom as segnom', 'estudiante.firts_ape as primerape', 
                        'estudiante.second_ape as segape', 'notas_tecnico.nota1', 'notas_tecnico.nota2', 'notas_tecnico.nota3', 'notas_tecnico.nota4', 'notas_tecnico.definitiva', 'notas_tecnico.por1', 'notas_tecnico.por2', 'notas_tecnico.por3', 
                        'notas_tecnico.por4', 'programa_tecnico.nombretec as cursonom', 'asig_tecnicos.nombreasig as nomasig', 'docente.nombre', 'docente.apellido', 'trimestre_tecnicos.nombretri', 'asignaturas_tecnicos.anio', 'asignaturas_tecnicos.periodo')
                ->get();
       //####################
      return view('nivelaciones.listanivarchivadas')->with('niv', $niv)->with('nivtec', $nivtec);
    }else{
     return redirect('/inicio');
    }
 }

}
