<?php

namespace App\Http\Controllers\Matriculas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EstudianteModel\Estudiante;
use Illuminate\Support\Facades\DB;
use App\Models\AsignaturaModel\Programas;
use App\Models\MatriculasModel\Matricula;
use App\Models\MatriculasModel\MatriculaTec;
Use Session;
use Carbon\Carbon;

class MatriculasController extends Controller
{
    public function index(){
        return view('matriculas.matricula');
    }

    public function search(Request $request){
        $results = Estudiante::where('nombre', 'LIKE', "%{$request->search}%")->get();
        return view('matriculas.results', compact('results'))->with(['search' => $request->search])->render();
    }
        
    public function show(Request $request){
        $post = DB::table('estudiante')->where('estudiante.id', '=', $request->id)
                ->join('etnia', 'id_etnia', '=', 'etnia.id')
                ->select('estudiante.id', 'estudiante.nombre', 'estudiante.apellido', 'estudiante.direccion',
                'estudiante.telefono', 'estudiante.num_doc', 'etnia.descripcion')->get();
       // $curso =DB::table('') poner la consulta de cursos
        return view('matriculas.post', compact('post'))->render();
    }
     
    public function matriculasvista($id){
        $date = Carbon::now()->locale('es')->translatedFormat('Y');
        $prog=DB::table('programa_tecnico')->where('id_estado','=',1)
             ->select('programa_tecnico.id as idtec', 'programa_tecnico.codigotec', 'programa_tecnico.nombretec')
             ->get();
        $estu=Estudiante::findOrfail($id);
        $tri =DB::table('trimestre_tecnicos')->get();
        $anio=$date;
        $bach = DB::table('tipo_curso')->where('id_estado','=',1)->select('tipo_curso.id as idbachi', 'tipo_curso.descripcion as curso')->get();
        return view('matriculas.vistamatricula', compact('estu', 'prog', 'tri','anio', 'bach'));
    }
    
    //buscar cursos a matricular
    public function curbus(Request $request){
        $results = Programas::where('descripcion', 'LIKE', "%{$request->search}%")->where('id_estado','=',1)->get();
        return view('matriculas.resulcur', compact('results'))->with(['search' => $request->search])->render();
    }
        
    public function mosbus(Request $request){
        $post = DB::table('tipo_curso')->where('tipo_curso.id','=',$request->id)
        ->join('estado','id_estado','=','estado.id')
        ->select('tipo_curso.id','tipo_curso.codigo','tipo_curso.descripcion as programa','tipo_curso.id_estado','estado.descripcion as estado')
        ->get();
        return view('matriculas.mostrarcur', compact('post'))->render();
    }
    
    public function registromat(Request $request){
        $id = $request->estu;
        $estudiante =Estudiante::findOrfail($request->estu);
        $r=$request->cur;
        $validarMat= DB::table('matriculas')->where('matriculas.id_estudiante', '=', $id)->where('id_aprobado', 1)->count();
        $fin = DB::table('matriculas')->where('matriculas.id_estudiante', '=', $id)->where('id_aprobado', 5)->count();
 
        if($validarMat==0 && $fin == 0 ){
                $curso = Programas::findOrFail($r);
                $category = new Matricula();
                $category->id_estudiante = $request->input('estu');
                $category->id_curso = $request->input('cur');
                $category->anio = $request->input('anioba');
                $category->periodo= $request->input('perbachiller');
                $category->id_aprobado= 1;
                $category->fec_matricula = $request->input('fecha');
                $category->save();

                $actu = Matricula::where('id_estudiante', '=', $id)->where('id_aprobado', 2)->count();
                if($actu!=0){
                    $actu = Matricula::where('id_estudiante', '=', $id)->where('id_aprobado', 2)->first();
                    $actu-> id_aprobado = 5;
                    $actu-> save();
                }

                Session::flash('matec','Estudiante Registrado Exitosamente!');
               //Session::flash('validacion','Estudiante Ya Esta Registrado');
               return back();
        }else{
            $repe = DB::table('matriculas')->where('id_estudiante', $id)->where('id_aprobado','=', 4)->count();
            $r = DB::table('matriculas')->where('id_estudiante', $id)->where('id_aprobado', 1)->count();
            if($repe==1 && $r==0){
                $b=1;
                $curso = Programas::findOrFail($r);
                $category = new Matricula();
                $category->id_estudiante = $request->input('estu');
                $category->id_curso = $request->input('cur');
                $category->anio = $request->input('anioba');
                $category->periodo= $request->input('perbachiller');
                $category->id_aprobado= 1;
                $category->fec_matricula = $request->input('fecha');
                $category->save();
                Session::flash('matec','Estudiante Registrado Exitosamente!');

                $actu = Matricula::where('id_estudiante', '=', $id)->where('id_aprobado', 2)->first();
                $actu-> id_aprobado = 5;
                $actu-> save();

                return back();

            }
            else{
                $aprob= DB::table('matriculas')->where('matriculas.id_estudiante', '=', $id)->where('id_aprobado', 2)->count();
               
                if($aprob==1){
                   
                    $category = new Matricula();
                    $category->id_estudiante = $request->input('estu');
                    $category->id_curso = $request->input('cur');
                    $category->anio = $request->input('anioba');
                    $category->periodo= $request->input('perbachiller');
                    $category->id_aprobado= 1;
                    $category->fec_matricula = $request->input('fecha');
                    $category->save();
                    
                    $actu = Matricula::where('id_estudiante', '=', $id)->where('id_aprobado', 2)->first();
                    $actu-> id_aprobado = 5;
                    $actu-> save();

                    Session::flash('matec','Estudiante Registrado Exitosamente!');
                    //Session::flash('validacion','Estudiante Ya Esta Registrado');
                    return back();

                }else{

                    $b=0;
                    Session::flash('validacion','Estudiante ya registrado!');
                    return back();

                }
            }

        }
       return back();
        
    }

