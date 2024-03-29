<?php

namespace App\Http\Controllers\Asignatura;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\DocenteModel\Docente;
use Illuminate\Database\Eloquent\Collection;
use App\Models\ObjetivosModel\Objetivos;
use App\Models\EstadoModel\Estado;
use App\Models\AsignaturaModel\Asignatura;
use App\Models\AsignacionDoModel\Asignaciondo;
use App\Models\AsignaturaModel\AsigProgram;
use App\Models\AsignaturaModel\AsignaturaTecnicos;
use Illuminate\Support\Facades\Auth;

class asignaturaController extends Controller
{
    //registro de asignaturas bachillerato
    public function datosasig(Request $request){
        $cod = $request->input('codigo');
        $nom = $request->input('nombre');
        $res1 = DB::table('asignaturas')->where('codigo','=',$cod)->count();
        $res2 = DB::table('asignaturas')->where('nombre','=',$nom)->count();
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
                $category = new Asignatura();
                $category->nombre = $request->input('nombre');
                $category->codigo = $request->input('codigo');
                $category->intensidad_horaria = $request->input('intensidad_horaria');
                $category->val_habilitacion = $request->input('val_habilitacion');
                $category->id_estado = $request->input('id_estado');
                $category->save();
            }
            
        }
        
        return back();
    }
    //registro asignaturas técnicos
    public function regasignaturatec(){
        $estado=Estado::all();
        return view('asignatura.registro_asig_tec')->with('estado',$estado);
    }
    public function datosasigtec(Request $request){
        $cod = $request->input('codigoasig');
        $nom = $request->input('nombreasig');
        $res1 = DB::table('asig_tecnicos')->where('codigoasig','=',$cod)->count();
        $res2 = DB::table('asig_tecnicos')->where('nombreasig','=',$nom)->count();
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
                $category = new AsignaturaTecnicos();
                $category->nombreasig = $request->input('nomas');
                $category->codigoasig = $request->input('codigo');
                $category->intensidad_horaria = $request->input('intensidad_horaria');
                $category->val_habilitacion = $request->input('val_habilitacion');
                $category->id_estado = $request->input('estado');
                $category->save();
            }
            
        }
        
        return back();
    }
    //vinculacion de docentes a asignaturas
    public function vincular(Request $request){
        $idasig=$request->asignatura;
        $iddoc=$request->docente;
        $resdatos=DB::table('asig_asignaturas')
                 ->where('id_asignaturas', '=', $idasig)->where('id_docente', '=', $iddoc)
                 ->count();
        if($resdatos==0){
            $category = new Asignaciondo();
            $category->descripcion = $request->input('descripcion');
            $category->id_docente = $request->input('docente');
            $category->id_asignaturas = $request->input('asignatura');
            $category->save();
        }
        return back();
    }
    public function datos(){
        $Docente=Docente::all();
        $Asignatura=Asignatura::all();
        $Asignatura = DB::table('asignaturas')
        ->select('asignaturas.id','asignaturas.codigo','asignaturas.nombre','intensidad_horaria','val_habilitacion','estado.descripcion as estado')
        ->join('estado','id_estado','=','estado.id')
        ->get();
        $asig=DB::table('asig_asignaturas')
        ->select('asig_asignaturas.id','asignaturas.codigo','descripcion','docente.nombre as nom_doc','docente.apellido as ape_doc','asignaturas.nombre as asig','intensidad_horaria')
        ->join('docente','id_docente','=','docente.id')
        ->join('asignaturas','id_asignaturas','=','asignaturas.id')
        ->paginate(5);
        return view('asignatura.vincular_docente')->with('docente',$Docente)->with('asignatura',$Asignatura)->with('asig',$asig);
    }
    //reporte de asignaturas bachillerato
    public function reporte(){
        $rep=DB::table('asignaturas')
        ->select('asignaturas.id','asignaturas.codigo','asignaturas.nombre as asig','intensidad_horaria','val_habilitacion','estado.descripcion as estado')
        ->join('estado','id_estado','=','estado.id')
        ->paginate(5);
        return view('asignatura.reporte_asignatura')->with('rep',$rep);
    }
    //reporte de asignaturas tecnico
    public function reportetec(){
        $rep=DB::table('asig_tecnicos')
        ->select('asig_tecnicos.id','asig_tecnicos.codigoasig','asig_tecnicos.nombreasig as asig','intensidad_horaria','val_habilitacion','estado.descripcion as estado')
        ->join('estado','id_estado','=','estado.id')
        ->paginate(5);
        return view('asignatura.reporte_asignaturatec')->with('rep',$rep);
    }
    //actualizar asignaturas bachillerato
    public function form_actualizar($id){
       // $asig = Asignatura::findOrFail($id);
        $estado=Estado::all();
        $asig=DB::table('asignaturas')
        ->where('asignaturas.id','=',$id)
        ->select('asignaturas.id','asignaturas.codigo','asignaturas.nombre as asig','intensidad_horaria','val_habilitacion','estado.descripcion as estado','asignaturas.id_estado')
        ->join('estado','id_estado','=','estado.id')
        ->get();
        return view('asignatura.actualizar_asig', compact('asig','estado'));
    }

    public function actualizar_asignatura(Request $request,$id){
        $category = Asignatura::FindOrFail($id);
        $category->nombre = $request->input('nombre');
        $category->codigo = $request->input('codigo');
        $category->intensidad_horaria = $request->input('intensidad_horaria');
        $category->val_habilitacion = $request->input('val_habilitacion');
        $category->id_estado = $request->input('id_estado');
        $category->save();
        return redirect('/asignatura/reporte_asignatura');

    }
    //actualizar asignaturas tecnico
    public function form_actualizartec($id){
       // $asig = Asignatura::findOrFail($id);
        $estado=Estado::all();
        $asig=DB::table('asig_tecnicos')
        ->where('asig_tecnicos.id','=',$id)
        ->select('asig_tecnicos.id','asig_tecnicos.codigoasig','asig_tecnicos.nombreasig as asig','intensidad_horaria','val_habilitacion','estado.descripcion as estado','asig_tecnicos.id_estado')
        ->join('estado','id_estado','=','estado.id')
        ->get();
        return view('asignatura.actualizar_asigtec', compact('asig','estado'));
    }

    public function actualizar_asignaturatec(Request $request,$id){
        $category = AsignaturaTecnicos::FindOrFail($id);
        $category->nombreasig = $request->input('nombre');
        $category->codigoasig = $request->input('codigo');
        $category->intensidad_horaria = $request->input('intensidad_horaria');
        $category->val_habilitacion = $request->input('val_habilitacion');
        $category->id_estado = $request->input('id_estado');
        $category->save();
        return redirect('/asignatura_tecnicos/reporte_asignatura');

    }
    //cambiar asignatura bachillerato
    public function cambiar_asig($id){
        $asig = Asignatura::find($id);
        $es = $asig->id_estado;
        if($es==2){
            $asig->id_estado = 1;
            $asig->save();
        }else{
            $asig->id_estado = 2;
            $asig->save();
        }        
        return redirect('/asignatura/reporte_asignatura');
    }
    //cambiar asignatura tecnico
    public function cambiar_asigtec($id){
        $asig = AsignaturaTecnicos::find($id);
        $es = $asig->id_estado;
        if($es==2){
            $asig->id_estado = 1;
            $asig->save();
        }else{
            $asig->id_estado = 2;
            $asig->save();
        }        
        return back();
    }
    //eliminar asignaturas
    public function eliminar_asig($id){
        DB::table('asig_asignaturas')->where('id_asignaturas','=',$id)->delete();
        DB::table('cursos') ->where('id_asignatura', '=', $id)->delete();
        Asignatura::find($id)->delete();
        return redirect('/asignatura/reporte_asignatura');
    }
    //desvincular docentes de asignaturas bachillerato
    public function desvincular_doc($id){
        DB::table('asig_asignaturas')->where('id','=',$id)->delete();
        return redirect('/asignatura/vincular_docente');
    }
    //////////////////buscar asignatura bachilleratos////////////////////////
    public function busquedares_asigc(Request $request){
        $busasigc =  $rep=DB::table('asignaturas')->where('asignaturas.nombre','=',$request->nombre)
                            ->select('asignaturas.id','asignaturas.codigo','asignaturas.nombre as asig','intensidad_horaria','val_habilitacion','estado.descripcion as estado')
                            ->join('estado','id_estado','=','estado.id')
                        ->get();
     return response(json_decode($busasigc,JSON_UNESCAPED_UNICODE),200)->header('Content-type', 'text/plain');
    }
    ////////////////////////////////////////

    //////////////////buscar asignatura tecnico////////////////////////
    public function busquedares_asigt(Request $request){
        $busasigt = $rep=DB::table('asig_tecnicos')->where('asig_tecnicos.nombreasig','=',$request->nombre)
                    ->select('asig_tecnicos.id','asig_tecnicos.codigoasig','asig_tecnicos.nombreasig as asig','intensidad_horaria','val_habilitacion','estado.descripcion as estado')
                    ->join('estado','id_estado','=','estado.id')
                    ->get();
     return response(json_decode($busasigt,JSON_UNESCAPED_UNICODE),200)->header('Content-type', 'text/plain');
    }
    ////////////////////////////////////////

    /////////////////////////////////7cambia el estado de la asignatura en busqueda ajax no borrar

    public function cambiar_estado(Request $request){
     
        $asig = Asignatura::find($request->idasig);
        $es = $asig->id_estado;
        if($es==2){
            $asig->id_estado = 1;
            $asig->save();
        }else{
            $asig->id_estado = 2;
            $asig->save();
        }        
        return back();

    }

    public function tecnico_asignatura(Request $request){
     
        $asig = AsignaturaTecnicos::find($request->idasig);
        $es = $asig->id_estado;
        if($es==2){
            $asig->id_estado = 1;
            $asig->save();
        }else{
            $asig->id_estado = 2;
            $asig->save();
        }        
        return back();
    }
    public function asig_doc(){
        $idlog=auth()->id();
        $doc=DB::table('docente')->where('docente.id_usuario', $idlog)->select('docente.id')->first();
        $d= $doc->id;
        $repe=DB::table('asignaturas_tecnicos')
        ->where('asignaturas_tecnicos.id_docente',$d)
        ->join('programa_tecnico','asignaturas_tecnicos.id_tecnico','=','programa_tecnico.id')
        ->join('asig_tecnicos','asignaturas_tecnicos.id_asignaturas','=','asig_tecnicos.id')
        ->join('trimestre_tecnicos','asignaturas_tecnicos.id_trimestre','=','trimestre_tecnicos.id')
        ->select('asignaturas_tecnicos.id as idastec','asig_tecnicos.codigoasig','asig_tecnicos.id as idasig',
                 'asig_tecnicos.nombreasig as asig','intensidad_horaria',
                 'val_habilitacion','programa_tecnico.id as idtec','programa_tecnico.nombretec', 'asignaturas_tecnicos.anio', 
                 'asignaturas_tecnicos.periodo','trimestre_tecnicos.id as idtri', 'trimestre_tecnicos.nombretri as trimestre')
        ->orderBy('asignaturas_tecnicos.id_trimestre', 'ASC')
        ->get();
        $val=DB::table('objetivostec')->count();
        if($val!=0){
            $b=1;
            $ob = DB::table('objetivostec')->get();
        }else{
            $b=0;
            $ob=0;
        }
        return view('asignatura.reporte_asig_doc')->with('repe',$repe)->with('b',$b)->with('ob',$ob);
    }
    public function asig_docc(){
        //'asignaturas.id as ida' se quito
        $idlog=auth()->id();
        $validar=DB::table('docente')->where('docente.id_usuario', '=', $idlog)->select('docente.id')->count();
        if($validar != 0){
            $doc=DB::table('docente')->where('docente.id_usuario', '=', $idlog)->select('docente.id')->first();
            $d= $doc->id;
            $rep=DB::table('cursos')
                ->where('cursos.id_docente',$d)
                ->join('asignaturas','cursos.id_asignatura','=','asignaturas.id')
                ->join('estado','id_estado','=','estado.id')
                ->join('tipo_curso','cursos.id_tipo_curso','=','tipo_curso.id')
                ->select('asignaturas.id as idasig', 'asignaturas.codigo',
                'asignaturas.nombre as asig','intensidad_horaria',
                'val_habilitacion','estado.descripcion as estado',
                'tipo_curso.descripcion as curso', 'cursos.anio',
                'cursos.periodo', 'cursos.id as ida', 'cursos.id_tipo_curso as idcurso')
                ->get();
        //consultar si existe objetivos
        $val=DB::table('objetivos')->count();
        if($val!=0){
            $b=1;
            $ob = DB::table('objetivos')->get();
        }else{
            $b=0;
            $ob=0;
        }
        //validar si muestra el boton
        $ver=DB::table('asignaturas_tecnicos')->where('asignaturas_tecnicos.id_docente', $d)->count();
         //return $rep;
        return view('asignatura.reporte_asig_docc')->with('rep',$rep)->with('ob',$ob)->with('b',$b)->with('boton',$ver);
    }else{
        $r = 0;
        return view('inicio.vista')->with('r', $r);
    }
    }
}
