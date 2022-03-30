<?php

namespace App\Http\Controllers\Docentes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\GeneroModel\Genero;
use App\Models\TipoDocumentoModel\TipoDocumento;
use App\Models\DocenteModel\Docente;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Session;
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
        $cor = $request->input('correo');
        $doc = $request->input('numerodoc');
        $res1 = DB::table('docente')->where('num_doc','=',$doc)->count();
        $res2 = DB::table('docente')->where('correo','=',$cor)->count();
        if($res1!=0 && $res2!=0){
            return \Response::json([
                'error' => 'Error datos'
            ],422);
        }
        else{
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
        
       
    }
    public $docente;
    public function listado_docente(){
        $doc=DB::table('docente')
        ->join('tipo_documento','id_tipo_doc','=','tipo_documento.id')
        ->join('genero','id_genero','=','genero.id')
        ->select('docente.id as id',
        'docente.nombre',
        'apellido',
        'num_doc',
        'fec_vinculacion',
        'correo',
        'telefono',
        'direccion',
        'genero.descripcion as genero',
        'tipo_documento.descripcion as tipo', 'docente.id_tipo_doc')
        ->get();
        $docente = json_decode($doc,true);
        $this->docente = $docente;
        return view('docente.listar_docente',["docente"=>$this->docente]);
    }

    public function form_actualizar($id){
            $doc = DB::table('docente')->where('docente.id', '=', $id)
            ->join('tipo_documento','docente.id_tipo_doc','=','tipo_documento.id')
            ->join('genero','docente.id_genero','=','genero.id')
            ->join('users','docente.id_usuario','=','users.id')
            ->select('docente.id as iddoc','docente.nombre', 'docente.apellido', 'docente.direccion', 'docente.telefono', 'docente.correo', 
            'docente.num_doc', 'docente.fec_vinculacion', 'docente.id_usuario', 'docente.id_tipo_doc', 'tipo_documento.descripcion as desdoc',  'docente.id_genero',
            'genero.descripcion as gendoc', 'users.name')
            ->get();
            //return $doc;
            $tipo_doc=TipoDocumento::all();
            $gen=Genero::all();
            $u=User::all();
        
        return view('docente.modal_actualizar', compact('doc','tipo_doc','gen','u'));
    }
    
    public function actualizar_docente(Request $request,$id){
        $docente = Docente::FindOrFail($id);
        $docente->nombre = $request->input('nombre');
        $docente->apellido = $request->input('apellido');
        $docente->direccion = $request->input('direccion');
        $docente->telefono = $request->input('telefono');
        $docente->correo = $request->input('correo');
        $docente->num_doc = $request->input('numerodoc');
        $docente->fec_vinculacion = $request->input('fec_vinculacion');
        $docente->id_usuario = $request->input('id_usuario');
        $docente->id_tipo_doc = $request->input('tipodoc');
        $docente->id_genero = $request->input('tipogen');
        $docente->save();
        return redirect('/docente/listado_docente');

    }
}
