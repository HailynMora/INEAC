<?php

namespace App\Http\Controllers\Calificaciones;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\CalificacionesModel\Notas;
use App\Models\CalificacionesModel\NotasTecnico;
use Session;

class CalificacionesController extends Controller
{
    public function listado($id, $anio, $per, $asig){
        $estumat = DB::table('matriculas')
                ->where('id_curso', $id)
                ->where('anio', $anio)->where('periodo', $per)
                ->join('estudiante', 'matriculas.id_estudiante', '=', 'estudiante.id')
                ->join('tipo_curso', 'matriculas.id_curso', '=', 'tipo_curso.id')
                ->join('tipo_documento', 'estudiante.id_tipo_doc', '=', 'tipo_documento.id')
                ->select('matriculas.id as idmat', 'matriculas.id_estudiante as idest', 
                        'matriculas.id_curso as idcur', 'estudiante.first_nom as nombre', 'estudiante.second_nom as segundonom', 
                        'estudiante.second_ape as segundoape', 'estudiante.firts_ape as primerape',
                        'estudiante.telefono', 'estudiante.num_doc', 'tipo_documento.descripcion as destipo', 
                        'tipo_curso.descripcion as nomcurso', 'matriculas.periodo as per', 'matriculas.anio as an')
                ->get();
               $as=DB::table('cursos')
                    ->where('id_tipo_curso','=',$id)
                    ->where('anio','=',$anio)
                    ->where('periodo','=',$per)
                    ->where('id_asignatura','=',$asig)
                    ->join('tipo_curso','cursos.id_tipo_curso','=','tipo_curso.id')
                    ->join('asignaturas','cursos.id_asignatura','=','asignaturas.id')
                    ->join('docente','cursos.id_docente','=','docente.id')
                    ->select('cursos.id as idcur','id_asignatura','asignaturas.nombre',
                             'tipo_curso.descripcion','docente.nombre as nomdoc', 'docente.apellido as apedoc')
                    ->get();
            return view('calificaciones.calificaciones')->with('estumat',$estumat)->with('as',$as);
    }

    public function listado_tec($id,$anio,$per,$asig,$tri){                
        $mates = DB::table('matricula_tecnico')
                ->where('id_tecnico',$id)
                ->where('anio',$anio)
                ->where('periodo',$per)
                ->where('id_trimestre',$tri)
                ->join('estudiante','matricula_tecnico.id_estudiante','=','estudiante.id')
                ->join('programa_tecnico','matricula_tecnico.id_tecnico','=','programa_tecnico.id')
                ->join('tipo_documento', 'estudiante.id_tipo_doc', '=', 'tipo_documento.id')
                ->join('trimestre_tecnicos', 'matricula_tecnico.id_trimestre', '=', 'trimestre_tecnicos.id')
                ->select('matricula_tecnico.id as idmati','matricula_tecnico.id_estudiante as idest',
                        'matricula_tecnico.id_tecnico as idtec','estudiante.first_nom as nombre', 
                        'estudiante.second_nom as segundonom', 'estudiante.second_ape as segundoape', 
                        'estudiante.firts_ape as primerape', 'estudiante.telefono', 'estudiante.num_doc', 
                        'tipo_documento.descripcion as destipo','matricula_tecnico.periodo as per',
                        'matricula_tecnico.anio as an', 'trimestre_tecnicos.nombretri')
                ->get();
        $asig = DB::table('asignaturas_tecnicos')
                ->where('id_asignaturas',$asig)
                ->where('id_tecnico',$id)
                ->where('anio',$anio)
                ->where('periodo',$per)
                ->where('id_trimestre',$tri)
                ->join('programa_tecnico','asignaturas_tecnicos.id_tecnico','=','programa_tecnico.id')
                ->join('asig_tecnicos','asignaturas_tecnicos.id_asignaturas','=','asig_tecnicos.id')
                ->join('docente','asignaturas_tecnicos.id_docente','=','docente.id')
                ->select('asignaturas_tecnicos.id as idastec','id_asignaturas','asig_tecnicos.nombreasig','programa_tecnico.nombretec','docente.nombre as nomdoc', 'docente.apellido as apedoc')
                ->get();
        return view('calificaciones.calificacionestec')->with('mates',$mates)->with('asig',$asig);
    }

