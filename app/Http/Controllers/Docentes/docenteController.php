<?php

namespace App\Http\Controllers\Docentes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\GeneroModel\Genero;
use App\Models\ParentescoModel\Parentesco;
use App\Models\TipoDocumentoModel\TipoDocumento;
use App\Models\DocenteModel\Docente;

class docenteController extends Controller
{
    public function registro_docente(){
        return view('docente.registro_docente');

    }

    public function regdocente(){
        $tipodoc=TipoDocumento::all();
        $genero=Genero::all();
        return view('docente.registro_docente')->with('tipodoc', $tipodoc)->with('genero', $genero);
    }

    public function datosdoc(Request $request){
        $category = new Docente();
        $category->nombre = $request->input('nombre');
        $category->apellido = $request->input('apellido');
        $category->direccion = $request->input('direccion');
        $category->telefono = $request->input('telefono');
        $category->correo = $request->input('correo');
        $category->num_doc = $request->input('numerodoc');
        $category->fec_vinculacion = $request->input('fec_vinculacion');
        $category->id_usuario = $request->input('usuario');
        $category->id_tipo_doc = $request->input('tipodoc');
        $category->id_genero = $request->input('genero');
        $category->save();
        return back();
    }


    public function listado_docente(){
        return view('docente.listar_docente');

    }
}
