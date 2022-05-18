<?php

namespace App\Exports;

use App\Models\MatriculasModel\Matricula;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

use DB;

class EstudiantesBachiExport implements FromQuery
{
    /**
    * @return \Illuminate\Support\Collection

    */
    use Exportable;
    public function __construct($id)
    {
        $this->id = $id;
    }

    public function query()
    {
        return Matricula::query()->where('matriculas.id_curso', $this->id)->join('estudiante', 'matriculas.id_estudiante', '=', 'estudiante.id')
        ->join('tipo_curso', 'matriculas.id_curso', '=', 'tipo_curso.id')
        ->join('aprobado', 'matriculas.id_aprobado', '=', 'aprobado.id')
        ->select('matriculas.id', 'estudiante.first_nom', 'estudiante.second_nom', 'estudiante.firts_ape',
        'estudiante.second_ape', 'estudiante.num_doc', 'estudiante.telefono', 'tipo_curso.codigo', 'tipo_curso.descripcion',
        'matriculas.anio', 'matriculas.periodo', 'matriculas.fec_matricula', 'aprobado.nombre');
    }
}