    public function listado(){
        $es="Activo";
        $val=DB::table('matriculas')->count();
        if($val=0){
            $b=0;
            $estumat=array('dato1', 'dato2', 'dato3');
        }else{
            $b=1;
            $estumat=DB::table('matriculas')->where('id_aprobado', '!=', 4)->where('id_aprobado', '!=', 5)->where('id_aprobado', '!=', 3)->join('estudiante', 'matriculas.id_estudiante', '=', 'estudiante.id')
            ->join('tipo_curso', 'matriculas.id_curso', '=', 'tipo_curso.id')
            ->join('tipo_documento', 'estudiante.id_tipo_doc', '=', 'tipo_documento.id')
            ->join('aprobado', 'matriculas.id_aprobado', '=', 'aprobado.id')
            ->select('matriculas.id as idmat', 'matriculas.id_estudiante as idest', 
            'matriculas.id_curso as idcur', 'estudiante.first_nom as nombre', 'estudiante.second_nom as segundonom', 
            'estudiante.second_ape as segundoape', 'estudiante.firts_ape as primerape',
            'estudiante.telefono', 'estudiante.num_doc', 'tipo_documento.descripcion as destipo', 
            'tipo_curso.descripcion as nomcurso', 'aprobado.nombre as estadoes', 'matriculas.anio', 'matriculas.periodo')
            ->paginate(15);
           
        }

        $program=DB::table('tipo_curso')->join('estado', 'tipo_curso.id_estado', '=', 'estado.id')
                      ->where('estado.descripcion', '=', $es)
                      ->select('tipo_curso.id as idcur', 'tipo_curso.descripcion as nomcur', 
                               'estado.descripcion as estadocur')->get();
       
        
        return view('matriculas.listadomat')->with('estumat', $estumat)->with('b', $b)->with('program', $program);
    }

   
    ///###########_matricula tecnico_###############
    public function matriculatec(Request $request){
              $repetido =DB::table('matricula_tecnico')->where('id_estudiante', $request->estu)->where('id_aprobado', 1)->count();
            if($repetido==0){
                    $category = new MatriculaTec();
                    $category->id_estudiante = $request->input('estu');
                    $category->id_tecnico = $request->input('programatec');
                    $category->id_aprobado =1;
                    $category->id_trimestre =$request->input('tri');
                    $category->anio =$request->input('anio');
                    $category->periodo=$request->input('per');
                    $category->fec_matricula = $request->input('fecha2');
                    $category->save();
                    Session::flash('matec','Estudiante Registrado Exitosamente!');
                    return back();
            }else{

                $rep =DB::table('matricula_tecnico')->where('id_estudiante', $request->estu)->where('id_aprobado','=', 4)->count();
                $r =DB::table('matricula_tecnico')->where('id_estudiante', $request->estu)->where('id_aprobado', 1)->count();
                if($rep==1 && $r==0){
                    $category = new MatriculaTec();
                    $category->id_estudiante = $request->input('estu');
                    $category->id_tecnico = $request->input('programatec');
                    $category->id_aprobado =1;
                    $category->id_trimestre =$request->input('tri');
                    $category->anio =$request->input('anio');
                    $category->periodo=$request->input('per');
                    $category->fec_matricula = $request->input('fecha');
                    $category->save();
                    Session::flash('matec','Estudiante Registrado Exitosamente!');
                    return back();
                }else{
                    Session::flash('validacion','Estudiante ya registrado!');
                    return back();
                }
               

            }


           
             
    }

