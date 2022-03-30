<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EstudianteModel\Estudiante;
use Illuminate\Support\Facades\DB;


class PostController extends Controller
{
    public function search(Request $request){
        $results = Estudiante::where('nombre', 'LIKE', "%{$request->search}%")->get();
        return view('estudiantes.results', compact('results'))->with(['search' => $request->search])->render();
    }
        
    public function show(Request $request){
        $post = DB::table('estudiante')->where('estudiante.id', '=', $request->id)
                ->join('etnia', 'id_etnia', '=', 'etnia.id')
                ->select('estudiante.id', 'estudiante.nombre', 'estudiante.apellido', 'estudiante.direccion',
                'estudiante.telefono', 'estudiante.num_doc', 'etnia.descripcion')->get();
        return view('estudiantes.post', compact('post'))->render();
    }

}
