<?php

namespace App\Http\Controllers\Docentes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\DocenteModel\Docente;
use Illuminate\Support\Facades\DB;

class PostDocController extends Controller
{
    
    public function searchD(Request $request){
        $results = Docente::where('nombre', 'LIKE', "%{$request->search}%")->get();
        return view('docente.resultado_consulta', compact('results'))->with(['search' => $request->search])->render();
    }
        
    public function showD(Request $request){
        $post = DB::table('docente')->where('docente.id','=',$request->id)
        ->join('tipo_documento','id_tipo_doc','=','tipo_documento.id')
        ->join('genero','id_genero','=','genero.id')
        ->join('estado','id_estado','=','estado.id')
        ->select('docente.id','docente.nombre','docente.apellido','docente.correo','docente.telefono','docente.direccion','docente.fec_vinculacion','docente.num_doc',
                'tipo_documento.descripcion','genero.descripcion as genero','estado.id as idestado','estado.descripcion as estado','docente.id_estado')
        ->get();
        return view('docente.post_doce', compact('post'))->render();
    }
}
