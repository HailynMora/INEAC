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
use Illuminate\Support\Facades\Hash;
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
        //consultar el id del rol
        $idrol = DB::table('roles')->where('roles.descripcion', 'like', 'Docente')->select('roles.id')->first();
        //end id del rol
        $cor = $request->input('correo');
        $doc = $request->input('numerodoc');
        $res1 = DB::table('docente')->where('num_doc','=',$doc)->count();
        $res2 = DB::table('docente')->where('correo','=',$cor)->count();

        //crear usuario 
        $usu = new User();
        $usu->name = $request->input('nombre');
        $usu->email = $request->input('email');
        $usu->password = Hash::make($request->pass);
        $usu->estado = 1;
        $usu->id_rol = $idrol->id;
        $usu->save();
        /*
        'email' => $request->email,
        'id_rol' => $es->idest,
        'password' => Hash::make($request->password),*/
        //end crear usuario
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
                $category->id_usuario = $usu->id;//aqui se guarda la id del usuario
                $category->id_tipo_doc = $request->input('tipodoc');
                $category->id_genero = $request->input('tipogen');
                $category->id_estado = $request->input('estado');
                $category->save();
                return back();
            }
            
        }
        return back(); 
    }

    //public $docente;

    public function listado_docente(){

        $res = DB::table('docente')->count();
        if($res!=0){
            $b=1;
            $doc = DB::table('docente')
                    ->join('tipo_documento','docente.id_tipo_doc','=','tipo_documento.id')
                    ->join('genero','docente.id_genero','=','genero.id')
                    ->join('estado','docente.id_estado','=','estado.id')
                    ->select('docente.id as id', 'docente.nombre', 'apellido', 'num_doc', 'fec_vinculacion',
                            'correo', 'telefono', 'direccion', 'genero.descripcion as genero', 'tipo_documento.descripcion',
                            'estado.descripcion as estado')
                    
                    ->distinct()
                    ->get();

            }else{
                $b=0;
                $doc=0;
                
            }
            
            $contar =DB::table('cursos')->count();
            if($contar!=0){
                for($i=0; $i<count($doc); ++$i){
                    $condoc[$i]= DB::table('cursos')->join('asignaturas','cursos.id_asignatura','=','asignaturas.id')
                                ->join('tipo_curso', 'cursos.id_tipo_curso', '=', 'tipo_curso.id')
                                ->where('cursos.id_docente', '=', $doc[$i]->id)
                                ->select('asignaturas.nombre as asig', 'tipo_curso.descripcion as cur', 'id_docente', 'asignaturas.intensidad_horaria as horas', 'asignaturas.codigo as cod')
                                ->distinct()
                                ->get();
                }
            }else{
                $condoc[0]=0;
            }
            
        ///////////////////////////////////////////
        //////////////////////////////////////////
        return view('docente.listar_docente')->with('condoc',$condoc)->with('b',$b)->with('doc',$doc);
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
                //$u=User::all();
                $es=Estado::all();
                $b=1;
                return view('docente.modal_actualizar', compact('doc','tipo_doc','gen','b','es'));
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
                // $u=User::all();
                $es=Estado::all();
                $b=0;
                return view('docente.modal_actualizar', compact('doc','tipo_doc','gen','b','es'));
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
        $bus = DB::table('docente')->where('docente.num_doc', $request->nombre)->get();
        $idoc = $bus[0]->id;
        $val = DB::table('docente')->where('docente.num_doc', $request->nombre)->count();
        if($val==0){//validacion con ajax
            $busdocente=[];
            $datos=[];
            return response()->json(['busdocente' => $busdocente, 'datos' => $datos]);
        }else{
            $busdocente = DB::table('docente')
            ->join('tipo_documento','docente.id_tipo_doc','=','tipo_documento.id')
            ->join('genero','docente.id_genero','=','genero.id')
            ->join('estado','docente.id_estado','=','estado.id')
            ->where('docente.num_doc', $request->nombre)
            ->select('docente.id as id', 'docente.nombre', 'apellido', 'num_doc', 'fec_vinculacion',
                    'correo', 'telefono', 'direccion', 'genero.descripcion as genero', 'tipo_documento.descripcion',
                    'estado.descripcion as estado')
            
            ->distinct()
            ->get();

            for($i=0; $i<count($busdocente); ++$i){
                $datos[$i]= DB::table('cursos')->join('asignaturas','cursos.id_asignatura','=','asignaturas.id')
                            ->join('tipo_curso', 'cursos.id_tipo_curso', '=', 'tipo_curso.id')
                            ->where('cursos.id_docente', '=', $busdocente[$i]->id)
                            ->select('asignaturas.nombre as asig', 'tipo_curso.descripcion as cur', 'id_docente', 'asignaturas.intensidad_horaria as horas', 'asignaturas.codigo as cod')
                            ->distinct()
                            ->get();
                   }
           
            return response()->json(['busdocente' => $busdocente, 'datos' => $datos]);

        }
           
               
                      
           
    }
    ////////////////////////////////////////
      public function cambiardoc(Request $request){
        $doces= docente::find($request->idocente);
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
    ///////////////////////////////////////77
       public function listado_doc(){
        $res = DB::table('docente')->count();
        if($res!=0){
            $b=1;
            $doc = DB::table('cursos')->join('tipo_curso', 'cursos.id_tipo_curso', '=', 'tipo_curso.id')
                   ->join('docente', 'cursos.id_docente', '=', 'docente.id')
                   ->join('asignaturas', 'cursos.id_asignatura', '=', 'asignaturas.id')
                   ->join('tipo_documento','docente.id_tipo_doc','=','tipo_documento.id')
                   ->join('genero','docente.id_genero','=','genero.id')
                   ->join('estado','docente.id_estado','=','estado.id')
                   ->select('docente.id as idoc', 'docente.nombre', 'apellido', 'num_doc', 'fec_vinculacion',
                            'correo', 'telefono', 'direccion', 'genero.descripcion as genero', 'tipo_documento.descripcion',
                            'estado.descripcion as estado')
                   
                   ->distinct()
                   ->get();
                }else{
                    $b=0;
                    $doc=0;
                    
                }
        
               for($i=0; $i<count($doc); ++$i){
                $condoc[$i]= DB::table('cursos')->join('asignaturas','cursos.id_asignatura','=','asignaturas.id')
                            ->join('tipo_curso', 'cursos.id_tipo_curso', '=', 'tipo_curso.id')
                            ->where('cursos.id_docente', '=', $doc[$i]->idoc)
                            ->select('asignaturas.nombre as asig', 'tipo_curso.descripcion as cur', 'id_docente', 'asignaturas.intensidad_horaria as horas', 'asignaturas.codigo as cod')
                            ->distinct()
                            ->get();
                   }
            
        
      
        return view('docente.lista')->with('condoc',$condoc)->with('b',$b)->with('doc',$doc);
        //////////////////////////////////////////
    }
    //LISTADO DODENTE ESTUDIANTES
    public function lis_docente(){
        $res = DB::table('docente')->count();
        if($res!=0){
            $b=1;
            $doc = DB::table('cursos')->join('tipo_curso', 'cursos.id_tipo_curso', '=', 'tipo_curso.id')
                   ->join('docente', 'cursos.id_docente', '=', 'docente.id')
                   ->join('asignaturas', 'cursos.id_asignatura', '=', 'asignaturas.id')
                   ->join('tipo_documento','docente.id_tipo_doc','=','tipo_documento.id')
                   ->join('genero','docente.id_genero','=','genero.id')
                   ->join('estado','docente.id_estado','=','estado.id')
                   ->select('docente.id as idoc', 'docente.nombre', 'apellido', 'num_doc', 'fec_vinculacion',
                            'correo', 'telefono', 'direccion', 'genero.descripcion as genero', 'tipo_documento.descripcion',
                            'estado.descripcion as estado')
                   
                   ->distinct()
                   ->get();
            }else{
                $b=0;
                $doc=0;
                
            }
        
        for($i=0; $i<count($doc); ++$i){
                $condoc[$i]= DB::table('cursos')->join('asignaturas','cursos.id_asignatura','=','asignaturas.id')
                             ->join('tipo_curso', 'cursos.id_tipo_curso', '=', 'tipo_curso.id')
                             ->where('cursos.id_docente', '=', $doc[$i]->idoc)
                             ->select('asignaturas.nombre as asig', 'tipo_curso.descripcion as cur', 'id_docente', 'asignaturas.intensidad_horaria as horas', 'asignaturas.codigo as cod')
                             ->distinct()
                             ->get();
            }
            
        
        ///////////////////////////////////////////
        //////////////////////////////////////////
        return view('estudiantes.listado_docentes')->with('condoc',$condoc)->with('b',$b)->with('doc',$doc);
    }
}
