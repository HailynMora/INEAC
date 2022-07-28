<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\CalificacionesModel\NotasTecnico;
use DB;

class NotasTec implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($idtec, $anio, $per, $asig)
    {
        $this->idtec = $idtec;
        $this->anio = $anio;
        $this->per = $per;
        $this->asig = $asig;
    }

   
    public function view(): View
        {  
            $res = NotasTecnico::join('asignaturas_tecnicos','notas_tecnico.id_tecnicos', '=', 'asignaturas_tecnicos.id')
            ->join('asig_tecnicos','asignaturas_tecnicos.id_asignaturas', '=', 'asig_tecnicos.id')
            ->join('programa_tecnico','asignaturas_tecnicos.id_tecnico', '=', 'programa_tecnico.id')
            ->join('trimestre_tecnicos','asignaturas_tecnicos.id_trimestre','=','trimestre_tecnicos.id')
            ->join('docente','asignaturas_tecnicos.id_docente', '=', 'docente.id')
            ->join('estudiante','notas_tecnico.id_estudiante', '=', 'estudiante.id')
            ->join('desempenos','notas_tecnico.id_desempenio', '=', 'desempenos.id')
            ->where('asignaturas_tecnicos.id_tecnico', '=', $this->idtec)
            ->where('asignaturas_tecnicos.anio', '=', $this->anio)
            ->where('asignaturas_tecnicos.id_asignaturas', '=', $this->asig)
            ->select('estudiante.first_nom as nomes', 'estudiante.second_nom as segnom', 
                    'estudiante.firts_ape as apes', 'estudiante.second_ape as sedape', 
                    'asig_tecnicos.nombreasig as asignatura', 'programa_tecnico.nombretec as curso', 
                    'docente.nombre as nomdoc', 'docente.apellido as apedoc', 'asignaturas_tecnicos.anio', 
                    'asignaturas_tecnicos.periodo', 'notas_tecnico.nota1', 'notas_tecnico.nota2', 'notas_tecnico.nota3', 'notas_tecnico.nota4', 'notas_tecnico.definitiva',
                    'notas_tecnico.por1', 'notas_tecnico.por2', 'notas_tecnico.por3', 'notas_tecnico.por4', 'desempenos.descripcion as desem','trimestre_tecnicos.nombretri')
                    ->get();

          return view('calificaciones.notastec')->with('res', $res);
        
        }
    
}
