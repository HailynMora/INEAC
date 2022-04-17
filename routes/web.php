<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Inicio\InicioController;
use App\Http\Controllers\Docentes\DocenteController;
use App\Http\Controllers\Estudiantes\EstudiantesController;
use App\Http\Controllers\Programas\ProgramasController;
use App\Http\Controllers\Estudiantes\ConsultarController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Docentes\PostDocController;
use App\Http\Controllers\Docentes\ConsultarDocController;
use App\Http\Controllers\Asignatura\AsignaturaController;
use App\Http\Controllers\Asignatura\ConsultarAsigController;
use App\Http\Controllers\Asignatura\PostAsigController;
use App\Http\Controllers\Perfil\PerfilController;
use App\Http\Controllers\Matriculas\MatriculasController;
use App\Http\Controllers\Acudiente\AcudienteController;
use App\Http\Controllers\RolesController\Roles;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    //return view('usuario.principa_usul');
    //return view('inicio.vista');
    return view('inicio');
});
Route::get('/reg', function () {
    return view('prueba');
});
Route::get('/for', function () {//retorna otro login que esta en proceso de crear
    return view('formulario');
});

Route::get('/dashboard', function () {
    return view('inicio.vista'); //aqui retorna a la vista principal cuando este logeado
})->middleware(['auth'])->name('dashboard');

Route::get('/inicio', [InicioController::class, 'vista'])->name('inicio');


Route::get('/inicio/mision-vision', [InicioController::class, 'mision_vision'])->name('mision_vision');
//--------------------------------------------INICIO RUTAS ESTUDIANTE--------------------------------------------
//estudiantes rutas
Route::get('/registro/estudiantes', [EstudiantesController::class, 'registro'])->middleware(['auth', 'secretaria'])->name('registro_es');

Route::get('/estudiante/actualizar/{id}', [EstudiantesController::class, 'form_actualizar'])->middleware(['auth', 'secretaria'])->name('actualizar_est');

Route::post('/estudiante/actualizar/{id}', [EstudiantesController::class, 'actualizar_estudiante'])->middleware(['auth', 'secretaria'])->name('actualizar_estudiante');

//registro estudiante

Route::post('/registro/estudiante', [EstudiantesController::class, 'matricula'])->middleware(['auth', 'secretaria'])->name('datosestudiante');

//acudiente
Route::post('/registro/acudiente', [EstudiantesController::class, 'datos'])->middleware(['auth', 'secretaria'])->name('datosacu');

//acudiente
Route::get('/registro/acudientes', [EstudiantesController::class, 'regisacudiente'])->middleware(['auth', 'secretaria'])->name('registro_acu');

//visualizar estudiante
Route::get('visualizar/estudiante',[EstudiantesController::class, 'listar'])->middleware(['auth', 'secretaria_docente'])->name('listarestu');

//consultar estudiantes
Route::get('/estudiantes/consultar', [ConsultarController::class, 'index'])->middleware(['auth', 'secretaria_docente'])->name('conestudiante');

Route::get('posts/search',[PostController::class, 'search'])->name('posts.search')->middleware(['auth', 'secretaria_docente']);

Route::get('posts/show',[PostController::class, 'show'])->name('posts.show')->middleware(['auth', 'secretaria_docente']);

//ruta cambiar estado
Route::get('cambiar_estudiante/{id}', [EstudiantesController::class, 'cambiar_estado'])->middleware(['auth', 'secretaria'])->name('cambiarEstad'); 


//------------------------------------------FIN RUTAS ESTUDIANTE------------------------------

//---------------------------------------------INICIO RUTAS DOCENTE---------------------------------
//docente
Route::get('/docente/registro_docente', [DocenteController::class, 'regdocente'])->middleware(['auth', 'secretaria'])->name('regdocente');

Route::post('/docente/registro_docente', [DocenteController::class, 'datosdoc'])->middleware(['auth', 'secretaria'])->name('datosdoc');

Route::get('/docente/listado_docente', [DocenteController::class, 'listado_docente'])->middleware(['auth'])->name('listado_docente');

//ruta cambiar estado
Route::get('cambiar_docente/{id}', [DocenteController::class, 'cambiar_estado'])->middleware(['auth', 'secretaria'])->name('cambiarEstado'); 
//ACTUALIZAR DOCENTE

