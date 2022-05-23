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
        $mat = DB::table('tipo_curso')
            ->select('tipo_curso.id as idcur','tipo_curso.descripcion as nomcurso','tipo_curso.codigo')
            ->get();
        $matec = DB::table('programa_tecnico')
        ->select('id','codigotec','nombretec')
        ->get();
        return view('matriculas.reporte')->with('mat',$mat)->with('matec',$matec);
    }
}
