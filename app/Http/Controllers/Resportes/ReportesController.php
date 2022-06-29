<?php

namespace App\Http\Controllers\Resportes;

use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Exports\EstudiantesBachiExport;
use App\Exports\TecniosExcel;
use App\Models\MatriculasModel\Matricula;
use App\Exports\NotasBachiExcel;
use DB;


class ReportesController extends Controller
{
    public function reporte_bachillerato($id){
        
       // 
    }
    public function reporte_matriculados(){
        $mat = DB::table('matriculas')
                 ->join('tipo_curso', 'matriculas.id_curso', '=', 'tipo_curso.id')
                 ->select('matriculas.id_curso as idcur', 'tipo_curso.codigo', 'tipo_curso.descripcion as nomcurso')->distinct()->get();
       
        $matec = DB::table('matricula_tecnico')
                    ->join('programa_tecnico', 'matricula_tecnico.id_tecnico', '=', 'programa_tecnico.id')
                    ->select('matricula_tecnico.id_tecnico as idtec','programa_tecnico.codigotec','programa_tecnico.nombretec')
                    ->distinct()
                    ->get();
        $res =DB::table('matriculas')->select('matriculas.anio')->distinct()->get();
        $resanio =DB::table('matricula_tecnico')->select('matricula_tecnico.anio')->distinct()->get();
        //consultar el trimestre
        $trimestre =DB::table('trimestre_tecnicos')->select('trimestre_tecnicos.id', 'trimestre_tecnicos.nombretri as nombre')->get();
        return view('matriculas.reporte')->with('mat', $mat)->with('matec', $matec)->with('res', $res)->with('resanio', $resanio)->with('trimestre', $trimestre);
    }
    
    public function filtrar(Request $request){
           $id = $request->idc;
           $per =  $request->periodo;
           $anio =  $request->anio;
              return Excel::download(new EstudiantesBachiExport($id, $anio, $per), 'listado.xlsx');
    }

    public function filtrartec(Request $request){
        $idtec = $request->idtecni;
        $pertec = $request->periodo;
        $aniotec =$request->anio; 
        $trim = $request->tri;
        return Excel::download(new TecniosExcel($idtec, $aniotec, $pertec, $trim), 'listado_tecnicos.xlsx');

    }

    public function excelNotas(Request $request){
         $id = $request->idcurso;
         $idnota = $request->idexcel;
         return Excel::download(new NotasBachiExcel($id, $idnota), 'listado_notas_bach.xlsx');
     }
}
