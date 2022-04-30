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
use App\Models\EstadoModel\Estado;
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
        $estado=Estado::all();
        return view('docente.registro_docente')->with('tipodoc', $tipodoc)->with('genero', $genero)->with('user', $user)->with('estado',$estado);
    }

   

    public function datosdoc(Request $request){
        $cor = $request->input('correo');
        $doc = $request->input('numerodoc');
        $res1 = DB::table('docente')->where('num_doc','=',$doc)->count();
        $res2 = DB::table('docente')->where('correo','=',$cor)->count();
        if($res1!=0){
            return \Response::json([
                'error' => 'Error datos'
            ],422);
        }
        else{
            if($res2!=0){
                return \Response::json([
                    'error' => 'Error datos'
                ],423);
            }else{
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
                $category->id_estado = $request->input('estado');
                $category->save();
                return back();
            }
            
        }
        return back(); 
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
                    'tipo_documento.descripcion',
                    'estado.descripcion as estado')
            ->join('tipo_documento','id_tipo_doc','=','tipo_documento.id')
            ->join('genero','id_genero','=','genero.id')
            ->join('estado','id_estado','=','estado.id')
            ->paginate(5);
            }else{
                $b=0;
                $doc=0;
                
            }
        
        $condoc= DB::table('asig_asignaturas')->join('asignaturas','asig_asignaturas.id_asignaturas','=','asignaturas.id')
        ->get();
        ///////////////////////////////////////////
        //////////////////////////////////////////
        return view('docente.listar_docente')->with('condoc',$condoc)->with('b',$b)->with('doc',$doc);
    }

    public function listar_asig($id){
        $doc = DB::table('docente')
            ->select('asignaturas.nombre as asig','asignaturas.codigo','tipo_curso.nombre')
            ->join('asig_asignaturas','docente.id','=','asig_asignaturas.id_docente')
            ->join('asig_asignatura','asignaturas.id','=','asig_asignatura.id_asignatura')
            ->where('asig_asignatura.id_docente','=',$id)
            ->get();
    
        return view('docente.lista')->with('doc',$doc);
    }


    public function form_actualizar($id){
        
            $asig = DB::table('docente')
                ->join('asig_asignaturas','docente.id','=','asig_asignaturas.id_docente')
                ->where('asig_asignaturas.id_docente','=', $id)
                ->count();
            if($asig!=0){
                $doc = DB::table('docente')->where('docente.id', '=', $id, 'and', 'asig_asignaturas.id_docente','=', $id)
                ->join('estado','docente.id_estado','=','estado.id')
                ->join('tipo_documento','docente.id_tipo_doc','=','tipo_documento.id')
                ->join('genero','docente.id_genero','=','genero.id')
                ->join('users','docente.id_usuario','=','users.id')
                ->join('asig_asignaturas','docente.id','=','asig_asignaturas.id_docente')
                ->join('asignaturas','asig_asignaturas.id_asignaturas','=','asignaturas.id')
                ->select('docente.id as iddoc','docente.nombre', 'docente.apellido', 'docente.direccion', 'docente.telefono', 'docente.correo', 
                'docente.num_doc', 'docente.fec_vinculacion', 'docente.id_usuario', 'docente.id_tipo_doc', 'tipo_documento.descripcion as desdoc',  'docente.id_genero',
                'genero.descripcion as gendoc', 'users.name','asignaturas.codigo as cod','asignaturas.nombre as asig','estado.id as idestado','estado.descripcion as estado','docente.id_estado')
                ->get();
                $tipo_doc=TipoDocumento::all();
                $gen=Genero::all();
                $u=User::all();
                $es=Estado::all();
                $b=1;
                return view('docente.modal_actualizar', compact('doc','tipo_doc','gen','u','b','es'));
            }else{
                $doc = DB::table('docente')->where('docente.id', '=', $id)
                ->join('estado','docente.id_estado','=','estado.id')
                ->join('tipo_documento','docente.id_tipo_doc','=','tipo_documento.id')
                ->join('genero','docente.id_genero','=','genero.id')
                ->join('users','docente.id_usuario','=','users.id')
                ->select('docente.id as iddoc','docente.nombre', 'docente.apellido', 'docente.direccion', 'docente.telefono', 'docente.correo', 
                'docente.num_doc', 'docente.fec_vinculacion', 'docente.id_usuario', 'docente.id_tipo_doc', 'tipo_documento.descripcion as desdoc',  'docente.id_genero',
                'genero.descripcion as gendoc', 'users.name','estado.id as idestado','estado.descripcion as estado','docente.id_estado')
                ->get();
                //return $doc;
                $tipo_doc=TipoDocumento::all();
                $gen=Genero::all();
                $u=User::all();
                $es=Estado::all();
                $b=0;
                return view('docente.modal_actualizar', compact('doc','tipo_doc','gen','u','b','es'));
            }
            
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
    public function cambiar_estado($id){
        $doces= docente::find($id);
        $es = $doces->id_estado;
        if($es==2){
            $doces->id_estado = 1;
            $doces->save();
        }else{
            $doces->id_estado = 2;
            $doces->save();
        }        
        return redirect('/docente/listado_docente');
    }

    //////////////////buscar docente////////////////////////
    public function busquedares(Request $request){
        $busdocente =  $doc=DB::table('docente')->where('docente.nombre', $request->nombre)
                        ->join('tipo_documento','id_tipo_doc','=','tipo_documento.id')
                        ->join('genero','id_genero','=','genero.id')
                        ->join('estado','id_estado','=','estado.id')
                        ->select('docente.id as id',
                        'docente.nombre',
                        'apellido',
                        'num_doc',
                        'fec_vinculacion',
                        'correo',
                        'telefono',
                        'direccion',
                        'genero.descripcion as genero',
                        'tipo_documento.descripcion',
                        'estado.descripcion as estado')
                        ->get();
     return response(json_decode($busdocente,JSON_UNESCAPED_UNICODE),200)->header('Content-type', 'text/plain');
    }
    ////////////////////////////////////////
}
