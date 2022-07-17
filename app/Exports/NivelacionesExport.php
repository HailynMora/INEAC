<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use DB;

class NivelacionesExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($docc, $anio, $periodo,$programa)
    {
        $this->docc = $docc;
        $this->anio = $anio;
        $this->periodo = $periodo;
        $this->programa = $programa;
    }
    public function view(): View{
        if ($this->programa==1) {
                $res = DB::table('cursos')
                ->where('cursos.id_docente','=',$this->docc)
                ->where('cursos.anio','=',$this->anio)
                ->where('cursos.periodo','=',$this->periodo)
                ->where('notas.definitiva','<',3)
                ->join('tipo_curso','cursos.id_tipo_curso','=','tipo_curso.id')
                ->join('asignaturas','cursos.id_asignatura','=','asignaturas.id')
                ->join('notas','cursos.id','=','notas.id_curso')
                ->join('estudiante','notas.id_estudiante','=','estudiante.id')
                ->join('tipo_documento','estudiante.id_tipo_doc','=','tipo_documento.id')
                ->join('docente','cursos.id_docente','=','docente.id')
                ->select('cursos.id as idcur','asignaturas.id as idas','cursos.id_docente as idoc','tipo_curso.descripcion as nomcur','asignaturas.nombre as nomasig','asignaturas.val_habilitacion as valor','notas.definitiva','notas.nota1','notas.nota2','notas.nota3','notas.nota4','notas.por1','notas.por2','notas.por3','notas.por4','estudiante.first_nom as nom1','estudiante.second_nom as nom2','estudiante.firts_ape as ape1','estudiante.second_ape as ape2','estudiante.num_doc','tipo_documento.descripcion as tipodoc','docente.nombre as nomdoc','docente.apellido as apedoc')
                ->get();
                return view('nivelaciones.listanive')->with('res', $res);
        }else{
                $res = DB::table('asignaturas_tecnicos')
                ->where('asignaturas_tecnicos.id_docente','=',$this->docc)
                ->where('asignaturas_tecnicos.anio','=',$this->anio)
                ->where('asignaturas_tecnicos.periodo','=',$this->periodo)
                ->where('notas_tecnico.definitiva','<',3)
                ->join('notas_tecnico','asignaturas_tecnicos.id','=','notas_tecnico.id')
                ->join('programa_tecnico','asignaturas_tecnicos.id_tecnico','=','programa_tecnico.id')
                ->join('asig_tecnicos','asignaturas_tecnicos.id_asignaturas','asig_tecnicos.id')
                ->join('trimestre_tecnicos','asignaturas_tecnicos.id_trimestre','trimestre_tecnicos.id')
                ->join('estudiante','notas_tecnico.id_estudiante','=','estudiante.id')
                ->join('tipo_documento','estudiante.id_tipo_doc','=','tipo_documento.id')
                ->join('docente','asignaturas_tecnicos.id_docente','=','docente.id')
                ->select('asignaturas_tecnicos.anio','asignaturas_tecnicos.periodo','asignaturas_tecnicos.id as idcur','asig_tecnicos.id as idas','asignaturas_tecnicos.id_docente as idoc','programa_tecnico.nombretec','asig_tecnicos.nombreasig as nomasig','asig_tecnicos.val_habilitacion as valor','notas_tecnico.definitiva','estudiante.first_nom as nom1','estudiante.second_nom as nom2','estudiante.firts_ape as ape1','estudiante.second_ape as ape2','estudiante.num_doc','tipo_documento.descripcion as tipodoc','notas_tecnico.nota1','notas_tecnico.nota2','notas_tecnico.nota3','notas_tecnico.nota4','notas_tecnico.por1','notas_tecnico.por2','notas_tecnico.por3','notas_tecnico.por4','trimestre_tecnicos.nombretri','docente.nombre as nomdoc','docente.apellido as apedoc')
                ->get(); 
                return view('nivelaciones.listanivetec')->with('res', $res);
        }
    }
}
