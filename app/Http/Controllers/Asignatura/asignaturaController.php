<?php

namespace App\Http\Controllers\Asignatura;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\DocenteModel\Docente;
use Illuminate\Database\Eloquent\Collection;
use App\Models\ObjetivosModel\Objetivos;
use App\Models\EstadoModel\Estado;
use App\Models\AsignaturaModel\Asignatura;
use App\Models\AsignacionDoModel\Asignaciondo;

class asignaturaController extends Controller
{
    public function regasignatura(){
        $estado=Estado::all();
        return view('asignatura.registro_asignatura')->with('estado',$estado);
    }
    public function datosasig(Request $request){
        $category = new Asignatura();
        $category->nombre = $request->input('nombre');
        $category->codigo = $request->input('codigo');
        $category->intensidad_horaria = $request->input('intensidad_horaria');
        $category->val_habilitacion = $request->input('val_habilitacion');
        $category->id_estado = $request->input('id_estado');
        $category->save();
        return back();
    }
    public function vincular(Request $request){
        $category = new Asignaciondo();
        $category->descripcion = $request->input('descripcion');
        $category->id_docente = $request->input('docente');
        $category->id_asignaturas = $request->input('asignatura');
        $category->save();
        return back();
    }
    public function datos(){
        $Docente=Docente::all();
        $Asignatura=Asignatura::all();
        $asig=DB::table('asig_asignaturas')
        ->select('asignaturas.codigo','descripcion','docente.nombre as nom_doc','docente.apellido as ape_doc','asignaturas.nombre as asig','intensidad_horaria')
        ->join('docente','id_docente','=','docente.id')
        ->join('asignaturas','id_asignaturas','=','asignaturas.id')
        ->get();
        return view('asignatura.vincular_docente')->with('docente',$Docente)->with('asignatura',$Asignatura)->with('asig',$asig);
    }
    public function reporte(){
        $rep=DB::table('asignaturas')
        ->select('asignaturas.codigo','asignaturas.nombre as asig','intensidad_horaria','val_habilitacion','estado.descripcion as estado')
        ->join('estado','id_estado','=','estado.id')
        ->get();
        return view('asignatura.reporte_asignatura')->with('rep',$rep);
    }
    public $asignacion;
    /*public function listado(){
        
        $asig=DB::table('asig_asignaturas')
        ->select('asignaturas.codigo','descripcion','docente.nombre as nom_doc','docente.apellido as ape_doc','asignaturas.nombre as asig','intensidad_horaria')
        ->join('docente','id_docente','=','docente.id')
        ->join('asignaturas','id_asignaturas','=','asignaturas.id')
        ->get();
        $asignacion = json_decode($asig,true);
        $this->asignacion = $asignacion;
        return view('asignatura.vincular_docente',["asignacion"=>$this->asignacion]);
    }*/
   
}
