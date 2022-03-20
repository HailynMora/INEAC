<?php

namespace App\Http\Controllers\Estudiantes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\GeneroModel\Genero;
use App\Models\ParentescoModel\Parentesco;
use App\Models\TipoDocumentoModel\TipoDocumento;
use App\Models\ParentescoModel\Acudiente;

class EstudiantesController extends Controller
{
    public function registro(){
        return view('estudiantes.registroestu');
    }

    public function regisacudiente(){
        $tipodoc=TipoDocumento::all();
        $paren=Parentesco::all();
        $genero=Genero::all();
        return view('estudiantes.acudiente')->with('tipodoc', $tipodoc)->with('paren', $paren)->with('genero', $genero);
    }

    public function datos(Request $request){
        $category = new Acudiente();
        $category->nombre = $request->input('nombre');
        $category->apellido = $request->input('apellido');
        $category->direccion = $request->input('direccion');
        $category->telefono = $request->input('telefono');
        $category->num_doc = $request->input('numerodoc');
        $category->id_parentesco = $request->input('parentesco');
        $category->id_tipo_doc = $request->input('tipodoc');
        $category->id_genero = $request->input('genero');
        $category->save();
        return back();
    }
}