    public function regnotas(Request $request){
        $n1 = $request->nota1;
        $p1 = $request->porcentaje1;
        $n2 = $request->nota2;
        $p2 = $request->porcentaje2;
        $n3 = $request->nota3;
        $p3 = $request->porcentaje3;
        $n4 = $request->nota4;
        $p4 = $request->porcentaje4;
        //validar el porcentaje
        $porval = ($p1)+($p2)+($p3)+($p4);
        $val = ($n1*$p1)+($n2*$p2)+($n3*$p3)+($n4*$p4);
        $final = round($val, 1);
        //validar el desempenio
        if($final >= 1 && $final < 3){
                $desempenio = 4;
        }else{
                if($final >= 3 && $final < 4){
                        $desempenio = 2;
                }else{
                        if($final >= 4 && $final < 4.7){
                                $desempenio = 3;

                        }else{
                                if($final >= 4.7 && $final <= 5){
                                        $desempenio = 1;  
                                }else{
                                        $desempenio = 5;

                                }
                        }
                }
        }
        //validar si la nota de un estudiante ya se encuentra para una materia
        if($porval==1){
          $valnotas = DB::table('notas')->where('id_curso', $request->idcur)->where('id_estudiante', $request->idest)->count();
          if($valnotas == 0){
              $category = new Notas();
                $category->nota1= $request->input('nota1');
                $category->por1= $request->input('porcentaje1');
                $category->nota2= $request->input('nota2');
                $category->por2= $request->input('porcentaje2');
                $category->nota3= $request->input('nota3');
                $category->por3= $request->input('porcentaje3');
                $category->nota4= $request->input('nota4');
                $category->por4= $request->input('porcentaje4');
                $category->definitiva= $final;
                $category->id_curso = $request->input('idcur');
                $category->id_estudiante = $request->input('idest');
                $category->id_desempenio = $desempenio;
                $category->save();
                Session::flash('notare','Calificaciones registradas exitosamente.');

                //consular el periodo, el año y el id de la materia que se esta registrando y segun 
                //eso se obtiene el total de materias que tiene ese curso  
               $per = DB::table('cursos')->where('cursos.id', '=', $request->idcur)->select('anio', 'periodo', 'id_tipo_curso')->first();

               //una vez obtenido el periodo y año y curso se busca todos los id que estan vinculados con 
               //esa asignatura y curso 
               $concur = DB::table('cursos')->where('cursos.anio', '=', $per->anio)
                        ->where('cursos.periodo', '=', $per->periodo)
                        ->where('cursos.id_tipo_curso', '=', $per->id_tipo_curso)
                        ->select('cursos.id as idcurso')->get();


                //una vez obtenido el id de materias asignadas(cursos) como son unicos se debe enviar a buscar 
                //en la tabla notas para mirar si tiene todas las materias con nota>=3
                for($i=0; $i<count($concur); $i++){
                        $comparar[$i] =DB::table('notas')->where('id_curso', $concur[$i]->idcurso)
                        ->where('notas.id_Estudiante', '=', $request->idest)
                        ->where('notas.definitiva', '>=', '3')
                        ->count();

                }
                //como retorna desde un count se debe comparar si todas las materias estan una vez en la base de datos
                //con los ids obtenidos si aparece un 0 significa que aun falta materias por registrar
                //si aparece 1 significa que todas las materias estan registradas y con notas mayor a 3
                for($j=0; $j<count($comparar); $j++){
                  if($comparar[$j]==0){
                        $m=0;
                  }else{
                        $m=1;
                  }
                  
                }
                //Si todas las materias tienen nota con mayor a 3 entonces cambia de estado en matriculas
               
                if($m==1){
                  DB::table('matriculas')->where('id_estudiante', $request->idest)
                    ->where('id_aprobado', 1)
                    ->update(['id_aprobado' => 2]);
                    //->where('anio', $per->anio)
                    //->where('anio', $per->periodo)
                }
                //end validacion
                
                }else{
                        Session::flash('notaval','Calificaciones ya se encuentran registradas.');
                }
        }else{
                Session::flash('notaval','Error!. El porcentaje debe sumar 100%');

        }
        return back();
    }
    public function regnotastec(Request $request){
        $n1 = $request->nota1;
        $p1 = $request->porcentaje1;
        $n2 = $request->nota2;
        $p2 = $request->porcentaje2;
        $n3 = $request->nota3;
        $p3 = $request->porcentaje3;
        $n4 = $request->nota4;
        $p4 = $request->porcentaje4;
        //validar el porcentaje
        $porval = ($p1)+($p2)+($p3)+($p4);
        $val = ($n1*$p1)+($n2*$p2)+($n3*$p3)+($n4*$p4);
        $final = round($val, 1);
        //validar el desempenio
        if($final >= 1 && $final < 3){
                $desempenio = 4;
        }else{
                if($final >= 3 && $final < 4){
                        $desempenio = 2;
                }else{
                        if($final >= 4 && $final < 4.7){
                                $desempenio = 3;

                        }else{
                                if($final >= 4.7 && $final <= 5){
                                        $desempenio = 1;  
                                }else{
                                        $desempenio = 5;
                                }
                        }
                }
        }
        //validar si la nota de un estudiante ya se encuentra para una materia
        if($porval==1){
                $valnotas = DB::table('notas_tecnico')->where('id_tecnicos', $request->idcur)->where('id_estudiante', $request->idcur)->count();
              if($valnotas == 0){
                        $category = new NotasTecnico();
                        $category->nota1= $request->input('nota1');
                        $category->por1= $request->input('porcentaje1');
                        $category->nota2= $request->input('nota2');
                        $category->por2= $request->input('porcentaje2');
                        $category->nota3= $request->input('nota3');
                        $category->por3= $request->input('porcentaje3');
                        $category->nota4= $request->input('nota4');
                        $category->por4= $request->input('porcentaje4');
                        $category->definitiva= $final;
                        $category->id_tecnicos = $request->input('idcur');
                        $category->id_estudiante = $request->input('idest');
                        $category->id_desempenio = $desempenio;
                        $category->save();
                        Session::flash('notare','Calificaciones registradas exitosamente.');
                }else{
                        Session::flash('notaval','Calificaciones ya se encuentran registradas.');
                }
        }else{
                Session::flash('notaval','Error!. El porcentaje debe sumar 100%');
        }
        return back();
    }

