<?php

namespace App\Http\Controllers\Docentes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\GeneroModel\Genero;
use App\Models\TipoDocumentoModel\TipoDocumento;
use App\Models\DocenteModel\Docente;
use Illuminate\Database\Eloquent\Collection;

class docenteController extends Controller
{
   public $documento;
   public $genero;
    public function regdocente(){
        $tipodoc=TipoDocumento::all();
        $genero=Genero::all();
        $documento = json_decode($tipodoc,true);
        $genero = json_decode($genero,true);

        $this->documento = $documento;
        $this->genero = $genero;
        return view('docente.registro_docente',["documento"=>$this->documento],["genero"=>$this->genero]);
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
        $category->id_usuario = $request->input('id_usuario');
        $category->id_tipo_doc = $request->input('tipodoc');
        $category->id_genero = $request->input('tipogen');
        $category->save();
        return back();
    }
    public $docente;
    public function listado_docente(){
        $doc=DB::table('docente')
        ->join('genero','id_genero','=','genero.id')
        ->join('tipo_documento','id_tipo_doc','=','tipo_documento.id')
        ->get();
       // $docente = json_decode($doc,true);
       // $this->docente = $docente;
        return view('docente.listar_docente')->with('doc', $doc);
        

    }
}