    ///listado de estudiantes matriculados a un tecnico

    public function listado_tec(){
        
        $valtec=DB::table('matricula_tecnico')->count();
        if($valtec!=0){
            $b=1;
            $estutec=DB::table('matricula_tecnico')->where('id_aprobado', '!=', 4)->join('estudiante', 'matricula_tecnico.id_estudiante', '=', 'estudiante.id')
            ->join('programa_tecnico', 'matricula_tecnico.id_tecnico', '=', 'programa_tecnico.id')
            ->join('tipo_documento', 'estudiante.id_tipo_doc', '=', 'tipo_documento.id')
            ->join('aprobado', 'matricula_tecnico.id_aprobado', '=', 'aprobado.id')
            ->join('trimestre_tecnicos', 'matricula_tecnico.id_trimestre', '=', 'trimestre_tecnicos.id')
            ->select('matricula_tecnico.id', 'estudiante.first_nom as nombre', 'estudiante.second_nom as segundonom','estudiante.id as idest', 
            'estudiante.second_ape as segundoape', 'estudiante.firts_ape as primerape',
            'estudiante.telefono', 'estudiante.num_doc', 'tipo_documento.descripcion as destipo', 
            'programa_tecnico.nombretec', 'programa_tecnico.descripcion as destec',
            'aprobado.nombre as aprobado', 'trimestre_tecnicos.nombretri as nomtri', 'matricula_tecnico.anio', 'matricula_tecnico.periodo')
            ->paginate(15);
        }else{
            $b=0;
            $estutec="datos";
        }
        $tecnico =DB::table('programa_tecnico')->get();
        return view('tecnico.listadomat')->with('estutec', $estutec)->with('b', $b)->with('tecnico', $tecnico);
    }

    public function estudiantestec(Request $request){
     
        $estutec=DB::table('matricula_tecnico')->where('matricula_tecnico.id_tecnico', '=', $request->idtec)
                ->where('matricula_tecnico.id_aprobado', '!=', '4')
                ->where('matricula_tecnico.id_aprobado', '!=', '5')
                ->where('matricula_tecnico.id_trimestre', '=', $request->tri)
                ->where('matricula_tecnico.anio', '=', $request->anio)
                ->join('estudiante', 'matricula_tecnico.id_estudiante', '=', 'estudiante.id')
                ->join('programa_tecnico', 'matricula_tecnico.id_tecnico', '=', 'programa_tecnico.id')
                ->join('tipo_documento', 'estudiante.id_tipo_doc', '=', 'tipo_documento.id')
                ->join('aprobado', 'matricula_tecnico.id_aprobado', '=', 'aprobado.id')
                ->join('trimestre_tecnicos', 'matricula_tecnico.id_trimestre', '=', 'trimestre_tecnicos.id')
                ->select('matricula_tecnico.id','estudiante.first_nom as nombre', 'estudiante.second_nom as segundonom',
                'estudiante.second_ape as segundoape', 'estudiante.firts_ape as primerape',
                'estudiante.telefono', 'estudiante.num_doc', 'tipo_documento.descripcion as destipo', 
                'programa_tecnico.nombretec', 'programa_tecnico.descripcion as destec',
                'aprobado.nombre as aprobado', 'trimestre_tecnicos.nombretri as nomtri', 'matricula_tecnico.anio', 'matricula_tecnico.periodo')
                ->get();
        return response(json_decode($estutec),200)->header('Content-type', 'text/plain');

    }

    //actualizar informacion del estuante matriculado

    public function actualizar_mat_tecnico($id){
        $tecmat=DB::table('matricula_tecnico')->where('matricula_tecnico.id', $id)
                 ->join('estudiante', 'matricula_tecnico.id_estudiante', '=', 'estudiante.id')
                 ->join('programa_tecnico', 'matricula_tecnico.id_tecnico', '=', 'programa_tecnico.id')
                ->join('tipo_documento', 'estudiante.id_tipo_doc', '=', 'tipo_documento.id')
                ->join('aprobado', 'matricula_tecnico.id_aprobado', '=', 'aprobado.id')
                ->join('trimestre_tecnicos', 'matricula_tecnico.id_trimestre', '=', 'trimestre_tecnicos.id')
                ->select('matricula_tecnico.id','estudiante.first_nom as nombre', 'estudiante.second_nom as segundonom', 
                'estudiante.second_ape as segundoape', 'estudiante.firts_ape as primerape',
                'estudiante.telefono', 'estudiante.num_doc', 'estudiante.correo', 'tipo_documento.descripcion as destipo', 
                'programa_tecnico.nombretec', 'programa_tecnico.descripcion as destec',
                'aprobado.nombre as aprobado', 'matricula_tecnico.anio', 'matricula_tecnico.periodo', 'matricula_tecnico.fec_matricula',
                'trimestre_tecnicos.nombretri', 'trimestre_tecnicos.id as idtri', 'programa_tecnico.id as idtec')
                ->get();

          $progtec=DB::table('programa_tecnico')->get();
          $trimestre=DB::table('trimestre_tecnicos')->get();

     return view('tecnico.matriculaactu')->with('tecmat', $tecmat)->with('progtec', $progtec)->with('trimestre', $trimestre);
    }

