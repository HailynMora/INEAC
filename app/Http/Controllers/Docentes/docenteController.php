<?php

namespace App\Http\Controllers\Docentes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\GeneroModel\Genero;
use App\Models\TipoDocumentoModel\TipoDocumento;
use App\Models\DocenteModel\Docente;
use Illuminate\Database\Eloquent\Collection;
use App\Models\User;

class docenteController extends Controller
{
    public $documento;
    public $genero;
    public $usu;
    public function regdocente(){
        $tipodoc=TipoDocumento::all();
        $genero=Genero::all();
        $user=User::all();
        return view('docente.registro_docente')->with('tipodoc', $tipodoc)->with('genero', $genero)->with('user', $user);
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
        $doc = DB::table('docente')
        ->select('nombre','apellido','genero.descripcion as genero','fec_vinculacion','tipo_documento.descripcion','num_doc')
        ->join('genero','id_genero','=','genero.id')
        ->join('tipo_documento','id_tipo_doc','=','tipo_documento.id')
        ->get();
        $docente = json_decode($doc,true);
        $this->docente = $docente;
        return view('docente.listar_docente',["docente"=>$this->docente]);
        

    }

    public function consuldoc(){
        
    }
}
