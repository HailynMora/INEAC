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
//estudiantes rutas
Route::get('/registro/estudiantes', [EstudiantesController::class, 'registro'])->name('registro_es');

//docente
Route::get('/docente/registro_docente', [DocenteController::class, 'regdocente'])->name('regdocente');

Route::post('/docente/registro_docente', [DocenteController::class, 'datosdoc'])->name('datosdoc');

Route::get('/docente/listado_docente', [DocenteController::class, 'listado_docente'])->name('listado_docente');

Route::get('/docente/actualizar/{id}', [DocenteController::class, 'form_actualizar'])->name('actualizar_doc');

Route::post('/docente/actualizar/{id}', [DocenteController::class, 'actualizar_docente'])->name('actualizar_docente');
//acudiente
Route::get('/registro/acudientes', [EstudiantesController::class, 'regisacudiente'])->name('registro_acu');


//acudiente
Route::post('/registro/acudiente', [EstudiantesController::class, 'datos'])->name('datosacu');
//registro estudiante

Route::post('/registro/estudiante', [EstudiantesController::class, 'matricula'])->name('datosestudiante');
//asignatura
Route::get('/asignatura/registro_asignatura', [AsignaturaController::class, 'regasignatura'])->name('regasignatura');
Route::post('/asignatura/registro_asignatura', [AsignaturaController::class, 'datosasig'])->name('datosasig');
Route::get('consultar/asignaturas', [AsignaturaController::class, 'consultar'])->name('consultarasig');
Route::get('busqueda/asignaturas',[AsignaturaController::class, 'search'])->name('asigbus');
Route::get('resultado/asignaturas',[AsignaturaController::class, 'show'])->name('mostrarbus');


Route::get('/asignatura/vincular_docente', [AsignaturaController::class, 'datos'])->name('datosasignar');
Route::post('/asignatura/vincular_docente', [AsignaturaController::class, 'vincular'])->name('vincular');
Route::get('/asignatura/reporte_asignatura', [AsignaturaController::class, 'reporte'])->name('reporte');



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


//consultar estudiantes
Route::get('/estudiantes/consultar', [ConsultarController::class, 'index'])->name('conestudiante');
Route::get('posts/search',[PostController::class, 'search'])->name('posts.search');
Route::get('posts/show',[PostController::class, 'show'])->name('posts.show');
//visualizar estudiante
Route::get('visualizar/estudiante',[EstudiantesController::class, 'listar'])->name('listarestu');

//consultar docente
Route::get('/docente/consultar', [ConsultarDocController::class, 'consul_doce'])->name('condocente');
Route::get('posts/searchD',[PostDocController::class, 'searchD'])->name('posts.searchD');
Route::get('posts/showD',[PostDocController::class, 'showD'])->name('posts.showD');


require __DIR__.'/auth.php';