    public function repnotas($id, $id4){
        $nota = DB::table('notas')->where('id_curso','=',$id4)->where('id_estudiante','=',$id)
                ->join('cursos','notas.id_curso', '=', 'cursos.id')
                ->join('asignaturas','cursos.id_asignatura', '=', 'asignaturas.id')
                ->join('tipo_curso','cursos.id_tipo_curso', '=', 'tipo_curso.id')
                ->join('docente','cursos.id_docente', '=', 'docente.id')
                ->join('estudiante','notas.id_estudiante', '=', 'estudiante.id')
                ->join('desempenos','notas.id_desempenio', '=', 'desempenos.id')
                ->select('estudiante.first_nom as nomes', 'estudiante.second_nom', 
                         'estudiante.firts_ape as apes', 'estudiante.second_ape', 
                         'asignaturas.nombre as asignatura', 'tipo_curso.descripcion as curso', 
                         'docente.nombre as nomdoc', 'docente.apellido as apedoc', 'cursos.anio', 
                         'cursos.periodo', 'notas.id as idnota', 'notas.nota1', 'notas.nota2', 'notas.nota3', 'notas.nota4', 'notas.definitiva',
                         'notas.por1', 'notas.por2', 'notas.por3', 'notas.por4', 'desempenos.descripcion as desem')
                ->get();
        return view('calificaciones.vernota')->with('nota',$nota);
       }