Route::get('/docente/actualizar/{id}', [DocenteController::class, 'form_actualizar'])->middleware(['auth', 'secretaria'])->name('actualizar_doc');

Route::post('/docente/actualizar/{id}', [DocenteController::class, 'actualizar_docente'])->middleware(['auth', 'secretaria'])->name('actualizar_docente');
//LISTAR DOCENTE

//Route::get('/docente/lista_asig/{id}', [DocenteController::class, 'listar_asig'])->name('asig');

//consultar docente
Route::get('/docente/consultar', [ConsultarDocController::class, 'consul_doce'])->middleware(['auth'])->name('condocente');

Route::get('posts/searchD',[PostDocController::class, 'searchD'])->middleware(['auth'])->name('posts.searchD');

Route::get('posts/showD',[PostDocController::class, 'showD'])->middleware(['auth'])->name('posts.showD');

//Route::get('listar/{id}', [DocenteController::class, 'listar'])->middleware(['auth'])->name('listar');

//----------------------------------------------------FIN RUTAS DOCENTE----------------------------------------

//------------------------------------------------------INICIO RUTAS ASIGNATURAS---------------------------------------
//asignatura
Route::get('/asignatura/registro_asignatura', [AsignaturaController::class, 'regasignatura'])->middleware(['auth', 'secretaria'])->name('regasignatura');

Route::post('/asignatura/registro_asignatura', [AsignaturaController::class, 'datosasig'])->middleware(['auth', 'secretaria'])->name('datosasig');

Route::get('/asignatura/vincular_docente', [AsignaturaController::class, 'datos'])->middleware(['auth', 'secretaria'])->name('datosasignar');

Route::post('/asignatura/vincular_docente', [AsignaturaController::class, 'vincular'])->middleware(['auth', 'secretaria'])->name('vincular');

Route::get('/asignatura/reporte_asignatura', [AsignaturaController::class, 'reporte'])->middleware(['auth'])->name('reporte');

Route::get('/asignaturas/consultar', [ConsultarAsigController::class, 'index'])->middleware(['auth'])->name('conasignatura');

Route::get('consultar/search',[PostAsigController::class, 'search'])->middleware(['auth'])->name('posts.searchA');

Route::get('consultar/show',[PostAsigController::class, 'show'])->middleware(['auth'])->name('posts.showA');

Route::get('/asignatura/actualizar/{id}', [AsignaturaController::class, 'form_actualizar'])->middleware(['auth', 'secretaria'])->name('actualizar_asig');

Route::post('/asignatura/actualizar/{id}', [AsignaturaController::class, 'actualizar_asignatura'])->middleware(['auth', 'secretaria'])->name('actualizar_asignatura');

//ruta cambiar estado
Route::get('cambiar_as/{id}', [AsignaturaController::class, 'cambiar_asig'])->middleware(['auth', 'secretaria'])->name('cambiarAsig'); 
//ruta eliminar asignatura
Route::get('eliminar_as/{id}', [AsignaturaController::class, 'eliminar_asig'])->middleware(['auth', 'secretaria'])->name('eliminarAsig'); 

//desvincular asignatura

Route::get('desvincular/docente/{id}', [AsignaturaController::class, 'desvincular_doc'])->middleware(['auth', 'secretaria'])->name('desvincular_doc'); 

//--------------------------------------------------FIN RUTAS ASIGNATURAS-------------------------------------------------

//------------------------------------------INICIO RUTAS PROGRAMAS------------------------------------------------

Route::get('/programas/reporte_programas', [ProgramasController::class, 'reporte'])->middleware(['auth'])->name('reporte_pro');

//programa registrar
Route::get('/registrar/programa', [ProgramasController::class, 'index'])->middleware(['auth', 'secretaria'])->name('registrarprog');

Route::get('/consultar/programa', [ProgramasController::class, 'consulta'])->middleware(['auth'])->name('consultar');

Route::get('busqueda/programas',[ProgramasController::class, 'search'])->middleware(['auth'])->name('busqueda');

Route::get('resultado/programas',[ProgramasController::class, 'show'])->middleware(['auth'])->name('mostrarprog');

//guardar los datos
Route::post('/registro/programas', [ProgramasController::class, 'registro'])->middleware(['auth', 'secretaria'])->name('regprogramas');

