<?php

namespace App\Exports;

use App\Models\MatriculasModel\Matricula;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

use DB;

class EstudiantesBachiExport implements FromQuery, WithHeadings, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection

    */
    use Exportable;
    public function __construct($id, $anio, $per)
    {
        $this->id = $id;
        $this->anio = $anio;
        $this->per = $per;
    }

    public function query()
    {
        return Matricula::query()->where('matriculas.id_curso', $this->id)
        ->where('matriculas.anio', $this->anio)
        ->where('matriculas.periodo', $this->per)
        ->join('estudiante', 'matriculas.id_estudiante', '=', 'estudiante.id')
        ->join('tipo_curso', 'matriculas.id_curso', '=', 'tipo_curso.id')
        ->join('aprobado', 'matriculas.id_aprobado', '=', 'aprobado.id')
        ->select('estudiante.first_nom', 'estudiante.second_nom', 'estudiante.firts_ape',
        'estudiante.second_ape', 'estudiante.num_doc', 'estudiante.telefono', 'tipo_curso.codigo', 'tipo_curso.descripcion',
        'matriculas.anio', 'matriculas.periodo', 'matriculas.fec_matricula', 'aprobado.nombre');
    }

    public function headings(): array //encabezado del excel implementar WithHeadings
    {
        return ["Primer Nombre", "Segundo Nombre", "Primer Apellido", "Segundo Apellido", "Num Documento", "Telefono", "Cod. Curso", "Programa", "Año", "Periodo", "Fecha Matricula", "Estado"];
    }

    //aplicar color al encabezado
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {

                $event->sheet->getDelegate()->getStyle('A1:L1')
                        ->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()
                        ->setARGB('F8FF28');

            },
        ];
    }
}
