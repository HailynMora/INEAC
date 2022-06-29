<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Maatwebsite\Excel\Concerns\Exportable;

use Maatwebsite\Excel\Events\AfterSheet;
use App\Models\CalificacionesModel\Notas;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

use DB;

class NotasBachiExcel implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;
    public function __construct($id, $idnota)
    {
        $this->id = $id;
        $this->idnota = $idnota;
    }

    public function view(): View
    {  
        if($this->idnota == 1){
            $res = Notas::where('notas.id_curso',  $this->id)->where('notas.definitiva', '>=', '3')
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
                    'cursos.periodo', 'notas.nota1', 'notas.nota2', 'notas.nota3', 'notas.nota4', 'notas.definitiva',
                    'notas.por1', 'notas.por2', 'notas.por3', 'notas.por4', 'desempenos.descripcion as desem')
                    ->get();

        }else{
            if($this->idnota == 2){
                $res = Notas::where('notas.id_curso',  $this->id)->where('notas.definitiva', '<', '3')
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
                        'cursos.periodo', 'notas.nota1', 'notas.nota2', 'notas.nota3', 'notas.nota4', 'notas.definitiva',
                        'notas.por1', 'notas.por2', 'notas.por3', 'notas.por4', 'desempenos.descripcion as desem')
                        ->get();
            }else{
                $res = Notas::where('notas.id_curso',  $this->id)
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
                        'cursos.periodo', 'notas.nota1', 'notas.nota2', 'notas.nota3', 'notas.nota4', 'notas.definitiva',
                        'notas.por1', 'notas.por2', 'notas.por3', 'notas.por4', 'desempenos.descripcion as desem')
                        ->get();
            }
        }
       
    
    return view('calificaciones.excelnotas')->with('res', $res);
    
    }

}
