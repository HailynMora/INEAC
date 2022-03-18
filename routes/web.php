<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Inicio\InicioController;
use App\Http\Controllers\Docentes\DocenteController;

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
    return view('usuario.principa_usul');
});
Route::get('/reg', function () {
    return view('prueba');
});
Route::get('/for', function () {
    return view('formulario');
});
Route::get('/dashboard', function () {
    return view('usuario.principa_usul');
})->middleware(['auth'])->name('dashboard');

Route::get('/inicio', [InicioController::class, 'vista'])->name('inicio');

Route::get('/inicio/mision-vision', [InicioController::class, 'mision_vision'])->name('mision_vision');

Route::get('/docente/registro_docente', [DocenteController::class, 'registro_docente'])->name('registro_docente');

Route::get('/docente/listado_docente', [DocenteController::class, 'listado_docente'])->name('listado_docente');


require __DIR__.'/auth.php';
