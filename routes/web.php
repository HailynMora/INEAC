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
    return view('inicio.vista');
});
Route::get('/reg', function () {
    return view('prueba');
});
Route::get('/for', function () {
    return view('formulario');
});

Route::get('/dashboard', function () {
    return view('inicio.vista'); //aqui retorna a la vista principal cuando este logeado
})->middleware(['auth'])->name('dashboard');

Route::get('/inicio', [InicioController::class, 'vista'])->name('inicio');


Route::get('/inicio/mision-vision', [InicioController::class, 'mision_vision'])->name('mision_vision');
//--------------------------------------------INICIO RUTAS ESTUDIANTE--------------------------------------------
//estudiantes rutas
Route::get('/registro/estudiantes', [EstudiantesController::class, 'registro'])->name('registro_es');

Route::get('/estudiante/actualizar/{id}', [EstudiantesController::class, 'form_actualizar'])->name('actualizar_est');

Route::post('/estudiante/actualizar/{id}', [EstudiantesController::class, 'actualizar_estudiante'])->name('actualizar_estudiante');

//registro estudiante

Route::post('/registro/estudiante', [EstudiantesController::class, 'matricula'])->name('datosestudiante');

//acudiente
Route::post('/registro/acudiente', [EstudiantesController::class, 'datos'])->name('datosacu');

//acudiente
Route::get('/registro/acudientes', [EstudiantesController::class, 'regisacudiente'])->name('registro_acu');

//visualizar estudiante
Route::get('visualizar/estudiante',[EstudiantesController::class, 'listar'])->name('listarestu');

//consultar estudiantes
Route::get('/estudiantes/consultar', [ConsultarController::class, 'index'])->name('conestudiante');

Route::get('posts/search',[PostController::class, 'search'])->name('posts.search');

Route::get('posts/show',[PostController::class, 'show'])->name('posts.show');


//------------------------------------------FIN RUTAS ESTUDIANTE------------------------------

//---------------------------------------------INICIO RUTAS DOCENTE---------------------------------
//docente
Route::get('/docente/registro_docente', [DocenteController::class, 'regdocente'])->name('regdocente');

Route::post('/docente/registro_docente', [DocenteController::class, 'datosdoc'])->name('datosdoc');

Route::get('/docente/listado_docente', [DocenteController::class, 'listado_docente'])->name('listado_docente');
//ACTUALIZAR DOCENTE

Route::get('/docente/actualizar/{id}', [DocenteController::class, 'form_actualizar'])->name('actualizar_doc');

Route::post('/docente/actualizar/{id}', [DocenteController::class, 'actualizar_docente'])->name('actualizar_docente');
//LISTAR DOCENTE

Route::get('/docente/lista_asig/{id}', [DocenteController::class, 'listar_asig'])->name('asig');

//consultar docente
Route::get('/docente/consultar', [ConsultarDocController::class, 'consul_doce'])->name('condocente');

Route::get('posts/searchD',[PostDocController::class, 'searchD'])->name('posts.searchD');

Route::get('posts/showD',[PostDocController::class, 'showD'])->name('posts.showD');

Route::get('listar/{id}', [DocenteController::class, 'listar'])->name('listar');

//----------------------------------------------------FIN RUTAS DOCENTE----------------------------------------

//------------------------------------------------------INICIO RUTAS ASIGNATURAS---------------------------------------
//asignatura
Route::get('/asignatura/registro_asignatura', [AsignaturaController::class, 'regasignatura'])->name('regasignatura');

Route::post('/asignatura/registro_asignatura', [AsignaturaController::class, 'datosasig'])->name('datosasig');

Route::get('/asignatura/vincular_docente', [AsignaturaController::class, 'datos'])->name('datosasignar');

Route::post('/asignatura/vincular_docente', [AsignaturaController::class, 'vincular'])->name('vincular');

Route::get('/asignatura/reporte_asignatura', [AsignaturaController::class, 'reporte'])->name('reporte');

Route::get('/asignaturas/consultar', [ConsultarAsigController::class, 'index'])->name('conasignatura');

Route::get('consultar/search',[PostAsigController::class, 'search'])->name('posts.searchA');

Route::get('consultar/show',[PostAsigController::class, 'show'])->name('posts.showA');

Route::get('/asignatura/actualizar/{id}', [AsignaturaController::class, 'form_actualizar'])->name('actualizar_asig');

Route::post('/asignatura/actualizar/{id}', [AsignaturaController::class, 'actualizar_asignatura'])->name('actualizar_asignatura');

//--------------------------------------------------FIN RUTAS ASIGNATURAS-------------------------------------------------

//------------------------------------------INICIO RUTAS PROGRAMAS------------------------------------------------

Route::get('/programas/reporte_programas', [ProgramasController::class, 'reporte'])->name('reporte_pro');

//programa registrar
Route::get('/registrar/programa', [ProgramasController::class, 'index'])->name('registrarprog');

Route::get('/consultar/programa', [ProgramasController::class, 'consulta'])->name('consultar');

Route::get('busqueda/programas',[ProgramasController::class, 'search'])->name('busqueda');

Route::get('resultado/programas',[ProgramasController::class, 'show'])->name('mostrarprog');

//guardar los datos
Route::post('/registro/programas', [ProgramasController::class, 'registro'])->name('regprogramas');

//vincular asignaturas a un programa 
Route::get('/vicular/asignaturas', [ProgramasController::class, 'vincular'])->name('vicularAsignaturas');

//registrar asignatura aun programa a la base de datos
Route::post('/vicular/asignaturas', [ProgramasController::class, 'regasigcurso'])->name('regvincularasig');

Route::get('/programas/actualizar/{id}', [ProgramasController::class, 'form_actualizar'])->name('actualizar_prog');

Route::post('/programas/actualizar/{id}', [ProgramasController::class, 'actualizar_programa'])->name('actualizar_programa');

Route::get('/perfil/registrar/usu', [PerfilController::class, 'registrar'])->name('regisperfil');

//perfil de usuario
Route::post('/registro/perfil/usuario', [PerfilController::class, 'regdatos'])->name('regperfil');
Route::post('/actualizar/perfil/usuario', [PerfilController::class, 'actu'])->name('actuperfiluser');

//actualizar perfil
Route::get('/perfil/actualizar/usu', [PerfilController::class, 'busperfil'])->name('actuperfil');

//matricular estudiante
Route::get('/matricular/estudiante', [MatriculasController::class, 'index'])->name('matricularestu');
Route::get('matricular/search',[MatriculasController::class, 'search'])->name('postmatricular');
Route::get('matricular/show',[MatriculasController::class, 'show'])->name('showmatricular');



Route::get('/admin/matricular/{id}',[MatriculasController::class, 'matriculasvista'])->name('matricularadmin');

//mostar cursos para matricular estudiante
Route::get('curso/busqueda',[MatriculasController::class, 'curbus'])->name('curpostbus');
Route::get('curso/resultado',[MatriculasController::class, 'mosbus'])->name('mostrarcurbus');

//matricula un estudiante
Route::post('/admin/matricular/estudiante', [MatriculasController::class, 'registromat'])->name('regmatricula');
//reporte de estudiantes matriculados
Route::get('/admin/reporte/estudiante', [MatriculasController::class, 'listado'])->name('listadomatricula');

require __DIR__.'/auth.php';
