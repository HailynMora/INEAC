<?php

namespace App\Http\Controllers\Asignatura;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AsignaturaModel\Asignatura;
use Illuminate\Support\Facades\DB;
use App\Models\EstadoModel\Estado;

class PostAsigController extends Controller
{
    public function search(Request $request){
        $results = Asignatura::where('nombre', 'LIKE', "%{$request->search}%")->get();
        return view('asignatura.resultado_asig', compact('results'))->with(['search' => $request->search])->render();
    }
        
    public function show(Request $request){
        $estado=Estado::all();
        $post=DB::table('asignaturas')
        ->where('asignaturas.id','=',$request->id)
        ->select('asignaturas.id','asignaturas.codigo','asignaturas.nombre as asig','intensidad_horaria','val_habilitacion','estado.descripcion as estado','asignaturas.id_estado')
        ->join('estado','id_estado','=','estado.id')
        ->get();
        return view('asignatura.post_asig', compact('post','estado'))->render();
    }
}
