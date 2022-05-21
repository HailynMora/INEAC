<?php

namespace App\Http\Controllers\Resportes;

use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Exports\EstudiantesBachiExport;
use App\Models\MatriculasModel\Matricula;
use DB;


class ReportesController extends Controller
{
    public function reporte_bachillerato($id){
        
        return Excel::download(new EstudiantesBachiExport($id), 'listado.xlsx');
    }
    public function reporte_matriculados(){
        $mat = DB::table('matriculas')
            ->join('tipo_curso', 'matriculas.id_curso', '=', 'tipo_curso.id')
            ->select('matriculas.id as idmat','matriculas.id_curso as idcur','tipo_curso.descripcion as nomcurso','tipo_curso.codigo')
            ->get();
        return view('matriculas.reporte')->with('mat',$mat);
    }
}
