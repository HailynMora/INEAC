<?php

namespace App\Http\Controllers\Programas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AsignaturaModel\Programas;
use App\Models\EstadoModel\Estado;
use App\Models\AsignaturaModel\Asignatura;
use App\Models\AsignaturaModel\AsigProgram;


class ProgramasController extends Controller
{
    public function index(){

        $estado=Estado::all();
        return view('programas.registro')->with('estado', $estado);

    }
    public function registro(Request $request){
        
        $category = new Programas();
        $category->codigo = $request->input('codigo');
        $category->descripcion = $request->input('nombre');
        $category->id_estado = $request->input('estado');
        $category->save();
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

}
