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
use App\Models\MatriculasModel\MatriculaTec;
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
        $asi = DB::table('asig_tecnicos')
                ->join('asignaturas_tecnicos','asig_tecnicos.id','=','asignaturas_tecnicos.id_asignaturas')
                ->join('programa_tecnico','asignaturas_tecnicos.id_tecnico','programa_tecnico.id')
        ->select('asig_tecnicos.id as ida', 'asig_tecnicos.nombreasig','asignaturas_tecnicos.id_tecnico as idte')->get();
        return view('matriculas.reporte')->with('mat', $mat)->with('matec', $matec)->with('res', $res)->with('resanio', $resanio)->with('trimestre', $trimestre)->with('asig', $asig)->with('asi',$asi);
    }
    
    public function filtrar(Request $request){
           $id = $request->idc;
           $per =  $request->periodo;
           $anio =  $request->anio;
            return Excel::download(new EstudiantesBachiExport($id, $anio, $per), 'listado.xlsx');
    }

    public function notasSec(Request $request){
        $idcur = $request->idcur;
        $per =  $request->pernot;
        $anio =  $request->anionot;
        $asig =  $request->asig;
         return Excel::download(new NotasCurso($idcur, $anio, $per, $asig), 'listado_notas.xlsx');
   }
   public function notasTec(Request $request){
        $idtec = $request->idtec;
        $per =  $request->pernot;
        $anio =  $request->anionot;
        $asig =  $request->asig;
         return Excel::download(new NotasCurso($idcur, $anio, $per, $asig), 'listado_notas.xlsx');
   }

    public function filtrartec(Request $request){
        $idtec = $request->idtecni;
        $pertec = $request->periodo;
        $aniotec =$request->anio; 
        $trim = $request->tri;
        return Excel::download(new TecniosExcel($idtec, $aniotec, $pertec, $trim), 'listado_tecnicos.xlsx');

    }

    public function excelNotas(Request $request){
         $id = $request->idcurso;
         $idnota = $request->idexcel;
         return Excel::download(new NotasBachiExcel($id, $idnota), 'listado_notas_bach.xlsx');
     }


     public function  exNotasTecnico(Request $request){
        $id = $request->idcurso;
        $idnota = $request->idexcel;
        return Excel::download(new NotasTecnicoExcel($id, $idnota), 'listado_notas_tecnico.xlsx');
    }
    
    public function listadoEsTec(Request $request){
       
        $datos = MatriculaTec::where('id_tecnico', $request->cursoba)
                    ->where('anio', $request->anio)
                    ->where('periodo', $request->periodo)
                    ->where('id_trimestre', $request->trim)
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
                     'tipo.descripcion as tdocacu', )
                    ->paginate(10);
                   
        return view('docente.vistaListadoEsTecnicos')->with('datos', $datos);
    }

    public function nivelTecnicos(Request $request){

        $p= $request->programa;
        $a =$request->anio;
        $pe = $request->periodo;
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
            ->select('asig_tecnicos.val_habilitacion as valor','asig_tecnicos.nombreasig as nomasig',
                      'docente.nombre as nomdoc','docente.apellido as apedoc','programa_tecnico.nombretec as descu',
                      'estudiante.first_nom as nom1','estudiante.second_nom as nom2','estudiante.firts_ape as ape1',
                      'estudiante.second_ape as ape2','estudiante.num_doc','notas_tecnico.definitiva','notas_tecnico.nota1',
                      'notas_tecnico.nota2','notas_tecnico.nota3','notas_tecnico.nota4','trimestre_tecnicos.nombretri')
            ->orderby('descu','asc')
            ->get();
            return view('nivelaciones.listaTec')->with('re',$mat);

    }
    
}
