<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Inicio\InicioController;

use App\Http\Controllers\Docentes\DocenteController;

use App\Http\Controllers\Estudiantes\EstudiantesController;

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

require __DIR__.'/auth.php';
