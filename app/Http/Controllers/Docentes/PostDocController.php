<?php

namespace App\Http\Controllers\Docentes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\DocenteModel\Docente;

class PostDocController extends Controller
{
    
    public function searchD(Request $request){
        $results = Docente::where('nombre', 'LIKE', "%{$request->search}%")->get();
        return view('docente.resultado_consulta', compact('results'))->with(['search' => $request->search])->render();
    }
        
    public function showD(Request $request){
        $post = Docente::findOrFail($request->id);
        return view('docente.post_doce', compact('post'))->render();
    }
}
