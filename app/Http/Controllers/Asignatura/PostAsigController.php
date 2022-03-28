<?php

namespace App\Http\Controllers\Asignatura;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AsignaturaModel\Asignatura;

class PostAsigController extends Controller
{
    public function search(Request $request){
        $results = Asignatura::where('nombre', 'LIKE', "%{$request->search}%")->get();
        return view('asignatura.resultado_asig', compact('results'))->with(['search' => $request->search])->render();
    }
        
    public function show(Request $request){
        $post = Asignatura::findOrFail($request->id);
        return view('asignatura.post_asig', compact('post'))->render();
    }
}
