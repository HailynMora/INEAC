<?php

namespace App\Http\Controllers\Estudiantes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\GeneroModel\Genero;
use App\Models\ParentescoModel\Parentesco;
use App\Models\TipoDocumentoModel\TipoDocumento;
use App\Models\ParentescoModel\Acudiente;
use App\Models\ParentescoModel\EtniaModel;
use App\Models\EstudianteModel\Estudiante;
use App\Models\CertificadoModel\Certificado;
use App\Models\Archivos\Cargarchivo;
use App\Models\EstadoModel\Estado;
use App\Models\SaludModel\SistemaSalud;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;
use Carbon\Carbon;
use Session;
use PDF;

class EstudiantesController extends Controller
{
    public function registro(){
        $tipodoc=TipoDocumento::all();
        $genero=Genero::all();
        $etnia=EtniaModel::all();
        $estado=Estado::all();
        $user=User::all();
        $paren=Parentesco::all();
        $listado = Cargarchivo::all();
        return view('estudiantes.registroestu')->with('tipodoc', $tipodoc)
        ->with('genero', $genero)->with('etnia', $etnia)
        ->with('estado', $estado)
        ->with('user', $user)->with('paren', $paren)->with('listado', $listado);
    }

     //cambios hailyn
        public function listar(){
            $res=DB::table('estudiante')->count(); //validar datos cuando no hay estudiantes
            if($res!=0){
                $b=1;
                $estudiante=DB::table('estudiante')
                ->join('estado', 'id_estado', '=', 'estado.id')
                ->join('tipo_documento', 'id_tipo_doc', '=', 'tipo_documento.id')
                ->join('genero', 'id_genero', '=', 'genero.id')
                ->join('users', 'id_usuario', '=', 'users.id')
                ->join('acudiente', 'estudiante.id', '=', 'acudiente.id_estudiante')
                ->join('parentezco', 'acudiente.id_parentesco', '=', 'parentezco.id')
                ->join('sistema_salud', 'estudiante.id', '=', 'sistema_salud.id_estudiante')
                ->join('etnia', 'sistema_salud.id_etnia', '=', 'etnia.id')
                ->join('tipo_documento as tipo', 'acudiente.id_tipo_doc', '=', 'tipo.id')
                ->select('estudiante.id', 'estudiante.first_nom', 'estudiante.second_nom', 'estudiante.firts_ape', 'estudiante.second_ape',
                'estudiante.tiposangre', 'estudiante.dirresidencia', 'estudiante.dptresidencia', 'estudiante.munresidencia', 'estudiante.zona',
                'estudiante.barrio', 'estudiante.telefono', 'estudiante.num_doc', 'estudiante.dpt_expedicion', 'estudiante.mun_expedicion', 'estudiante.fecnacimiento',
                'estudiante.dpt_nacimiento', 'estudiante.mun_nacimiento',  'estudiante.correo', 'estudiante.estrato', 'estado.descripcion as estadoes', 'tipo_documento.descripcion as tdoces',
                'genero.descripcion as generoestu', 'users.name as usuestu', 'acudiente.lastname as nomacu', 'parentezco.descripcion as paren', 
                'acudiente.telefono as telacu', 'acudiente.num_doc as numacu', 'acudiente.direccion as diracu', 'sistema_salud.regimen', 'sistema_salud.eps', 'sistema_salud.nivelformacion',
                'sistema_salud.ocupacion', 'sistema_salud.discapacidad', 'etnia.descripcion as etniades', 'tipo.descripcion as tdocacu')
                ->get();
                $pro = DB::table('matriculas')
                        ->join('aprobado','matriculas.id_aprobado','=','aprobado.id')
                        ->join('tipo_curso','matriculas.id_curso','=','tipo_curso.id')
                        ->select('matriculas.id_estudiante', 'matriculas.periodo', 'matriculas.anio', 'matriculas.id_aprobado',
                                 'tipo_curso.codigo', 'tipo_curso.descripcion')
                        ->get();
                $te = DB::table('matricula_tecnico')->count();
                if($te!=0){
                    $tec = DB::table('matricula_tecnico')
                    ->join('aprobado','matricula_tecnico.id_aprobado','=','aprobado.id')
                    ->join('programa_tecnico','matricula_tecnico.id_tecnico','=','programa_tecnico.id')
                    ->join('trimestre_tecnicos','matricula_tecnico.id_trimestre','=','trimestre_tecnicos.id')
                    ->select('matricula_tecnico.id_estudiante', 'matricula_tecnico.anio', 'matricula_tecnico.periodo', 'id_aprobado', 
                             'programa_tecnico.nombretec',  'programa_tecnico.codigotec')
                    ->get();
                   
                }else{
                    $tec=array('datos');
                }
                
            }
            else{
                $b=0;
                $estudiante=array('datos');
                $pro=array('datos');
                $tec=array('datos');
            }

            return view('estudiantes.visualizar')->with('estudiante', $estudiante)->with('b', $b)->with('pro', $pro)->with('tec', $tec);
        }

