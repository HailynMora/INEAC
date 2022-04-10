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
        $post=DB::table('estudiante')->where('estudiante.id', '=', $request->id)
        ->join('estado', 'id_estado', '=', 'estado.id')
        ->join('tipo_documento', 'id_tipo_doc', '=', 'tipo_documento.id')
        ->join('genero', 'id_genero', '=', 'genero.id')
        ->join('etnia', 'id_etnia', '=', 'etnia.id')
        ->join('users', 'id_usuario', '=', 'users.id')
        ->join('acudiente', 'estudiante.id_acudiente', '=', 'acudiente.id')
        ->join('parentezco', 'acudiente.id_parentesco', '=', 'parentezco.id')
        ->select('estudiante.id', 'estudiante.nombre', 'estudiante.apellido', 'estudiante.direccion', 'estudiante.telefono',
        'estudiante.num_doc', 'estudiante.estrato', 'estudiante.correo', 'estado.descripcion as estadoes', 'tipo_documento.descripcion as tdoces',
        'genero.descripcion as generoestu', 'etnia.descripcion as etniaestu', 'users.name as usuestu', 'acudiente.nombre as nomacu', 'acudiente.apellido as apeacu', 'parentezco.descripcion as paren')
        ->get();
        return view('estudiantes.post', compact('post'))->render();
    }

}
