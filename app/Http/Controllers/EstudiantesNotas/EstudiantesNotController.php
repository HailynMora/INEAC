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
        if($p==1){
            $mat= DB::table('notas')
            ->join('cursos','notas.id_curso','=','cursos.id')
            ->join('estudiante','notas.id_estudiante','=','estudiante.id')
            ->join('asignaturas','cursos.id_asignatura','=','asignaturas.id')
            ->join('docente','cursos.id_docente','=','docente.id')
            ->join('tipo_curso','cursos.id_tipo_curso','=','tipo_curso.id')
            ->where('definitiva','<','3')
            ->where('cursos.anio','=',$a)
            ->where('cursos.periodo','=',$pe)
            ->select('asignaturas.codigo as codasig','asignaturas.val_habilitacion as valor','asignaturas.nombre as nomasig','docente.nombre as nomdoc','docente.apellido as apedoc','tipo_curso.codigo as codcu','tipo_curso.descripcion as descu','estudiante.first_nom as nom1','estudiante.second_nom as nom2','estudiante.firts_ape as ape1','estudiante.second_ape as ape2','estudiante.num_doc','notas.definitiva','notas.nota1','notas.nota2','notas.nota3','notas.nota4')
            ->orderby('descu','asc')
            ->get();
            return view('nivelaciones.lista')->with('re',$mat);
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
            return view('nivelaciones.listaTec')->with('re',$mat);
        }
        
    }
    public function boletintec(Request $request){
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
                $asig = DB::table('notas_tecnico')
                    ->where('notas_tecnico.id_estudiante',$request->ides)
                    ->where('asignaturas_tecnicos.anio', '=', $request->anio)
                    ->where('asignaturas_tecnicos.periodo', '=', $request->periodo)
                    ->join('asignaturas_tecnicos','notas_tecnico.id_tecnicos','=','asignaturas_tecnicos.id')
                    ->join('desempenos','notas_tecnico.id_desempenio','=','desempenos.id')
                    ->join('asig_tecnicos','asignaturas_tecnicos.id_asignaturas','=','asig_tecnicos.id')
                    ->select('definitiva','asig_tecnicos.nombreasig','asig_tecnicos.codigoasig','desempenos.descripcion as desem','id_tecnicos')
                    ->get();
                $cur = DB::table('asignaturas_tecnicos')->join('asig_tecnicos','asignaturas_tecnicos.id_asignaturas','=','asig_tecnicos.id')->get();
        return view('tecnico.boletin')->with('estudiante',$estudiante)->with('asig',$asig);
    }
}