       public function repnotastec($id, $id4){
        $nota = DB::table('notas_tecnico')->where('id_tecnicos','=',$id4)->where('id_estudiante','=',$id)
                ->join('asignaturas_tecnicos','notas_tecnico.id_tecnicos', '=', 'asignaturas_tecnicos.id')
                ->join('asig_tecnicos','asignaturas_tecnicos.id_asignaturas', '=', 'asig_tecnicos.id')
                ->join('programa_tecnico','asignaturas_tecnicos.id_tecnico', '=', 'programa_tecnico.id')
                ->join('docente','asignaturas_tecnicos.id_docente', '=', 'docente.id')
                ->join('estudiante','notas_tecnico.id_estudiante', '=', 'estudiante.id')
                ->join('desempenos','notas_tecnico.id_desempenio', '=', 'desempenos.id')
                ->select('estudiante.first_nom as nomes', 'estudiante.second_nom', 
                         'estudiante.firts_ape as apes', 'estudiante.second_ape', 
                         'asig_tecnicos.nombreasig as asignatura', 'programa_tecnico.nombretec as curso', 
                         'docente.nombre as nomdoc', 'docente.apellido as apedoc', 'asignaturas_tecnicos.anio', 
                         'asignaturas_tecnicos.periodo','notas_tecnico.id as idnota', 'notas_tecnico.nota1', 'notas_tecnico.nota2', 'notas_tecnico.nota3', 
                         'notas_tecnico.nota4', 'notas_tecnico.definitiva','notas_tecnico.por1', 'notas_tecnico.por2', 
                         'notas_tecnico.por3', 'notas_tecnico.por4','desempenos.descripcion as desem')
                ->get();
        return view('calificaciones.vernotatec')->with('nota',$nota);
       }


        public function prom(Request $request){
              return $request;
        }
        public function actunotas(Request $request){
                $n1 = $request->nota1;
                $p1 = $request->porcentaje1;
                $n2 = $request->nota2;
                $p2 = $request->porcentaje2;
                $n3 = $request->nota3;
                $p3 = $request->porcentaje3;
                $n4 = $request->nota4;
                $p4 = $request->porcentaje4;
                $val = ($n1*$p1)+($n2*$p2)+($n3*$p3)+($n4*$p4);
                $final = round($val, 1);
                //actualizar
                if($final >= 1 && $final < 3){
                        $desempenio = 4;
                }else{
                        if($final >= 3 && $final < 4){
                                $desempenio = 2;
                        }else{
                                if($final >= 4 && $final < 4.7){
                                        $desempenio = 3;
        
                                }else{
                                        if($final >= 4.7 && $final <= 5){
                                                $desempenio = 1;  
                                        }else{
                                                $desempenio = 5;
        
                                        }
                                }
                        }
                }
                //validar porcentaje
                $porval = ($p1)+($p2)+($p3)+($p4);
                if($porval == 1){
                        $category = Notas::findOrfail($request->idnota);
                        $category->nota1= $request->input('nota1');
                        $category->por1= $request->input('porcentaje1');
                        $category->nota2= $request->input('nota2');
                        $category->por2= $request->input('porcentaje2');
                        $category->nota3= $request->input('nota3');
                        $category->por3= $request->input('porcentaje3');
                        $category->nota4= $request->input('nota4');
                        $category->por4= $request->input('porcentaje4');
                        $category->definitiva= $final;
                        $category->id_desempenio = $desempenio;
                        $category->save();
                           //consular el periodo, el año y el id de la materia que se esta registrando y segun 
                           //eso se obtiene el total de materias que tiene ese curso  
                                $per = DB::table('cursos')->where('cursos.id', '=', $category->id_curso)->select('anio', 'periodo', 'id_tipo_curso')->first();
                                
                                //una vez obtenido el periodo y año y curso se busca todos los id que estan vinculados con 
                                //esa asignatura y curso 
                                $concur = DB::table('cursos')->where('cursos.anio', '=', $per->anio)
                                                ->where('cursos.periodo', '=', $per->periodo)
                                                ->where('cursos.id_tipo_curso', '=', $per->id_tipo_curso)
                                                ->select('cursos.id as idcurso')->get();


                                        //una vez obtenido el id de materias asignadas(cursos) como son unicos se debe enviar a buscar 
                                        //en la tabla notas para mirar si tiene todas las materias con nota>=3
                                        for($i=0; $i<count($concur); $i++){
                                                $comparar[$i] =DB::table('notas')->where('id_curso', $concur[$i]->idcurso)
                                                ->where('notas.id_Estudiante', '=', $category->id_estudiante)
                                                ->where('notas.definitiva', '>=', '3')
                                                ->count();

                                        }
                                        //como retorna desde un count se debe comparar si todas las materias estan una vez en la base de datos
                                        //con los ids obtenidos si aparece un 0 significa que aun falta materias por registrar
                                        //si aparece 1 significa que todas las materias estan registradas y con notas mayor a 3
                                        for($j=0; $j<count($comparar); $j++){
                                        if($comparar[$j]==0){
                                                $m=0;
                                        }else{
                                                $m=1;
                                        }
                                        
                                        }
                                        //Si todas las materias tienen nota con mayor a 3 entonces cambia de estado en matriculas
                                
                                        if($m==1){
                                        DB::table('matriculas')->where('id_estudiante', $category->id_estudiante)
                                        ->where('id_aprobado', 1)
                                        ->update(['id_aprobado' => 2]);
                                        //->where('anio', $per->anio)
                                        //->where('anio', $per->periodo)
                                        }
                                        //end validacion
                        Session::flash('notac','Actualización realizada exitosamente.');

                }else{

                        Session::flash('erroractu','Error!. El porcentaje debe sumar 100%');

                }
              return back();
            //return response()->json(['res' => $request]);
        }
        public function actunotastec(Request $request){
                $n1 = $request->nota1;
                $p1 = $request->porcentaje1;
                $n2 = $request->nota2;
                $p2 = $request->porcentaje2;
                $n3 = $request->nota3;
                $p3 = $request->porcentaje3;
                $n4 = $request->nota4;
                $p4 = $request->porcentaje4;
                $val = ($n1*$p1)+($n2*$p2)+($n3*$p3)+($n4*$p4);
                $final = round($val, 1);
                //actualizar
                if($final >= 1 && $final < 3){
                        $desempenio = 4;
                }else{
                        if($final >= 3 && $final < 4){
                                $desempenio = 2;
                        }else{
                                if($final >= 4 && $final < 4.7){
                                        $desempenio = 3;
        
                                }else{
                                        if($final >= 4.7 && $final <= 5){
                                                $desempenio = 1;  
                                        }else{
                                                $desempenio = 5;
        
                                        }
                                }
                        }
                }
                //validar porcentaje
                $porval = ($p1)+($p2)+($p3)+($p4);
                if($porval == 1){
                        $category = NotasTecnico::findOrfail($request->idnota);
                        $category->nota1= $request->input('nota1');
                        $category->por1= $request->input('porcentaje1');
                        $category->nota2= $request->input('nota2');
                        $category->por2= $request->input('porcentaje2');
                        $category->nota3= $request->input('nota3');
                        $category->por3= $request->input('porcentaje3');
                        $category->nota4= $request->input('nota4');
                        $category->por4= $request->input('porcentaje4');
                        $category->definitiva= $final;
                        $category->id_desempenio = $desempenio;
                        $category->save();
                        Session::flash('notac','Actualización realizada exitosamente.');

                }else{

                        Session::flash('erroractu','Error!. El porcentaje debe sumar 100%');

                }
                
              return back();
            //return response()->json(['res' => $request]);
        }


