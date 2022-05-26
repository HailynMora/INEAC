<?php

namespace App\Exports;

use App\Models\MatriculasModel\MatriculaTec;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;


use DB;

class TecniosExcel implements  FromQuery, WithHeadings, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;
    public function __construct($idtec, $aniotec, $pertec, $trim)
    {
        $this->idtec = $idtec;
        $this->aniotec = $aniotec;
        $this->pertec = $pertec;
        $this->trim = $trim;
    }

    public function query()
    {
        return MatriculaTec::query()
                ->where('id_tecnico', $this->idtec)
                ->where('anio', $this->aniotec)
                ->where('periodo', $this->pertec)
                ->where('id_trimestre', $this->trim)
                ->join('estudiante', 'id_estudiante', '=', 'estudiante.id')
                ->join('programa_tecnico', 'id_tecnico', '=', 'programa_tecnico.id')
                ->join('aprobado', 'id_aprobado', '=', 'aprobado.id')
                ->join('trimestre_tecnicos', 'id_trimestre', '=', 'trimestre_tecnicos.id')
                ->select('estudiante.first_nom', 'estudiante.second_nom', 'estudiante.firts_ape',
                'estudiante.second_ape', 'estudiante.num_doc', 'estudiante.telefono', 'programa_tecnico.codigotec', 'programa_tecnico.nombretec',
                'anio', 'periodo', 'fec_matricula', 'trimestre_tecnicos.nombretri', 'aprobado.nombre');
    }

    public function headings(): array //encabezado del excel implementar WithHeadings
    {
        return ["Primer Nombre", "Segundo Nombre", "Primer Apellido", "Segundo Apellido", "Num Documento", "Telefono", "Cod. Programa", "Programa", "Año", "Periodo", "Trimestre", "Fecha Matricula", "Estado"];
    }

    //aplicar color al encabezado
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {

                $event->sheet->getDelegate()->getStyle('A1:M1')
                        ->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()
                        ->setARGB('F8FF28');

            },
        ];
    }
}
