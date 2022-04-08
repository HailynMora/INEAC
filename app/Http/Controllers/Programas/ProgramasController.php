<?php

namespace App\Http\Controllers\Programas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AsignaturaModel\Programas;
use App\Models\EstadoModel\Estado;
use App\Models\AsignaturaModel\Asignatura;
use App\Models\AsignaturaModel\AsigProgram;
use Illuminate\Support\Facades\DB;


class ProgramasController extends Controller
{
    public function index(){

        $estado=Estado::all();
        return view('programas.registro')->with('estado', $estado);

    }
    public function registro(Request $request){
        $cod=$request->codigo;
        $buscod = DB::table('tipo_curso')->where('codigo', '=', $cod)->count();
        $busnom = DB::table('tipo_curso')->where('descripcion', '=', $request->nombre)->count();
        if($buscod!=0){//validacion con ajax
            return \Response::json([
                'error'  => 'Error datos'
            ],422);
        }else{

            if($busnom!=0){
                return \Response::json([
                    'error'  => 'Error datos'
                ],423);
            }else{
                $category = new Programas();
                $category->codigo = $request->input('codigo');
                $category->descripcion = $request->input('nombre');
                $category->id_estado = $request->input('estado');
                $category->save();
    
            }

        }
        
        return back();

    }

    public function vincular(){
        $curso=Programas::all();
        $asig=Asignatura::all();
        return view('programas.vincularsig')->with('curso', $curso)->with('asignatura', $asig);

    }

    public function regasigcurso(Request $request){
        $category = new AsigProgram();
        //$a=$request->input('asig');
        //$val = AsigProgram::where('id_asignatura', '=', $a)->count();
        //if($val=0){
            $category->id_asignatura = $request->input('asig');
            $category->id_tipo_curso = $request->input('curso');
            $category->fecha = $request->input('fecha');
            $category->save();
        //}
       
        return back();   
    }

    public function consulta(){
        return view('programas.consultar');
    }

    public function search(Request $request){
        $results = Programas::where('descripcion', 'LIKE', "%{$request->search}%")->get();
        return view('programas.results', compact('results'))->with(['search' => $request->search])->render();
    }
        
    public function show(Request $request){
        $post = Programas::findOrFail($request->id);
        return view('programas.post', compact('post'))->render();
    }

    public function reporte(){
        $rep=DB::table('tipo_curso')
        ->select('tipo_curso.id','tipo_curso.codigo','tipo_curso.descripcion as programa','estado.descripcion as estado')
        ->join('estado','id_estado','=','estado.id')
        ->orderBy('tipo_curso.id', 'ASC')
        ->paginate(5); //hacer paginacion de las vistas
        return view('programas.reporte_programas')->with('rep',$rep);
    }
    public function form_actualizar($id){
        $prog = Programas::findOrFail($id);
        $estado=Estado::all();
        return view('programas.actualizar_programa', compact('prog','estado'));
    }

    public function actualizar_programa(Request $request,$id){
        $category = Programas::FindOrFail($id);
        $category->codigo = $request->input('codigo');
        $category->descripcion = $request->input('nombre');
        $category->id_estado = $request->input('estado');
        $category->save();
        return redirect('/asignatura/reporte_asignatura');

    }

}