//vincular asignaturas a un programa 
Route::get('/vicular/asignaturas', [ProgramasController::class, 'vincular'])->middleware(['auth', 'secretaria'])->name('vicularAsignaturas');
//listado de vinculacion
Route::get('/programas/listado_vinculacion', [ProgramasController::class, 'listarvinculacion'])->middleware(['auth', 'secretaria'])->name('listado_asig');

//desvincular asignatura
Route::get('desvincular/{id}', [ProgramasController::class, 'desvincular'])->middleware(['auth', 'secretaria'])->name('desvincular'); 

//registrar asignatura aun programa a la base de datos
Route::post('/vicular/asignaturas', [ProgramasController::class, 'regasigcurso'])->middleware(['auth', 'secretaria'])->name('regvincularasig');

Route::get('/programas/actualizar/{id}', [ProgramasController::class, 'form_actualizar'])->middleware(['auth', 'secretaria'])->name('actualizar_prog');

Route::post('/programas/actualizar/{id}', [ProgramasController::class, 'actualizar_programa'])->middleware(['auth', 'secretaria'])->name('actualizar_programa');
//ruta cambiar estado
Route::get('cambiar/{id}', [ProgramasController::class, 'cambiar_pro'])->middleware(['auth', 'secretaria'])->name('cambiarPro'); 


Route::get('/perfil/registrar/usu', [PerfilController::class, 'registrar'])->middleware(['auth', 'secretaria_docente'])->name('regisperfil');

//perfil de usuario
Route::post('/registro/perfil/usuario', [PerfilController::class, 'regdatos'])->middleware(['auth', 'secretaria_docente'])->name('regperfil');
Route::post('/actualizar/perfil/usuario', [PerfilController::class, 'actu'])->middleware(['auth', 'secretaria_docente'])->name('actuperfiluser');

//actualizar perfil
Route::get('/perfil/actualizar/usu', [PerfilController::class, 'busperfil'])->middleware(['auth', 'secretaria_docente'])->name('actuperfil');

//matricular estudiante
Route::get('/matricular/estudiante', [MatriculasController::class, 'index'])->middleware(['auth', 'secretaria'])->name('matricularestu');
Route::get('matricular/search',[MatriculasController::class, 'search'])->middleware(['auth', 'secretaria'])->name('postmatricular');
Route::get('matricular/show',[MatriculasController::class, 'show'])->middleware(['auth', 'secretaria'])->name('showmatricular');



Route::get('/admin/matricular/{id}',[MatriculasController::class, 'matriculasvista'])->middleware(['auth', 'secretaria'])->name('matricularadmin');

//mostar cursos para matricular estudiante
Route::get('curso/busqueda',[MatriculasController::class, 'curbus'])->middleware(['auth'])->name('curpostbus');
Route::get('curso/resultado',[MatriculasController::class, 'mosbus'])->middleware(['auth'])->name('mostrarcurbus');

//matricula un estudiante
Route::post('/admin/matricular/estudiante', [MatriculasController::class, 'registromat'])->middleware(['auth', 'secretaria'])->name('regmatricula');
//reporte de estudiantes matriculados
Route::get('/admin/reporte/estudiante', [MatriculasController::class, 'listado'])->middleware(['auth', 'secretaria_docente'])->name('listadomatricula');

//filtrar estudiantes por cursos
Route::post('/admin/filtrar/estudiante', [MatriculasController::class, 'filtrares'])->middleware(['auth', 'secretaria_docente'])->name('filtrarestu');

//visuailizar acudiente
Route::get('/admin/visualizar/acudiente', [AcudienteController::class, 'visualizar'])->middleware(['auth', 'secretaria'])->name('visacu');
//ACUDIENTE EDITAR
Route::get('/acudiente/actualizar/{id}', [AcudienteController::class, 'form_actualizar'])->middleware(['auth', 'secretaria'])->name('actualizar_acu');

Route::post('/acudiente/actualizar/{id}', [AcudienteController::class, 'actualizar_acudiente'])->middleware(['auth', 'secretaria'])->name('actualizar_acudiente');

//manejo de roles
Route::get('/visualizar/roles', [Roles::class, 'index'])->middleware(['auth', 'secretaria'])->name('rolesvis');
Route::post('/modificar/roles/{idrol}', [Roles::class, 'cambiar'])->middleware(['auth', 'secretaria'])->name('cambiarper');
Route::get('/listar/usuarios', [Roles::class, 'listar_usu'])->middleware(['auth', 'secretaria'])->name('listausu');

require __DIR__.'/auth.php';
