<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Inicio\InicioController;
use App\Http\Controllers\Docentes\DocenteController;
use App\Http\Controllers\Estudiantes\EstudiantesController;
use App\Http\Controllers\Programas\ProgramasController;
use App\Http\Controllers\Estudiantes\ConsultarController;
use App\Http\Controllers\PostController;



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

//acudiente
Route::get('/registro/acudientes', [EstudiantesController::class, 'regisacudiente'])->name('registro_acu');


//acudiente
Route::post('/registro/acudiente', [EstudiantesController::class, 'datos'])->name('datosacu');
//registro estudiante

Route::post('/registro/estudiante', [EstudiantesController::class, 'matricula'])->name('datosestudiante');

//consultar docente
Route::get('/consultar/docente', [DocenteController::class, 'consulta'])->name('consultadoc');

//programa registrar
Route::get('/registrar/programa', [ProgramasController::class, 'index'])->name('registrarprog');

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

require __DIR__.'/auth.php';