        public function vernotas($id){
            $consulta = DB::table('notas')->where('notas.id_curso', $id)
                        ->join('cursos','notas.id_curso', '=', 'cursos.id')
                        ->join('asignaturas','cursos.id_asignatura', '=', 'asignaturas.id')
                        ->join('tipo_curso','cursos.id_tipo_curso', '=', 'tipo_curso.id')
                        ->join('docente','cursos.id_docente', '=', 'docente.id')
                        ->join('estudiante','notas.id_estudiante', '=', 'estudiante.id')
                        ->join('desempenos','notas.id_desempenio', '=', 'desempenos.id')
                        ->select('estudiante.first_nom as nomes', 'estudiante.second_nom as segnom', 
                                'estudiante.firts_ape as apes', 'estudiante.second_ape as sedape', 
                                'asignaturas.nombre as asignatura', 'tipo_curso.descripcion as curso', 
                                'docente.nombre as nomdoc', 'docente.apellido as apedoc', 'cursos.anio', 
                                'cursos.periodo', 'notas.id as idnota', 'notas.nota1', 'notas.nota2', 'notas.nota3', 'notas.nota4', 'notas.definitiva',
                                'notas.por1', 'notas.por2', 'notas.por3', 'notas.por4', 'desempenos.descripcion as desem', 'notas.id_curso as idcur')
                        ->get();
             $objetivos = DB::table('objetivos')->where('objetivos.id_asignaturas', $id)->select('descripcion')->get();
             
            //return $consulta;
            return view('calificaciones.reportenota')->with('consulta', $consulta)->with('objetivos', $objetivos);
        }

