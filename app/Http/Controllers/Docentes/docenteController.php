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
        $tipodoc=TipoDocumento::orderBy('id')->paginate(10);
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
        $res = DB::table('docente')->count();
        if($res!=0){
            $b=1;
            $doc=DB::table('docente')
            ->select('docente.id as id',
                    'docente.nombre',
                    'apellido',
                    'num_doc',
                    'fec_vinculacion',
                    'correo',
                    'telefono',
                    'direccion',
                    'genero.descripcion as genero',
                    'tipo_documento.descripcion')
            ->join('tipo_documento','id_tipo_doc','=','tipo_documento.id')
            ->join('genero','id_genero','=','genero.id')
            ->get();
        }else{
            $b=0;
            $doc=0;
             
        }
        
        $docente = json_decode($doc,true);
        $this->docente = $docente;
        return view('docente.listar_docente',["docente"=>$this->docente],['b'=>$b]);
    }

    public function listar($id){
        $res = Docente::FindOrFail($id);
        $r = json_decode($res,true);
        $this->r = $r;
        return view('docente.lista',["r"=>$this->r]);
    }
    public function listar_asig($id){
        $doc = DB::table('docente')
            ->select('asignaturas.nombre as asig','asignaturas.codigo')
            ->join('asig_asignaturas','docente.id','=','asig_asignaturas.id_docente')
            ->join('asig_asignatura','asignaturas.id','=','asig_asignatura.id_asignatura')
            ->where('asig_asignatura.id_docente','=',$id)
            ->get();
            return $doc;
        return view('docente.lista')->with('doc',$doc);
    }


    public function form_actualizar($id){
        $doc = Docente::findOrFail($id);
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
