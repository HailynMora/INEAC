<?php

namespace App\Http\Controllers\Resportes;

use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Exports\EstudiantesBachiExport;
use DB;


class ReportesController extends Controller
{
    public function reporte_bachillerato($id){
        
        return Excel::download(new EstudiantesBachiExport($id), 'listado.xlsx');
    }
}