    //actualizzar matricula tecnico 
    public function actumat(Request $request){
        $category = MatriculaTec::findOrfail($request->idmat);
        $category->id_tecnico = $request->input('programatec');
        $category->id_trimestre =$request->input('tri');
        $category->anio =$request->input('anio');
        $category->periodo=$request->input('per');
        $category->fec_matricula = $request->input('fecha');
        $category->save();
        Session::flash('actualizar','Estudiante Actualizado Exitosamente!');
        return back();
    }

    public function estado_mat(Request $request){
        
        $category = MatriculaTec::findOrfail($request->idestudiante);
        $category->id_aprobado = 4;
        $category->save();
        return back();
    }

    public function estado_mat_bachillerato(Request $request){
        
        $category = Matricula::findOrfail($request->idestudiante);
        $category->id_aprobado = 4;
        $category->save();
        return back();
    }

    public function estudiantesbachillerato(Request $request){

        $bachi=DB::table('matriculas')->where('matriculas.id_curso', '=', $request->idbachi)
                 ->where('id_aprobado', '!=', 4)->where('id_aprobado', '!=', 5)
                 ->where('id_aprobado', '!=', 3)->where('matriculas.anio', '=', $request->anio)
                 ->where('matriculas.periodo', '=', $request->per)
                 ->join('estudiante', 'matriculas.id_estudiante', '=', 'estudiante.id')
                ->join('tipo_curso', 'matriculas.id_curso', '=', 'tipo_curso.id')
                ->join('tipo_documento', 'estudiante.id_tipo_doc', '=', 'tipo_documento.id')
                ->join('aprobado', 'matriculas.id_aprobado', '=', 'aprobado.id')
                ->select('matriculas.id as idmat', 'matriculas.id_estudiante as idest', 
                        'matriculas.id_curso as idcur', 'estudiante.first_nom as nombre', 'estudiante.second_nom as segundonom', 
                        'estudiante.second_ape as segundoape', 'estudiante.firts_ape as primerape',
                        'estudiante.telefono', 'estudiante.num_doc', 'tipo_documento.descripcion as destipo', 
                        'tipo_curso.descripcion as nomcurso', 'aprobado.nombre as estadoes', 'matriculas.anio', 'matriculas.periodo')
                ->get();
        return response(json_decode($bachi),200)->header('Content-type', 'text/plain');
    }

    public function actu_mat_bachi($id){//actualizar matriculas bachillerato
        $bachi=DB::table('matriculas')->where('matriculas.id', $id)
        ->join('estudiante', 'matriculas.id_estudiante', '=', 'estudiante.id')
        ->join('tipo_curso', 'matriculas.id_curso', '=', 'tipo_curso.id')
       ->join('tipo_documento', 'estudiante.id_tipo_doc', '=', 'tipo_documento.id')
       ->join('aprobado', 'matriculas.id_aprobado', '=', 'aprobado.id')
       ->select('matriculas.id as idmat','estudiante.first_nom as nombre', 'estudiante.second_nom as segundonom','estudiante.second_ape as segundoape', 'estudiante.firts_ape as primerape',
       'estudiante.telefono', 'estudiante.num_doc', 'estudiante.correo', 'tipo_documento.descripcion as destipo', 
       'tipo_curso.descripcion as curso', 'tipo_curso.id as idcurso',
       'aprobado.nombre as aprobado', 'matriculas.anio', 'matriculas.periodo', 'matriculas.fec_matricula')
       ->get();
       $cursos=DB::table('tipo_curso')->get();
        return view('matriculas.vista_actualizar')->with('bachi', $bachi)->with('cursos', $cursos);
    }
   //actualizzar matricula bachillerato 
    public function actubachi(Request $request){
        $category = Matricula::findOrfail($request->idmat);
        $category->id_curso = $request->input('curso');
        $category->anio =$request->input('anioba');
        $category->periodo=$request->input('perbachiller');
        $category->fec_matricula = $request->input('fecha');
        $category->save();
        Session::flash('actualizar','Estudiante Actualizado Exitosamente!');
        return back();
    }

   
}
  