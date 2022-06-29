<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use DB;

class NotasTecnicoExcel implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($id, $idnota)
    {
        $this->id = $id;
        $this->idnota = $idnota;
    }

   
    public function view(): View
        {  
            if($this->idnota == 1){
               
                $res = DB::table('notas_tecnico')->where('notas_tecnico.id_tecnicos','=', $this->id)
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
                if($this->idnota == 2){
                    $res = DB::table('notas_tecnico')->where('notas_tecnico.id_tecnicos','=', $this->id)
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
                        $res = DB::table('notas_tecnico')->where('notas_tecnico.id_tecnicos','=', $this->id)
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
           
          return view('calificaciones.excelnotastec')->with('res', $res);
        
        }
    
}