        //filtrar notas
        public function filtrar(Request $request){
            $res = $request->filnota;
            $idcur = $request->idcurso;
            if($res == 1){
                $consulta = DB::table('notas')->where('notas.id_curso', $idcur)
                ->where('notas.definitiva', '>=', '3.0')
                ->join('cursos','notas.id_curso', '=', 'cursos.id')
                ->join('asignaturas','cursos.id_asignatura', '=', 'asignaturas.id')
                ->join('tipo_curso','cursos.id_tipo_curso', '=', 'tipo_curso.id')
                ->join('docente','cursos.id_docente', '=', 'docente.id')
                ->join('estudiante','notas.id_estudiante', '=', 'estudiante.id')
                ->join('desempenos','notas.id_desempenio', '=', 'desempenos.id')
                ->select('estudiante.first_nom as nomes', 'estudiante.second_nom as segnom', 
                        'estudiante.firts_ape as apes', 'estudiante.second_ape as sedape', 
                        'asignaturas.nombre as asignatura', 'tipo_curso.descripcion as curso', 
                        'docente.nombre as nomdoc', 'docente.apellido as apedoc', 'cursos.anio', 
                        'cursos.periodo', 'notas.id as idnota', 'notas.nota1', 'notas.nota2', 'notas.nota3', 'notas.nota4', 'notas.definitiva',
                        'notas.por1', 'notas.por2', 'notas.por3', 'notas.por4', 'desempenos.descripcion as desem', 'notas.id_curso as idcur')
                ->get();

            }else{
                if($res==2){

                        $consulta = DB::table('notas')->where('notas.id_curso', $idcur)
                        ->where('notas.definitiva', '<', '3.0')
                        ->join('cursos','notas.id_curso', '=', 'cursos.id')
                        ->join('asignaturas','cursos.id_asignatura', '=', 'asignaturas.id')
                        ->join('tipo_curso','cursos.id_tipo_curso', '=', 'tipo_curso.id')
                        ->join('docente','cursos.id_docente', '=', 'docente.id')
                        ->join('estudiante','notas.id_estudiante', '=', 'estudiante.id')
                        ->join('desempenos','notas.id_desempenio', '=', 'desempenos.id')
                        ->select('estudiante.first_nom as nomes', 'estudiante.second_nom as segnom', 
                                'estudiante.firts_ape as apes', 'estudiante.second_ape as sedape', 
                                'asignaturas.nombre as asignatura', 'tipo_curso.descripcion as curso', 
                                'docente.nombre as nomdoc', 'docente.apellido as apedoc', 'cursos.anio', 
                                'cursos.periodo', 'notas.id as idnota', 'notas.nota1', 'notas.nota2', 'notas.nota3', 'notas.nota4', 'notas.definitiva',
                                'notas.por1', 'notas.por2', 'notas.por3', 'notas.por4', 'desempenos.descripcion as desem', 'notas.id_curso as idcur')
                        ->get();

                }else{
                        $consulta = DB::table('notas')->where('notas.id_curso', $idcur)
                        ->join('cursos','notas.id_curso', '=', 'cursos.id')
                        ->join('asignaturas','cursos.id_asignatura', '=', 'asignaturas.id')
                        ->join('tipo_curso','cursos.id_tipo_curso', '=', 'tipo_curso.id')
                        ->join('docente','cursos.id_docente', '=', 'docente.id')
                        ->join('estudiante','notas.id_estudiante', '=', 'estudiante.id')
                        ->join('desempenos','notas.id_desempenio', '=', 'desempenos.id')
                        ->select('estudiante.first_nom as nomes', 'estudiante.second_nom as segnom', 
                                'estudiante.firts_ape as apes', 'estudiante.second_ape as sedape', 
                                'asignaturas.nombre as asignatura', 'tipo_curso.descripcion as curso', 
                                'docente.nombre as nomdoc', 'docente.apellido as apedoc', 'cursos.anio', 
                                'cursos.periodo', 'notas.id as idnota', 'notas.nota1', 'notas.nota2', 'notas.nota3', 'notas.nota4', 'notas.definitiva',
                                'notas.por1', 'notas.por2', 'notas.por3', 'notas.por4', 'desempenos.descripcion as desem', 'notas.id_curso as idcur')
                        ->get();

                }
            }
            $objetivos = DB::table('objetivos')->where('objetivos.id_asignaturas', $idcur)->select('descripcion')->get();
            return view('calificaciones.reportenota')->with('consulta', $consulta)->with('objetivos', $objetivos);
        }
        public function vernotastec($id){
                $consulta = DB::table('notas_tecnico')->where('notas_tecnico.id_tecnicos','=',$id)
                        ->join('asignaturas_tecnicos','notas_tecnico.id_tecnicos', '=', 'asignaturas_tecnicos.id')
                        ->join('asig_tecnicos','asignaturas_tecnicos.id_asignaturas', '=', 'asig_tecnicos.id')
                        ->join('programa_tecnico','asignaturas_tecnicos.id_tecnico', '=', 'programa_tecnico.id')
                        ->join('docente','asignaturas_tecnicos.id_docente', '=', 'docente.id')
                        ->join('estudiante','notas_tecnico.id_estudiante', '=', 'estudiante.id')
                        ->join('desempenos','notas_tecnico.id_desempenio', '=', 'desempenos.id')
                        ->select('estudiante.first_nom as nomes', 'estudiante.second_nom as segnom', 
                                'estudiante.firts_ape as apes', 'estudiante.second_ape as sedape', 
                                'asig_tecnicos.nombreasig as asignatura', 'programa_tecnico.nombretec as curso', 
                                'docente.nombre as nomdoc', 'docente.apellido as apedoc', 'asignaturas_tecnicos.anio', 
                                'asignaturas_tecnicos.periodo', 'notas_tecnico.id as idnota', 'notas_tecnico.nota1', 'notas_tecnico.nota2', 'notas_tecnico.nota3', 'notas_tecnico.nota4', 'notas_tecnico.definitiva',
                                'notas_tecnico.por1', 'notas_tecnico.id_tecnicos as idcur', 'notas_tecnico.por2', 'notas_tecnico.por3', 'notas_tecnico.por4', 'desempenos.descripcion as desem')
                        ->get();
                //objetivos
                $objetivos = DB::table('objetivostec')->where('id_asignaturas', $id)->select('descripcion as obj')->get();
                //return $consulta;
                return view('calificaciones.reportenotatec')->with('consulta', $consulta)->with('objetivos', $objetivos);
            }