     //end cambios hailyn

    public function cambiar_estado($id){
        $estu= Estudiante::find($id);
        $es = $estu->id_estado;
        if($es==2){
            $estu->id_estado = 1;
            $estu->save();
        }else{
            $estu->id_estado = 2;
            $estu->save();
        }        
        return redirect('/visualizar/estudiante');
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

    public function matricula(Request $request){

        $r= $request->input('numerodoc');
        $co= $request->input('correo');
        $res=DB::table('estudiante')->where('num_doc', '=', $r)->count();
        $c=DB::table('estudiante')->where('correo', '=', $co)->count();
        //consultar id del rol
        $idrol = DB::table('roles')->where('roles.descripcion', 'like', 'Estudiante')->select('roles.id')->first();
        //crear el user
        $usu = new User();
        $usu->name = $request->input('firstname');
        $usu->email = $request->input('email');
        $usu->password = Hash::make($request->pass);
        $usu->id_rol = $idrol->id;
        $usu->estado = 1;
        $usu->save();
        //end crear user

        if($res!=0){//validacion con ajax
            return \Response::json([
                'error'  => 'Error datos'
            ],422);
        }else{
            if($c!=0){
                return \Response::json([
                    'error'  => 'Error datos'
                ],423);
            }else{ 
                $Registrar = new Estudiante();
                $Registrar->first_nom = $request->input('firstname');
                $Registrar->second_nom = $request->input('secondname');
                $Registrar->firts_ape = $request->input('firsape');
                $Registrar->second_ape = $request->input('secondape');
                $Registrar->tiposangre = $request->input('sangre');
                $Registrar->dirresidencia = $request->input('dirres');
                $Registrar->dptresidencia = $request->input('dptres');
                $Registrar->munresidencia = $request->input('mpiores');
                $Registrar->zona = $request->input('zona');
                $Registrar->barrio = $request->input('barrio');
                $Registrar->telefono = $request->input('telefono');
                $Registrar->num_doc = $request->input('numero_doc');
                $Registrar->dpt_expedicion = $request->input('depex');
                $Registrar->mun_expedicion = $request->input('mpioex');
                $Registrar->fecnacimiento = $request->input('fecnac');
                $Registrar->dpt_nacimiento  = $request->input('dpt_nac');
                $Registrar->mun_nacimiento = $request->input('mpio_nac');
                $Registrar->correo = $request->input('correo');
                $Registrar->estrato = $request->input('estrato');
                $Registrar->id_genero = $request->input('genero');
                $Registrar->id_tipo_doc  = $request->input('tipodoc');
                $Registrar->id_estado = $request->input('estado');
                $Registrar->id_usuario  = $usu->id;
                $Registrar->save(); 
                //////////////////////////#################consultar el id del estudiante ingresado
                $ndoc=$request->numero_doc;
                $resestu=DB::table('estudiante')->where('num_doc', '=', $ndoc)->select('estudiante.id as idestu')->first();
                /////////////////////////77######################### almacenar los datos en la tabla sistema_salud
                $Salud =new SistemaSalud();
                $Salud->regimen	= $request->input('regimen');
                $Salud->eps	= $request->input('carnet');
                $Salud->nivelformacion= $request->input('nivelformacion');
                $Salud->ocupacion = $request->input('ocupacion');
                $Salud->discapacidad = $request->input('discapacidad');	
                $Salud->id_etnia = $request->input('etnia');
                $Salud->id_estudiante = $resestu->idestu;
                $Salud->save(); 
                /////////////#############################################Almacenar los datos del acudiente
                $Acu = new Acudiente();
                $Acu->lastname = $request->input('nombresacu');
                $Acu->direccion = $request->input('diracu');
                $Acu->telefono = $request->input('telacu');
                $Acu->num_doc = $request->input('numdocacu');
                $Acu->id_parentesco = $request->input('parentesco');
                $Acu->id_tipo_doc =$request->input('tdocacu');
                $Acu->id_estudiante	=$resestu->idestu;
                $Acu->save();
            }
        }
              
        return back();        
    }
    public function form_actualizar($id){
        
       // $est = Estudiante::findOrFail($id);
       $est=DB::table('estudiante')
            ->where('estudiante.id', '=', $id)
            ->join('estado', 'id_estado', '=', 'estado.id')
            ->join('tipo_documento', 'id_tipo_doc', '=', 'tipo_documento.id')
            ->join('genero', 'id_genero', '=', 'genero.id')
            ->join('users', 'id_usuario', '=', 'users.id')
            ->join('acudiente', 'estudiante.id', '=', 'acudiente.id_estudiante')
            ->join('parentezco', 'acudiente.id_parentesco', '=', 'parentezco.id')
            ->join('sistema_salud', 'estudiante.id', '=', 'sistema_salud.id_estudiante')
            ->join('etnia', 'sistema_salud.id_etnia', '=', 'etnia.id')
            ->join('tipo_documento as tipo', 'acudiente.id_tipo_doc', '=', 'tipo.id')
            ->select('estudiante.id', 'estudiante.first_nom', 'estudiante.id_tipo_doc as idtdoces', 'estudiante.id_genero as idgen', 'estudiante.id_estado as idestado', 'estudiante.second_nom', 'estudiante.firts_ape', 'estudiante.second_ape',
            'estudiante.tiposangre', 'estudiante.dirresidencia', 'estudiante.dptresidencia', 'estudiante.munresidencia', 'estudiante.zona',
            'estudiante.barrio', 'estudiante.telefono', 'estudiante.num_doc', 'estudiante.dpt_expedicion', 'estudiante.mun_expedicion', 'estudiante.fecnacimiento',
            'estudiante.dpt_nacimiento', 'estudiante.mun_nacimiento',  'estudiante.correo', 'estudiante.estrato', 'estado.descripcion as estadoes', 'tipo_documento.descripcion as tdoces',
            'genero.descripcion as generoestu', 'users.name as usuestu', 'acudiente.lastname as nomacu', 'parentezco.descripcion as paren', 
            'acudiente.telefono as telacu', 'acudiente.num_doc as numacu', 'acudiente.direccion as diracu', 'sistema_salud.regimen', 'sistema_salud.eps', 'sistema_salud.nivelformacion',
            'sistema_salud.ocupacion', 'sistema_salud.discapacidad', 'sistema_salud.id_etnia as idetnia',  'etnia.descripcion as etniades', 'acudiente.id_parentesco as idparen',  'acudiente.id_tipo_doc as idtpoacu', 'tipo.descripcion as tdocacu')
	        ->get();
        $tipodoc=TipoDocumento::all();
        $genero=Genero::all();
        $etnia=EtniaModel::all();
        //$acu=Acudiente::all();
        $estado=Estado::all();
       // $certificado=Certificado::all();
       $paren=Parentesco::all();
        //$user=User::all();
        return view('estudiantes.actualizar', compact('est','tipodoc','genero','etnia','estado', 'paren'));
    }
    public function actualizar_estudiante(Request $request, $id){
           $Registrar = Estudiante::FindOrFail($id);
        //#################################################
            $Registrar->first_nom = $request->input('firstname');
            $Registrar->second_nom = $request->input('secondname');
            $Registrar->firts_ape = $request->input('firsape');
            $Registrar->second_ape = $request->input('secondape');
            $Registrar->tiposangre = $request->input('sangre');
            $Registrar->dirresidencia = $request->input('dirres');
            $Registrar->dptresidencia = $request->input('dptres');
            $Registrar->munresidencia = $request->input('mpiores');
            $Registrar->zona = $request->input('zona');
            $Registrar->barrio = $request->input('barrio');
            $Registrar->telefono = $request->input('telefono');
            $Registrar->num_doc = $request->input('numero_doc');
            $Registrar->dpt_expedicion = $request->input('depex');
            $Registrar->mun_expedicion = $request->input('mpioex');
            $Registrar->fecnacimiento = $request->input('fecnac');
            $Registrar->dpt_nacimiento  = $request->input('dpt_nac');
            $Registrar->mun_nacimiento = $request->input('mpio_nac');
            $Registrar->correo = $request->input('correo');
            $Registrar->estrato = $request->input('estrato');
            $Registrar->id_genero = $request->input('genero');
            $Registrar->id_tipo_doc  = $request->input('tipodoc');
            $Registrar->id_estado = $request->input('estado');
            $Registrar->save(); 
            //////////////////////////#################consultar el id del estudiante ingresado
            $Salud=SistemaSalud::where('id_estudiante', '=', $id)->first();
            /////////////////////////77######################### almacenar los datos en la tabla sistema_salud
            $Salud->regimen	= $request->input('regimen');
            $Salud->eps	= $request->input('carnet');
            $Salud->nivelformacion= $request->input('nivelformacion');
            $Salud->ocupacion = $request->input('ocupacion');
            $Salud->discapacidad = $request->input('discapacidad');	
            $Salud->id_etnia = $request->input('etnia');
            $Salud->save(); 
            /////////////#############################################Almacenar los datos del acudiente
            $Acu=Acudiente::where('id_estudiante', '=', $id)->first();
            $Acu->lastname = $request->input('nombresacu');
            $Acu->direccion = $request->input('diracu');
            $Acu->telefono = $request->input('telacu');
            $Acu->num_doc = $request->input('numdocacu');
            $Acu->id_parentesco = $request->input('parentesco');
            $Acu->id_tipo_doc =$request->input('tdocacu');
            $Acu->save(); 


        //#################################################
        return redirect('/visualizar/estudiante');

    }

    //////////////////buscar estudiante////////////////////////
    public function busquedares_est(Request $request){

       /*  $busest =   DB::table('matriculas')
                    ->join('estudiante', 'matriculas.id_estudiante', '=', 'estudiante.id')
                    ->join('estado', 'estudiante.id_estado', '=', 'estado.id')
                    ->join('aprobado', 'matriculas.id_aprobado', '=', 'aprobado.id')
                    ->join('tipo_curso', 'matriculas.id_curso', '=', 'tipo_curso.id')
                    ->join('tipo_documento', 'id_tipo_doc', '=', 'tipo_documento.id')
                    ->join('genero', 'id_genero', '=', 'genero.id')
                    ->join('users', 'id_usuario', '=', 'users.id')
                    ->join('acudiente', 'estudiante.id', '=', 'acudiente.id_estudiante')
                    ->join('parentezco', 'acudiente.id_parentesco', '=', 'parentezco.id')
                    ->join('sistema_salud', 'estudiante.id', '=', 'sistema_salud.id_estudiante')
                    ->join('etnia', 'sistema_salud.id_etnia', '=', 'etnia.id')
                    ->join('tipo_documento as tipo', 'acudiente.id_tipo_doc', '=', 'tipo.id')
                    ->where('estudiante.num_doc', '=', $request->nombre)
                    ->select('estudiante.id', 'estudiante.first_nom', 'estudiante.second_nom', 'estudiante.firts_ape', 'estudiante.second_ape',
                    'estudiante.tiposangre', 'estudiante.dirresidencia', 'estudiante.dptresidencia', 'estudiante.munresidencia', 'estudiante.zona',
                    'estudiante.barrio', 'estudiante.telefono', 'estudiante.num_doc', 'estudiante.dpt_expedicion', 'estudiante.mun_expedicion', 'estudiante.fecnacimiento',
                    'estudiante.dpt_nacimiento', 'estudiante.mun_nacimiento',  'estudiante.correo', 'estudiante.estrato', 'tipo_documento.descripcion as tdoces',
                    'genero.descripcion as generoestu', 'users.name as usuestu', 'acudiente.lastname as nomacu', 'parentezco.descripcion as paren', 
                    'acudiente.telefono as telacu', 'acudiente.num_doc as numacu', 'acudiente.direccion as diracu', 'sistema_salud.regimen', 'sistema_salud.eps', 'sistema_salud.nivelformacion',
                    'sistema_salud.ocupacion', 'sistema_salud.discapacidad', 'etnia.descripcion as etniades', 'tipo.descripcion as tdocacu', 'matriculas.anio', 'matriculas.periodo', 'aprobado.nombre as apro', 'tipo_curso.descripcion as curso', 'tipo_curso.cursodes as descur', 'estado.descripcion as estadoes')
                    ->get(); */
                    $busest=DB::table('estudiante')
                            ->join('estado', 'id_estado', '=', 'estado.id')
                            ->join('tipo_documento', 'id_tipo_doc', '=', 'tipo_documento.id')
                            ->join('genero', 'id_genero', '=', 'genero.id')
                            ->join('users', 'id_usuario', '=', 'users.id')
                            ->join('acudiente', 'estudiante.id', '=', 'acudiente.id_estudiante')
                            ->join('parentezco', 'acudiente.id_parentesco', '=', 'parentezco.id')
                            ->join('sistema_salud', 'estudiante.id', '=', 'sistema_salud.id_estudiante')
                            ->join('etnia', 'sistema_salud.id_etnia', '=', 'etnia.id')
                            ->join('tipo_documento as tipo', 'acudiente.id_tipo_doc', '=', 'tipo.id')
                            ->where('estudiante.num_doc', '=', $request->nombre)
                            ->select('estudiante.id', 'estudiante.first_nom', 'estudiante.second_nom', 'estudiante.firts_ape', 'estudiante.second_ape',
                            'estudiante.tiposangre', 'estudiante.dirresidencia', 'estudiante.dptresidencia', 'estudiante.munresidencia', 'estudiante.zona',
                            'estudiante.barrio', 'estudiante.telefono', 'estudiante.num_doc', 'estudiante.dpt_expedicion', 'estudiante.mun_expedicion', 'estudiante.fecnacimiento',
                            'estudiante.dpt_nacimiento', 'estudiante.mun_nacimiento',  'estudiante.correo', 'estudiante.estrato', 'estado.descripcion as estadoes', 'tipo_documento.descripcion as tdoces',
                            'genero.descripcion as generoestu', 'users.name as usuestu', 'acudiente.lastname as nomacu', 'parentezco.descripcion as paren', 
                            'acudiente.telefono as telacu', 'acudiente.num_doc as numacu', 'acudiente.direccion as diracu', 'sistema_salud.regimen', 'sistema_salud.eps', 'sistema_salud.nivelformacion',
                            'sistema_salud.ocupacion', 'sistema_salud.discapacidad', 'etnia.descripcion as etniades', 'tipo.descripcion as tdocacu')
                            ->get();

                    $bac = DB::table('matriculas')
                                ->join('aprobado','matriculas.id_aprobado','=','aprobado.id')
                                ->join('tipo_curso','matriculas.id_curso','=','tipo_curso.id')
                                ->where('matriculas.id_aprobado', '=', '1')
                                ->select('matriculas.id_estudiante as ides', 'matriculas.periodo', 'matriculas.anio', 'matriculas.id_aprobado',
                                        'tipo_curso.codigo', 'tipo_curso.descripcion') 
                                ->get();
    
                    $tec = DB::table('matricula_tecnico')
                                ->join('aprobado','matricula_tecnico.id_aprobado','=','aprobado.id')
                                ->join('programa_tecnico','matricula_tecnico.id_tecnico','=','programa_tecnico.id')
                                ->join('trimestre_tecnicos','matricula_tecnico.id_trimestre','=','trimestre_tecnicos.id')
                                ->where('matricula_tecnico.id_aprobado', '=', '1')
                                ->select('matricula_tecnico.id_estudiante', 'matricula_tecnico.anio', 'matricula_tecnico.periodo', 'id_aprobado', 
                                         'programa_tecnico.nombretec',  'programa_tecnico.codigotec')
                                ->get();

                     return response()->json(['busest' => $busest, 'bac' => $bac, 'tec' => $tec]);
    }
    ////////////////////////////////////////cambiar el estado del estudianet por ajax


        //buscar estudianres desde admin por ajax
        public function searchEstuCon(Request $request){
            $estudiantecon=DB::table('estudiante')
                        ->join('estado', 'id_estado', '=', 'estado.id')
                        ->join('tipo_documento', 'id_tipo_doc', '=', 'tipo_documento.id')
                        ->join('genero', 'id_genero', '=', 'genero.id')
                        ->join('users', 'id_usuario', '=', 'users.id')
                        ->join('acudiente', 'estudiante.id', '=', 'acudiente.id_estudiante')
                        ->join('parentezco', 'acudiente.id_parentesco', '=', 'parentezco.id')
                        ->join('sistema_salud', 'estudiante.id', '=', 'sistema_salud.id_estudiante')
                        ->join('etnia', 'sistema_salud.id_etnia', '=', 'etnia.id')
                        ->join('tipo_documento as tipo', 'acudiente.id_tipo_doc', '=', 'tipo.id')
                        ->where('estudiante.num_doc', '=', $request->nombre)
                        ->select('estudiante.id', 'estudiante.first_nom', 'estudiante.second_nom', 'estudiante.firts_ape', 'estudiante.second_ape',
                        'estudiante.tiposangre', 'estudiante.dirresidencia', 'estudiante.dptresidencia', 'estudiante.munresidencia', 'estudiante.zona',
                        'estudiante.barrio', 'estudiante.telefono', 'estudiante.num_doc', 'estudiante.dpt_expedicion', 'estudiante.mun_expedicion', 'estudiante.fecnacimiento',
                        'estudiante.dpt_nacimiento', 'estudiante.mun_nacimiento',  'estudiante.correo', 'estudiante.estrato', 'estado.descripcion as estadoes', 'tipo_documento.descripcion as tdoces',
                        'genero.descripcion as generoestu', 'users.name as usuestu', 'acudiente.lastname as nomacu', 'parentezco.descripcion as paren', 
                        'acudiente.telefono as telacu', 'acudiente.num_doc as numacu', 'acudiente.direccion as diracu', 'sistema_salud.regimen', 'sistema_salud.eps', 'sistema_salud.nivelformacion',
                        'sistema_salud.ocupacion', 'sistema_salud.discapacidad', 'etnia.descripcion as etniades', 'tipo.descripcion as tdocacu')
                        ->get();
                return response(json_decode($estudiantecon,JSON_UNESCAPED_UNICODE),200)->header('Content-type', 'text/plain');
        }
    //end buscar estudiante desde admin por ajax

    
    public function cambiarestado(Request $request){
        $estu= Estudiante::find($request->idestudiante);
        $es = $estu->id_estado;
        if($es==2){
            $estu->id_estado = 1;
            $estu->save();
        }else{
            $estu->id_estado = 2;
            $estu->save();
        }        
        return back();
    }

    public function listar_estudo(Request $request){
        
        $res=DB::table('matriculas')->count(); //validar datos cuando no hay estudiantes
        if($res!=0){
            $b=1;
            //#########################################
            $estval=DB::table('matriculas')
                    ->join('estudiante', 'matriculas.id_estudiante', '=', 'estudiante.id')
                    ->join('aprobado', 'matriculas.id_aprobado', '=', 'aprobado.id')
                    ->join('tipo_curso', 'matriculas.id_curso', '=', 'tipo_curso.id')
                    ->join('estado', 'estudiante.id_estado', '=', 'estado.id')
                    ->join('tipo_documento', 'estudiante.id_tipo_doc', '=', 'tipo_documento.id')
                    ->join('genero', 'estudiante.id_genero', '=', 'genero.id')
                    ->join('users', 'estudiante.id_usuario', '=', 'users.id')
                    ->join('acudiente', 'estudiante.id', '=', 'acudiente.id_estudiante')
                    ->join('parentezco', 'acudiente.id_parentesco', '=', 'parentezco.id')
                    ->join('sistema_salud', 'estudiante.id', '=', 'sistema_salud.id_estudiante')
                    ->join('etnia', 'sistema_salud.id_etnia', '=', 'etnia.id')
                    ->join('tipo_documento as tipo', 'acudiente.id_tipo_doc', '=', 'tipo.id')
                    ->where('matriculas.anio', $request->anio)
                    ->where('matriculas.periodo', $request->periodo)
                    ->where('matriculas.id_curso', $request->cursoba)
                    ->count();
            if($estval != 0){
            //#######################################3
            $estudiante=DB::table('matriculas')
            ->join('estudiante', 'matriculas.id_estudiante', '=', 'estudiante.id')
            ->join('aprobado', 'matriculas.id_aprobado', '=', 'aprobado.id')
            ->join('tipo_curso', 'matriculas.id_curso', '=', 'tipo_curso.id')
            ->join('estado', 'estudiante.id_estado', '=', 'estado.id')
            ->join('tipo_documento', 'estudiante.id_tipo_doc', '=', 'tipo_documento.id')
            ->join('genero', 'estudiante.id_genero', '=', 'genero.id')
            ->join('users', 'estudiante.id_usuario', '=', 'users.id')
            ->join('acudiente', 'estudiante.id', '=', 'acudiente.id_estudiante')
            ->join('parentezco', 'acudiente.id_parentesco', '=', 'parentezco.id')
            ->join('sistema_salud', 'estudiante.id', '=', 'sistema_salud.id_estudiante')
            ->join('etnia', 'sistema_salud.id_etnia', '=', 'etnia.id')
            ->join('tipo_documento as tipo', 'acudiente.id_tipo_doc', '=', 'tipo.id')
            ->where('matriculas.anio', $request->anio)
            ->where('matriculas.periodo', $request->periodo)
            ->where('matriculas.id_curso', $request->cursoba)
            ->select('estudiante.id', 'estudiante.first_nom', 'estudiante.second_nom', 'estudiante.firts_ape', 'estudiante.second_ape',
            'estudiante.tiposangre', 'estudiante.dirresidencia', 'estudiante.dptresidencia', 'estudiante.munresidencia', 'estudiante.zona',
            'estudiante.barrio', 'estudiante.telefono', 'estudiante.num_doc', 'estudiante.dpt_expedicion', 'estudiante.mun_expedicion', 'estudiante.fecnacimiento',
            'estudiante.dpt_nacimiento', 'estudiante.mun_nacimiento',  'estudiante.correo', 'estudiante.estrato', 'estado.descripcion as estadoes', 'tipo_documento.descripcion as tdoces',
            'genero.descripcion as generoestu', 'users.name as usuestu', 'acudiente.lastname as nomacu', 'parentezco.descripcion as paren', 
            'acudiente.telefono as telacu', 'acudiente.num_doc as numacu', 'acudiente.direccion as diracu', 'sistema_salud.regimen', 'sistema_salud.eps', 'sistema_salud.nivelformacion',
            'sistema_salud.ocupacion', 'sistema_salud.discapacidad', 'etnia.descripcion as etniades', 'tipo.descripcion as tdocacu', 'matriculas.anio', 'matriculas.periodo', 'tipo_curso.descripcion', 
            'tipo_curso.cursodes', 'aprobado.nombre as estamat')
	        ->get();
            }else{
                $b=0;
                $estudiante=array('datos');
                Session::flash('consulta','Lo sentimos! no se encontró información para los datos seleccionados.');
            }
        } 
        else{
            $b=0;
            $estudiante=array('datos');
        }
        $dat = ['anio' => $request->anio, 
                'per' => $request->periodo,
                'curso' => $request->cursoba];
       // return $dat['anio'];

        return view('estudiantes.listado_doc')->with('estudiante', $estudiante)->with('dat', $dat)->with('b', $b);
    }

     //importacion
    public function archivoimpor(Request $request){
          // return $request->hasFile('uploadedfile');
            if($request->hasFile('uploadedfile')){
                $category = new Cargarchivo();
                $file = $request->file('uploadedfile');//guarda la variable id en un file
                //$d = count($file);
                $name = $file->getClientOriginalName();
                $limpiarnombre = str_replace(array("#",".",";"," "), '', $name);
                $val = $limpiarnombre.".".$file->guessExtension();//renombra el archivo subido
                $ruta = public_path("csv/".$val);//ruta para guardar el archivo pdf/ es la carpeta
                
                //if($file->guessExtension()=="txt"){
                 copy($file, $ruta);
                 $category->descripcion = $request->input('nombre');
                 $category->ruta = $val;//ingresa el nombre de la ruta a la base de datos
                 $category->save();//guarda los datos
                   // return redirect()->route('cargamasiva')->with('mensaje', 'Archivo cargado con exito');
                   Session::flash('msj','El archivo subido con exito.');
                   return back();
              
        }
    }

    //#############################################3
    public function archivoselect($id){
      $buscar = Cargarchivo::FindOrFail($id);
      //normalizar
       $contador=0;
       $c=0;
       $f=0;
       $rut = public_path('csv/'.$buscar->ruta);
       $lines = file($rut);
       $utf= array_map('utf8_encode', $lines);
       $array = array_map('str_getcsv', $utf);
       //guardar
       $d = sizeof($array);
       if($d > 1){
        for($k=1; $k<sizeof($array); ++$k){
            for($j=0; $j<=31; ++$j){
             if(!isset($array[$k][$j])){
                Session::flash('msj','Lo sentimos! El archivo debe tener todos los campos completos o verifique que este delimitado por comas.');
                return back();
             }
            }
        }
       for($i=1; $i<sizeof($array); ++$i){
            //validar la cedula y el correo
            $valcedula = DB::table('estudiante')->where('num_doc', '=', $array[$i][5])->count();
            $valemail = DB::table('users')->where('email', '=', $array[$i][17])->count();
            if($valcedula==0 && $valemail==0){
            //end validar cedula y correo
           //#######################################
            $usu = new User();
            $usu->name = $array[$i][0];
            $usu->email = $array[$i][17];
            $usu->password = Hash::make('123456789');
            $usu->id_rol = 3;
            $usu->estado = 1;
            $usu->save();
            //###################################
            $category = new Estudiante();
            $category->first_nom=$array[$i][0];
            $category->second_nom=$array[$i][1];
            $category->firts_ape=$array[$i][2];
            $category->second_ape=$array[$i][3];
            $category->tiposangre= $array[$i][11];
            $category->dirresidencia= $array[$i][12];
            $category->dptresidencia=$array[$i][14];
            $category->munresidencia= $array[$i][13];
            $category->zona= $array[$i][15];
            $category->barrio= "N/A";
            $category->telefono=$array[$i][16];
            $category->num_doc= $array[$i][5];
            $category->dpt_expedicion= $array[$i][6];
            $category->mun_expedicion= $array[$i][7];
            $category->fecnacimiento=date("Y-m-d", strtotime($array[$i][8]));
            $category->dpt_nacimiento= $array[$i][9];
            $category->mun_nacimiento= $array[$i][10];
            $category->correo= $array[$i][17];
            $category->estrato=$array[$i][18];
            if($array[$i][19] == 'Masculino'){
                $category->id_genero= 1;
            }else{
                $category->id_genero= 2;
            }
    
            if($array[$i][4] == 'Cedula de ciudadania'){
               $category->id_tipo_doc= 1;
            }else{
                $category->id_tipo_doc= 2;
            }
            $category->id_estado= 1;
            $category->id_usuario=  $usu->id;
            $category->save();
            //###########################################
             //sistema de salud
            $Salud =new SistemaSalud();
            $Salud->regimen	= $array[$i][20];
            $Salud->eps	= $array[$i][21];
            $Salud->nivelformacion= $array[$i][22];
            $Salud->ocupacion = $array[$i][23];
            $Salud->discapacidad = $array[$i][24];	
            if($array[$i][25] == 'Indigena'){
                $Salud->id_etnia = 2;
            }else{
                $Salud->id_etnia = 1;
            }
            $Salud->id_estudiante = $category->id;
            $Salud->save();
            //acudientes
            $Acu = new Acudiente();
            $Acu->lastname = $array[$i][26];
            $Acu->direccion = $array[$i][27];
            $Acu->telefono = $array[$i][28];
            $Acu->num_doc = $array[$i][31];
            if($array[$i][29] == 'Madre de familia'){
                $Acu->id_parentesco = 2;
            }else{
                $Acu->id_parentesco = 5;
            }
           
            if($array[$i][30] == 'Cedula de ciudadania'){
                $Acu->id_tipo_doc=1;
            }else{
                $Acu->id_tipo_doc=2;
            }
            $Acu->id_estudiante	=$category->id;
            $Acu->save();
            Session::flash('msj','Registro Exitoso! Usuarios registrados.');
       }else{
        Session::flash('msj','Lo sentimos! Usuarios duplicados.');
       }
            
      }

    }else{
        Session::flash('msj','Lo sentimos! El archivo esta vacio.');
    }
    return back();
    }

    //eliminar archivos
    public function archivoelmin($id){
        //$category = new Cargarchivo();
        $elim = Cargarchivo::findOrfail($id);
        $nom=$elim->ruta;
        $elim->delete();
        Session::flash('msjalert','Eliminación Exitosa! El archivo se ha eliminado de forma exitosa.');
        return back();
      }

      //######################
      public function archivopdflista($anio, $per, $cur){
        //##########
        $dia = date('d', time()); 
        $mes = date('m', time()); 
        $anio = date('Y', time());

        $idlog=auth()->id();
        $doc = DB::table('docente')->where('id_usuario', '=', $idlog)->select('nombre', 'apellido')->get();
        //#########
        $estudiante=DB::table('matriculas')
                    ->join('estudiante', 'matriculas.id_estudiante', '=', 'estudiante.id')
                    ->join('aprobado', 'matriculas.id_aprobado', '=', 'aprobado.id')
                    ->join('tipo_curso', 'matriculas.id_curso', '=', 'tipo_curso.id')
                    ->join('estado', 'estudiante.id_estado', '=', 'estado.id')
                    ->join('tipo_documento', 'estudiante.id_tipo_doc', '=', 'tipo_documento.id')
                    ->join('genero', 'estudiante.id_genero', '=', 'genero.id')
                    ->join('users', 'estudiante.id_usuario', '=', 'users.id')
                    ->join('acudiente', 'estudiante.id', '=', 'acudiente.id_estudiante')
                    ->join('parentezco', 'acudiente.id_parentesco', '=', 'parentezco.id')
                    ->join('sistema_salud', 'estudiante.id', '=', 'sistema_salud.id_estudiante')
                    ->join('etnia', 'sistema_salud.id_etnia', '=', 'etnia.id')
                    ->join('tipo_documento as tipo', 'acudiente.id_tipo_doc', '=', 'tipo.id')
                    ->where('matriculas.anio', $anio)
                    ->where('matriculas.periodo', $per)
                    ->where('matriculas.id_curso', $cur)
                    ->where('matriculas.id_aprobado', '!=', '4')
                    ->where('matriculas.id_aprobado', '!=', '5')
                    ->select('estudiante.id', 'estudiante.first_nom', 'estudiante.second_nom', 'estudiante.firts_ape', 'estudiante.second_ape',
                    'estudiante.telefono', 'estudiante.num_doc',   
                    'estudiante.correo',   'estado.descripcion as estadoes',
                    'sistema_salud.discapacidad', 'matriculas.anio', 'matriculas.periodo', 'tipo_curso.descripcion', 
                    'tipo_curso.cursodes', 'aprobado.nombre as estamat')
                    ->get();
        //###############################

        $data = [
            'estudiante' => $estudiante,
            'dia' => $dia,
            'mes' => $mes,
            'anio' => $anio,
            'doc' => $doc,
        ];  
        //###########################
        $pdf = PDF::loadView('docente.pdflista_estu', $data);
        return $pdf->download('listado_estudiantes.pdf');
      }

}