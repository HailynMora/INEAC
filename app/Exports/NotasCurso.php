<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\CalificacionesModel\Notas;
use DB;

class NotasCurso implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($idcur, $anio, $per)
    {
        $this->idcur = $idcur;
        $this->anio = $anio;
        $this->per = $per;
    }

   
    public function view(): View
        {  
            $res = Notas::join('cursos','notas.id_curso', '=', 'cursos.id')
            ->join('asignaturas','cursos.id_asignatura', '=', 'asignaturas.id')
            ->join('tipo_curso','cursos.id_tipo_curso', '=', 'tipo_curso.id')
            ->join('docente','cursos.id_docente', '=', 'docente.id')
            ->join('estudiante','notas.id_estudiante', '=', 'estudiante.id')
            ->join('desempenos','notas.id_desempenio', '=', 'desempenos.id')
            ->where('cursos.id_tipo_curso', '=', $this->idcur)
            ->where('cursos.anio', '=', $this->anio)
            ->where('cursos.periodo', '=', $this->per)
            ->select('estudiante.first_nom as nomes', 'estudiante.second_nom as segnom', 
                    'estudiante.firts_ape as apes', 'estudiante.second_ape as sedape', 
                    'asignaturas.nombre as asignatura', 'tipo_curso.descripcion as curso', 
                    'docente.nombre as nomdoc', 'docente.apellido as apedoc', 'cursos.anio', 
                    'cursos.periodo', 'notas.nota1', 'notas.nota2', 'notas.nota3', 'notas.nota4', 'notas.definitiva',
                    'notas.por1', 'notas.por2', 'notas.por3', 'notas.por4', 'desempenos.descripcion as desem')
                    ->get();

          return view('calificaciones.notasbachi')->with('res', $res);
        
        }
    
}