            //filtrar notas tecnicos
            public function filtrarNotaTec(Request $request){
                $res = $request->filnota;
                $idcur = $request->idcurso;
                if($res == 1){
                        $consulta = DB::table('notas_tecnico')->where('notas_tecnico.id_tecnicos','=',$idcur)
                        ->where('notas_tecnico.definitiva', '>=', '3')
                         ->join('asignaturas_tecnicos','notas_tecnico.id_tecnicos', '=', 'asignaturas_tecnicos.id')
                         ->join('asig_tecnicos','asignaturas_tecnicos.id_asignaturas', '=', 'asig_tecnicos.id')
                         ->join('programa_tecnico','asignaturas_tecnicos.id_tecnico', '=', 'programa_tecnico.id')
                         ->join('docente','asignaturas_tecnicos.id_docente', '=', 'docente.id')
                         ->join('estudiante','notas_tecnico.id_estudiante', '=', 'estudiante.id')
                         ->join('desempenos','notas_tecnico.id_desempenio', '=', 'desempenos.id')
                         ->select('estudiante.first_nom as nomes', 'estudiante.second_nom as segnom', 
                                 'estudiante.firts_ape as apes', 'estudiante.second_ape as sedape', 
                                 'asig_tecnicos.nombreasig as asignatura', 'programa_tecnico.nombretec as curso', 
                                 'docente.nombre as nomdoc', 'docente.apellido as apedoc', 'asignaturas_tecnicos.anio', 
                                 'asignaturas_tecnicos.periodo', 'notas_tecnico.id as idnota', 'notas_tecnico.nota1', 'notas_tecnico.nota2', 'notas_tecnico.nota3', 'notas_tecnico.nota4', 'notas_tecnico.definitiva',
                                 'notas_tecnico.por1', 'notas_tecnico.id_tecnicos as idcur', 'notas_tecnico.por2', 'notas_tecnico.por3', 'notas_tecnico.por4', 'desempenos.descripcion as desem')
                         ->get();
                }else{
                    if($res==2){
                        $consulta = DB::table('notas_tecnico')->where('notas_tecnico.id_tecnicos','=',$idcur)
                       ->where('notas_tecnico.definitiva', '<', '3')
                        ->join('asignaturas_tecnicos','notas_tecnico.id_tecnicos', '=', 'asignaturas_tecnicos.id')
                        ->join('asig_tecnicos','asignaturas_tecnicos.id_asignaturas', '=', 'asig_tecnicos.id')
                        ->join('programa_tecnico','asignaturas_tecnicos.id_tecnico', '=', 'programa_tecnico.id')
                        ->join('docente','asignaturas_tecnicos.id_docente', '=', 'docente.id')
                        ->join('estudiante','notas_tecnico.id_estudiante', '=', 'estudiante.id')
                        ->join('desempenos','notas_tecnico.id_desempenio', '=', 'desempenos.id')
                        ->select('estudiante.first_nom as nomes', 'estudiante.second_nom as segnom', 
                                'estudiante.firts_ape as apes', 'estudiante.second_ape as sedape', 
                                'asig_tecnicos.nombreasig as asignatura', 'programa_tecnico.nombretec as curso', 
                                'docente.nombre as nomdoc', 'docente.apellido as apedoc', 'asignaturas_tecnicos.anio', 
                                'asignaturas_tecnicos.periodo', 'notas_tecnico.id as idnota', 'notas_tecnico.nota1', 'notas_tecnico.nota2', 'notas_tecnico.nota3', 'notas_tecnico.nota4', 'notas_tecnico.definitiva',
                                'notas_tecnico.por1', 'notas_tecnico.id_tecnicos as idcur', 'notas_tecnico.por2', 'notas_tecnico.por3', 'notas_tecnico.por4', 'desempenos.descripcion as desem')
                        ->get();
                           
    
                    }else{
                        $consulta = DB::table('notas_tecnico')->where('notas_tecnico.id_tecnicos','=',$idcur)
                         ->join('asignaturas_tecnicos','notas_tecnico.id_tecnicos', '=', 'asignaturas_tecnicos.id')
                         ->join('asig_tecnicos','asignaturas_tecnicos.id_asignaturas', '=', 'asig_tecnicos.id')
                         ->join('programa_tecnico','asignaturas_tecnicos.id_tecnico', '=', 'programa_tecnico.id')
                         ->join('docente','asignaturas_tecnicos.id_docente', '=', 'docente.id')
                         ->join('estudiante','notas_tecnico.id_estudiante', '=', 'estudiante.id')
                         ->join('desempenos','notas_tecnico.id_desempenio', '=', 'desempenos.id')
                         ->select('estudiante.first_nom as nomes', 'estudiante.second_nom as segnom', 
                                 'estudiante.firts_ape as apes', 'estudiante.second_ape as sedape', 
                                 'asig_tecnicos.nombreasig as asignatura', 'programa_tecnico.nombretec as curso', 
                                 'docente.nombre as nomdoc', 'docente.apellido as apedoc', 'asignaturas_tecnicos.anio', 
                                 'asignaturas_tecnicos.periodo', 'notas_tecnico.id as idnota', 'notas_tecnico.nota1', 'notas_tecnico.nota2', 'notas_tecnico.nota3', 'notas_tecnico.nota4', 'notas_tecnico.definitiva',
                                 'notas_tecnico.por1', 'notas_tecnico.id_tecnicos as idcur', 'notas_tecnico.por2', 'notas_tecnico.por3', 'notas_tecnico.por4', 'desempenos.descripcion as desem')
                         ->get();
                          
    
                    }
                }

                $objetivos = DB::table('objetivostec')->where('id_asignaturas', $idcur)->select('objetivostec.descripcion as objetivo')->get();
                return view('calificaciones.reportenotatec')->with('consulta', $consulta)->with('objetivos', $objetivos);
              
            }

          

}
