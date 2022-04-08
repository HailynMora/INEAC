<?php

namespace App\Http\Controllers\Matriculas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EstudianteModel\Estudiante;
use Illuminate\Support\Facades\DB;
use App\Models\AsignaturaModel\Programas;
use App\Models\MatriculasModel\Matricula;

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
        
        $estu=Estudiante::findOrfail($id);
        return view('matriculas.vistamatricula', compact('estu'));
    }
    
    //buscar cursos a matricular
    public function curbus(Request $request){
        $results = Programas::where('descripcion', 'LIKE', "%{$request->search}%")->get();
        return view('matriculas.resulcur', compact('results'))->with(['search' => $request->search])->render();
    }
        
    public function mosbus(Request $request){
        $post = Programas::findOrFail($request->id);
        return view('matriculas.mostrarcur', compact('post'))->render();
    }
    
    public function registromat(Request $request){
        $estudiante =Estudiante::findOrfail($request->estu);
        $r=$request->cur;
        //return $r;
        if($r!=null){
            $b=1;
            $curso = Programas::findOrFail($r);
            $category = new Matricula();
            $category->id_estudiante = $request->input('estu');
            $category->id_curso = $request->input('cur');
            $category->fec_matricula = $request->input('fecha');
            $category->save();
            return back()->with('b', $b);
        }
        else{
            $b=0;
            return back()->with('b', $b);
        }
        
    }
   
}
