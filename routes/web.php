<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Inicio\InicioController;
use App\Http\Controllers\Docentes\docenteController;
use App\Http\Controllers\Estudiantes\EstudiantesController;
use App\Http\Controllers\Estudiantes\EstudiosController;
use App\Http\Controllers\Programas\ProgramasController;
use App\Http\Controllers\Estudiantes\ConsultarController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Docentes\PostDocController;
use App\Http\Controllers\Docentes\ConsultarDocController;
use App\Http\Controllers\Asignatura\asignaturaController;
use App\Http\Controllers\Asignatura\ConsultarAsigController;
use App\Http\Controllers\Asignatura\PostAsigController;
use App\Http\Controllers\Perfil\PerfilController;
use App\Http\Controllers\Matriculas\MatriculasController;
use App\Http\Controllers\Acudiente\AcudienteController;
use App\Http\Controllers\RolesController\Roles;
use App\Http\Controllers\Resportes\ReportesController;
use App\Http\Controllers\Docentes\ReporteAsigController;
use App\Http\Controllers\Calificaciones\CalificacionesController;
use App\Http\Controllers\Calificaciones\HabilitacionesController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\EstudiantesNotas\EstudiantesNotController;

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

Route::get('/', [InicioController::class, 'vistaprin']);
    //return view('usuario.principa_usul');
    //return view('inicio.vista');
  
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
//RUTA DE REGISTRO ESTUDIANTES
Route::get('/registro/estudiantes', [EstudiantesController::class, 'registro'])->middleware(['auth', 'secretaria'])->name('registro_es');
Route::post('/registro/estudiante', [EstudiantesController::class, 'matricula'])->middleware(['auth', 'secretaria'])->name('datosestudiante');

//buscar ESTUDIANTE POR ajax
Route::post('/buscar/estudiante', [EstudiantesController::class, 'busquedares_est'])->middleware(['auth', 'secretaria_docente'])->name('buscarest');

Route::post('/buscar/estudiante/admin', [EstudiantesController::class, 'searchEstuCon'])->middleware(['auth', 'secretaria_docente'])->name('searchEstu');

//RUTA PARA ACTUALIZAR ESTUDIANTES
Route::get('/estudiante/actualizar/{id}', [EstudiantesController::class, 'form_actualizar'])->middleware(['auth', 'secretaria'])->name('actualizar_est');

Route::post('/estudiante/actualizar/{id}', [EstudiantesController::class, 'actualizar_estudiante'])->middleware(['auth', 'secretaria'])->name('actualizar_estudiante');

//RUTA REGISTRO ACUDIENTE
Route::post('/registro/acudiente', [EstudiantesController::class, 'datos'])->middleware(['auth', 'secretaria'])->name('datosacu');
Route::get('/registro/acudientes', [EstudiantesController::class, 'regisacudiente'])->middleware(['auth', 'secretaria'])->name('registro_acu');

//RUTA REPORTE DE ESTUDIANTES
Route::get('visualizar/estudiante',[EstudiantesController::class, 'listar'])->middleware(['auth', 'secretaria_docente'])->name('listarestu');

//RUTA DE CONSULTA DE ESTUDIANTES
Route::get('/estudiantes/consultar', [ConsultarController::class, 'index'])->middleware(['auth', 'secretaria_docente'])->name('conestudiante');
Route::get('posts/search',[PostController::class, 'search'])->name('posts.search')->middleware(['auth', 'secretaria_docente']);
Route::get('posts/show',[PostController::class, 'show'])->name('posts.show')->middleware(['auth', 'secretaria_docente']);

//RUTA DESHABILITAR UN ESTUDIANTE
Route::get('cambiar_estudiante/{id}', [EstudiantesController::class, 'cambiar_estado'])->middleware(['auth', 'secretaria'])->name('cambiarEstad'); 
Route::post('estudiante/estado', [EstudiantesController::class, 'cambiarestado'])->middleware(['auth', 'secretaria'])->name('deshaestudiante'); 


//------------------------------------------FIN RUTAS ESTUDIANTE------------------------------

//---------------------------------------------INICIO RUTAS DOCENTE---------------------------------
//RUTA REGISTRO DOCENTES
Route::get('/docente/registro_docente', [DocenteController::class, 'regdocente'])->middleware(['auth', 'secretaria'])->name('regdocente');
Route::post('/docente/registro_docente', [DocenteController::class, 'datosdoc'])->middleware(['auth', 'secretaria'])->name('datosdoc');

//RUTA LISTADO DOCENTES
Route::get('/docente/listado_docente', [DocenteController::class, 'listado_docente'])->middleware(['auth'])->name('listado_docente');

//RUTA DESHABILITAR UN DOCENTE
Route::get('cambiar_docente/{id}', [DocenteController::class, 'cambiar_estado'])->middleware(['auth', 'secretaria'])->name('cambiarEstado'); 

//RUTA ACTUALIZAR DOCENTE
Route::get('/docente/actualizar/{id}', [DocenteController::class, 'form_actualizar'])->middleware(['auth', 'secretaria'])->name('actualizar_doc');
Route::post('/docente/actualizar/{id}', [DocenteController::class, 'actualizar_docente'])->middleware(['auth', 'secretaria'])->name('actualizar_docente');

//RUTA CONSULTAR DOCENTE
Route::get('/docente/consultar', [ConsultarDocController::class, 'consul_doce'])->middleware(['auth'])->name('condocente');
Route::get('posts/searchD',[PostDocController::class, 'searchD'])->middleware(['auth'])->name('posts.searchD');
Route::get('posts/showD',[PostDocController::class, 'showD'])->middleware(['auth'])->name('posts.showD');

//Route::get('listar/{id}', [DocenteController::class, 'listar'])->middleware(['auth'])->name('listar');

//----------------------------------------------------FIN RUTAS DOCENTE----------------------------------------

//------------------------------------------------------INICIO RUTAS ASIGNATURAS---------------------------------------
//RUTA REGISTRO ASIGNATURAS BACHILLERATOS
Route::post('/asignatura/registro_asignatura', [AsignaturaController::class, 'datosasig'])->middleware(['auth', 'secretaria'])->name('datosasig');

//RUTA REGISTRO ASIGNATURAS TECNICOS
Route::get('/asignatura_tecnicos/registro_asignatura', [AsignaturaController::class, 'regasignaturatec'])->middleware(['auth', 'secretaria'])->name('regasignaturatec');
Route::post('/asignatura_tecnicos/registro_asignatura', [AsignaturaController::class, 'datosasigtec'])->middleware(['auth', 'secretaria'])->name('datosasigtec');

//RUTA VINCULAR DOCENTE A ASIGNATURA BACHILLERATO
Route::get('/asignatura/vincular_docente', [AsignaturaController::class, 'datos'])->middleware(['auth', 'secretaria'])->name('datosasignar');
Route::post('/asignatura/vincular_docente', [AsignaturaController::class, 'vincular'])->middleware(['auth', 'secretaria'])->name('vincular');

//RUTA REPORTE DE ASIGNATURAS BACHILLERATO
Route::get('/asignatura/reporte_asignatura', [AsignaturaController::class, 'reporte'])->middleware(['auth'])->name('reporte');

//buscar ASIGNATURAS BACHILLERATO POR ajax
Route::post('/buscar/asinatura_ciclo', [AsignaturaController::class, 'busquedares_asigc'])->middleware(['auth', 'secretaria_docente'])->name('buscarasigc');

//RUTA REPORTE DE ASIGNATURAS TECNICOS
Route::get('/asignatura_tecnicos/reporte_asignatura', [AsignaturaController::class, 'reportetec'])->middleware(['auth'])->name('reportetec');

//buscar ASIGNATURAS TECNICOS POR ajax
Route::post('/buscar/asinatura_tec', [AsignaturaController::class, 'busquedares_asigt'])->middleware(['auth', 'secretaria_docente'])->name('buscarasigt');

//RUTA CONSULTAR ASIGNATURA BACHILLERATO
Route::get('/asignaturas/consultar', [ConsultarAsigController::class, 'index'])->middleware(['auth'])->name('conasignatura');
Route::get('consultar/search',[PostAsigController::class, 'search'])->middleware(['auth'])->name('posts.searchA');
Route::get('consultar/show',[PostAsigController::class, 'show'])->middleware(['auth'])->name('posts.showA');

//RUTA ACTUALIZAR ASIGNATURAS BACHILLERATO
Route::get('/asignatura/actualizar/{id}', [AsignaturaController::class, 'form_actualizar'])->middleware(['auth', 'secretaria'])->name('actualizar_asig');
Route::post('/asignatura/actualizar/{id}', [AsignaturaController::class, 'actualizar_asignatura'])->middleware(['auth', 'secretaria'])->name('actualizar_asignatura');

//RUTA ACTUALIZAR ASIGNATURAS TECNICOS
Route::get('/asignatura_tecnicos/actualizar/{id}', [AsignaturaController::class, 'form_actualizartec'])->middleware(['auth', 'secretaria'])->name('actualizar_asigtec');
Route::post('/asignatura_tecnicos/actualizar/{id}', [AsignaturaController::class, 'actualizar_asignaturatec'])->middleware(['auth', 'secretaria'])->name('actualizar_asignaturatec');
Route::post('/asignatura_tecnicos/estado', [AsignaturaController::class, 'tecnico_asignatura'])->middleware(['auth', 'secretaria'])->name('deshasigtec');


//RUTA DESHABILITAR ASIGNATURA BACHILLERATO
Route::get('cambiar_as/{id}', [AsignaturaController::class, 'cambiar_asig'])->middleware(['auth', 'secretaria'])->name('cambiarAsig'); 
Route::post('/asignatura/estado', [AsignaturaController::class, 'cambiar_estado'])->middleware(['auth', 'secretaria'])->name('deshasignatura');

//RUTA DESHABILITAR ASIGNATURA TECNICO
Route::get('/cambiar/asigtecnico/{id}', [AsignaturaController::class, 'cambiar_asigtec'])->middleware(['auth', 'secretaria'])->name('deshabilitartec'); 

//RUTA ELIMINAR ASIGNATURA BACHILLERATO
Route::get('eliminar_as/{id}', [AsignaturaController::class, 'eliminar_asig'])->middleware(['auth', 'secretaria'])->name('eliminarAsig'); 

//RUTA DESVINCULAR DOCENTE DE ASIGNATURA BACHILLERATO
Route::get('desvincular/docente/{id}', [AsignaturaController::class, 'desvincular_doc'])->middleware(['auth', 'secretaria'])->name('desvincular_doc'); 

//--------------------------------------------------FIN RUTAS ASIGNATURAS-------------------------------------------------

//------------------------------------------INICIO RUTAS PROGRAMAS------------------------------------------------

//RUTA REPORTE PROGRAMAS BACHILLER
Route::get('/programas/reporte_programas', [ProgramasController::class, 'reporte'])->middleware(['auth'])->name('reporte_pro');

//ruta de publidad
Route::get('/programas/publicidad', [ProgramasController::class, 'publi'])->middleware(['auth', 'secretaria'])->name('publicidad');
Route::post('/programas/publicidad/guardar', [ProgramasController::class, 'savepubli'])->middleware(['auth', 'secretaria'])->name('publicidadg');
Route::get('/estado/publicidad/{id}', [ProgramasController::class, 'camestado'])->middleware(['auth', 'secretaria'])->name('cambiarpub'); 

//RUTA REPORTE PROGRAMAS TECNICOS
Route::get('/programas/reporte_programas_tecnicos', [ProgramasController::class, 'reporte_tecnico'])->middleware(['auth'])->name('reporte_tecnico');

//RUTA REGISTRO PROGRAMAS BACHILLERATO
Route::get('/registrar/programa', [ProgramasController::class, 'index'])->middleware(['auth', 'secretaria'])->name('registrarprog');
Route::post('/registro/programas', [ProgramasController::class, 'registro'])->middleware(['auth', 'secretaria'])->name('regprogramas');

//RUTA CONSULTA PROGRAMA BACHILLERATO
Route::get('/consultar/programa', [ProgramasController::class, 'consulta'])->middleware(['auth'])->name('consultar');
Route::get('busqueda/programas',[ProgramasController::class, 'search'])->middleware(['auth'])->name('busqueda');
Route::get('resultado/programas',[ProgramasController::class, 'show'])->middleware(['auth'])->name('mostrarprog');
//buscar PROGRAMA TECNICO POR ajax
Route::post('/buscar/ciclo', [ProgramasController::class, 'busquedares_ciclo'])->middleware(['auth', 'secretaria'])->name('buscarciclo');



//RUTA REGISTRO PROGRAMAS TECNICOS
Route::get('/registrar/programa_tec', [ProgramasController::class, 'tec'])->middleware(['auth', 'secretaria'])->name('registrarprogtec');
Route::post('/registro/programas_tecnicos', [ProgramasController::class, 'registro_tecnicos'])->middleware(['auth', 'secretaria'])->name('regprogramastec');

//vincular asignaturas a un programa 
//Route::get('/vicular/asignaturas', [ProgramasController::class, 'vincular'])->middleware(['auth', 'secretaria'])->name('vicularAsignaturas');

//buscar PROGRAMA TECNICO POR ajax
Route::post('/buscar/tecnico', [ProgramasController::class, 'busquedares_pro'])->middleware(['auth', 'secretaria'])->name('buscartecpro');

//RUTA LISTADO DE VINCULACION DE AIGNATURAS A UN CURSO BACHILLERATOS
Route::post('/programas/listado_vinculacion', [ProgramasController::class, 'listarvinculacion'])->middleware(['auth', 'secretaria'])->name('listado_asig');

//RUTA DESVINCULAR ASIGNATURA DE UN PROGRAMA BACHILLERATO
Route::get('desvincular/{id}', [ProgramasController::class, 'desvincular'])->middleware(['auth', 'secretaria'])->name('desvincular'); 

//RUTA VINCULACION DE ASIGNATURA A PROGRAMA BACHILLERATO
Route::post('/vicular/asignaturas', [ProgramasController::class, 'regasigcurso'])->middleware(['auth', 'secretaria'])->name('regvincularasig');

//RUTA ACTUALIZAR PROGRAMA BACHILLERATO
Route::get('/programas/actualizar/{id}', [ProgramasController::class, 'form_actualizar'])->middleware(['auth', 'secretaria'])->name('actualizar_prog');
Route::post('/programas/actualizar/{id}', [ProgramasController::class, 'actualizar_programa'])->middleware(['auth', 'secretaria'])->name('actualizar_programa');

//RUTA ACTUALIZAR PROGRAMA TECNICO
Route::get ( '/programastecnicos/actualizar/{id}' , [ProgramasController::class,  'form_actualizar_tecnico' ])-> middleware ([ 'auth' ,  'secretaria' ])-> name ( 'actualizar_prog_tec' ); 
Route::post ( '/programastecnicos/actualizar/{id}' , [ ProgramasController::class,  'actualizar_programa_tecnico' ])-> middleware ([ 'auth' ,  'secretaria' ])-> name ( 'actualizar_programa_tec' ); 

//RUTA CAMBIAR ESTADO PROGRAMA TECNICO
Route::get('cambiar_estado/{id}', [ProgramasController::class, 'cambiar_pro_tec'])->middleware(['auth', 'secretaria'])->name('cambiarProTec'); 

//RUTA CAMBIAR ESTADO PROGRAMA BACHILLERATO
Route::get('cambiar/{id}', [ProgramasController::class, 'cambiar_pro'])->middleware(['auth', 'secretaria'])->name('cambiarPro'); 

//RUTA ACUDIENTE EDITAR
Route::get('/acudiente/actualizar/{id}', [AcudienteController::class, 'form_actualizar'])->middleware(['auth', 'secretaria'])->name('actualizar_acu');
Route::post('/acudiente/actualizar/{id}', [AcudienteController::class, 'actualizar_acudiente'])->middleware(['auth', 'secretaria'])->name('actualizar_acudiente');

Route::get('vincular/{id}', [ProgramasController::class, 'vincu'])->middleware(['auth', 'secretaria'])->name('vincular_a'); 
Route::get('vincularasig/{id}', [ProgramasController::class, 'vincu_asig'])->middleware(['auth', 'secretaria'])->name('vincular_asig'); 
Route::post('/vicular/asignaturas/tecnicos', [ProgramasController::class, 'asig_tec'])->middleware(['auth', 'secretaria'])->name('regvincularasigtec');
Route::get('/programas/listado_vinculacion_tec', [ProgramasController::class, 'listarvinculaciontec'])->middleware(['auth', 'secretaria'])->name('asigtec');

Route::post('/vicular/docentes/tecnicos', [ProgramasController::class, 'doc_asig'])->middleware(['auth', 'secretaria'])->name('regvinculardoctec');


Route::get('/perfil/registrar/usu', [PerfilController::class, 'registrar'])->middleware(['auth', 'secretaria_docente'])->name('regisperfil');

//perfil de usuario
Route::post('/registro/perfil/usuario', [PerfilController::class, 'regdatos'])->middleware(['auth', 'secretaria_docente'])->name('regperfil');
Route::post('/actualizar/perfil/usuario', [PerfilController::class, 'actu'])->middleware(['auth', 'secretaria_docente'])->name('actuperfiluser');
Route::get('vincularasig/{id}', [ProgramasController::class, 'vincu_asig'])->middleware(['auth', 'secretaria'])->name('vincular_asig'); 
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

Route::post('/actualizar/matricula/bachillerato', [MatriculasController::class, 'actubachi'])->middleware(['auth', 'secretaria'])->name('actualizar_matricula_bachi');

//reporte de estudiantes matriculados
Route::get('/admin/reporte/estudiante', [MatriculasController::class, 'listado'])->middleware(['auth', 'secretaria_docente'])->name('listadomatricula');

//filtrar estudiantes por cursos
Route::post('/admin/filtrar/estudiante', [MatriculasController::class, 'filtrares'])->middleware(['auth', 'secretaria_docente'])->name('filtrarestu');

//visuailizar acudiente
Route::get('/admin/visualizar/acudiente', [AcudienteController::class, 'visualizar'])->middleware(['auth', 'secretaria'])->name('visacu');


//manejo de roles
Route::get('/visualizar/roles', [Roles::class, 'index'])->middleware(['auth', 'secretaria'])->name('rolesvis');
Route::post('/modificar/roles/{idrol}', [Roles::class, 'cambiar'])->middleware(['auth', 'secretaria'])->name('cambiarper');
Route::get('/listar/usuarios', [Roles::class, 'listar_usu'])->middleware(['auth', 'secretaria'])->name('listausu');

//matricular tecnicos
Route::post('/matricula/tecnico', [MatriculasController::class, 'matriculatec'])->middleware(['auth', 'secretaria'])->name('matriculatecnico');
Route::get('listado/matricula/tecnico', [MatriculasController::class, 'listado_tec'])->middleware(['auth', 'secretaria'])->name('listado_tecnico');
Route::post('/listado/estudiantes/tecnico', [MatriculasController::class, 'estudiantestec'])->middleware(['auth', 'secretaria'])->name('estutec');
Route::get('/matricula/estudiante/actualizar/{id}', [MatriculasController::class, 'actualizar_mat_tecnico'])->middleware(['auth', 'secretaria'])->name('mat_tec');
Route::post('/actualizar/matricula/tecnico', [MatriculasController::class, 'actumat'])->middleware(['auth', 'secretaria'])->name('actualizar_matricula_tecnico');
Route::get('/cambiar/estado/matricula', [MatriculasController::class, 'estado_mat'])->middleware(['auth', 'secretaria'])->name('cambiar_estado_mat');


Route::get('/programas/listado_vinculacion_tec', [ProgramasController::class, 'listarvinculaciontec'])->middleware(['auth', 'secretaria'])->name('asigtec');

//ruta elimar asigtecnico vinculada
Route::get('/tecnico/asignatura/vin/{id}', [ProgramasController::class, 'eliminartec'])->middleware(['auth', 'secretaria'])->name('elimasig');
//buscar docente ajax
Route::post('/buscar/docente', [docenteController::class, 'busquedares'])->middleware(['auth', 'secretaria_docente'])->name('buscardoc');
Route::get('/estado/docente', [docenteController::class, 'cambiardoc'])->middleware(['auth', 'secretaria'])->name('deshabdocente');
Route::get('/cambiar/estado/matricula/bachillerato', [MatriculasController::class, 'estado_mat_bachillerato'])->middleware(['auth', 'secretaria'])->name('cambiar_estado_bachillerato');
Route::post('/filtrar/estudiantes/bachillerato', [MatriculasController::class, 'estudiantesbachillerato'])->middleware(['auth', 'secretaria'])->name('estubachillerato');

//editar matricula bachillerato
Route::get('/matricula/estudiante/bachillerato/actualizar/{id}', [MatriculasController::class, 'actu_mat_bachi'])->middleware(['auth', 'secretaria']);

//reporte de estudantes exel
Route::get('/reporte/estudiantes/bachillerato/{id}', [ReportesController::class, 'reporte_bachillerato'])->middleware(['auth', 'secretaria']);

//reporte matriculados
Route::get('/reporte/matriculas', [ReportesController::class, 'reporte_matriculados'])->middleware(['auth', 'secretaria'])->name('matriculados_bach');
Route::post('/filtrar/reporte', [ReportesController::class, 'filtrar'])->middleware(['auth', 'secretaria'])->name('filtrarper');
Route::post('/filtrar/reporte/tecnico', [ReportesController::class, 'filtrartec'])->middleware(['auth', 'secretaria'])->name('filtrartecnicos');

//RUTA REPORTE DE ASIGNATURAS DOCENTES
Route::get('/asignatura/reporte', [AsignaturaController::class, 'asig_doc'])->middleware(['auth', 'secretaria_docente'])->name('reporte_asigdoc');

//RUTA REPORTE DE ASIGNATURAS DOCENTES
Route::get('/asignatura/reporte_c', [AsignaturaController::class, 'asig_docc'])->middleware(['auth', 'secretaria_docente'])->name('reporte_asigdocc');


//RUTA LISTADO DOCENTES
Route::get('/docente/listado', [DocenteController::class, 'listado_doc'])->middleware(['auth','secretaria_docente'])->name('listado_doc');

//RUTA REPORTE DE ESTUDIANTES
Route::post('listar/estudiantes',[EstudiantesController::class, 'listar_estudo'])->middleware(['auth', 'secretaria_docente'])->name('listarestudo');

//buscar ASIGNATURAS BACHILLERATO POR ajax
Route::post('/buscar/asinatura_b', [ReporteAsigController::class, 'busquedares_asigc'])->middleware(['auth', 'secretaria_docente'])->name('busasigb');

//buscar ASIGNATURAS TECNICOS POR ajax
Route::post('/objetivos/asignatura/bachiller', [ReporteAsigController::class, 'reg'])->middleware(['auth', 'secretaria_docente'])->name('regisob');

Route::post('/objetivos/asignatura', [ReporteAsigController::class, 'regobtec'])->middleware(['auth', 'secretaria_docente'])->name('regobjettec');

//RUTA INGRESAR NOTAS BACHILLER
Route::get('registro/notas/{id}/{im}/{per}/{asig}',[CalificacionesController::class, 'listado'])->middleware(['auth', 'secretaria_docente'])->name('matcurso');

//RUTA INGRESAR NOTAS TECNICO
Route::get('registro/notas/tecnico/{id}/{im}/{per}/{asig}/{tri}',[CalificacionesController::class, 'listado_tec'])->middleware(['auth', 'secretaria_docente'])->name('tec');

//eliminar objetivos 
Route::get('/eliminar/objetivos/{id}',[ReporteAsigController::class, 'elim_obj'])->middleware(['auth', 'secretaria_docente']);
//filtrar por periodo
Route::post('/objetivos/asignatura/filtrar', [ReporteAsigController::class, 'filtrarobjec'])->middleware(['auth', 'secretaria_docente'])->name('filtrarasignacion');
Route::post('/objetivos/asignatura/tecnico/filtrar', [ReporteAsigController::class, 'filtrar_tec_as'])->middleware(['auth', 'secretaria_docente'])->name('filasig_tecnico');
Route::post('/registro/notas', [CalificacionesController::class, 'regnotas'])->middleware(['auth', 'secretaria_docente'])->name('regnotas');

Route::post('/registro/notas/tecnicos', [CalificacionesController::class, 'regnotastec'])->middleware(['auth', 'secretaria_docente'])->name('regnotastec');


//ver notas estudiante
Route::get('/ver/notas/estudiante/{id}/{id4}',[CalificacionesController::class, 'repnotas'])->middleware(['auth', 'secretaria_docente']);

Route::get('/ver/notas/estudiante/tecnico/{id}/{id4}',[CalificacionesController::class, 'repnotastec'])->middleware(['auth', 'secretaria_docente']);


Route::post('/calcular/nota', [CalificacionesController::class, 'prom'])->middleware(['auth', 'secretaria_docente'])->name('calcular');
Route::post('/actualizar/nota', [CalificacionesController::class, 'actunotas'])->middleware(['auth', 'secretaria_docente'])->name('actualizarNota');

Route::get('//reporte/notas/{id}',[CalificacionesController::class, 'vernotas'])->middleware(['auth', 'secretaria_docente']);
Route::get('/reporte/notas/tecnico/{id}',[CalificacionesController::class, 'vernotastec'])->middleware(['auth', 'secretaria_docente']);


Route::post('/actualizar/nota/tecnico', [CalificacionesController::class, 'actunotastec'])->middleware(['auth', 'secretaria_docente'])->name('actualizarNotaTec');


//Route::get('/reporte/notas/{id}',[CalificacionesController::class, 'vernotas'])->middleware(['auth', 'secretaria_docente']);
Route::post('/generar/pdf/notas', [PDFController::class, 'generatePDF'])->middleware(['auth', 'secretaria_docente'])->name('pdf');
Route::get('/pdf/vista', [PDFController::class, 'vista'])->middleware(['auth', 'secretaria_docente']);
//pdf notas tecnicos
Route::post('/generar/pdf/notas/tecnico', [PDFController::class, 'pdfTec'])->middleware(['auth', 'secretaria_docente'])->name('pdftecniconotas');

//escel de notas bachillerato
Route::post('/reporte/notas/excel', [ReportesController::class, 'excelNotas'])->middleware(['auth', 'secretaria_docente'])->name('excelnotas');
//filtrar notas
Route::post('/filtrar/notas', [CalificacionesController::class, 'filtrar'])->middleware(['auth', 'secretaria_docente'])->name('filtroNotas');
//excel tecnico notas
Route::post('/reporte/notas/excel/tecnico', [ReportesController::class, 'exNotasTecnico'])->middleware(['auth', 'secretaria_docente'])->name('excelnotastecnico');
//filtrar notas tecnicos
Route::post('/filtrar/notas/tecnico', [CalificacionesController::class, 'filtrarNotaTec'])->middleware(['auth', 'secretaria_docente'])->name('filtroNotastec');


//valor habilitacion para docentes
Route::get('/valor/habilitaciones', [HabilitacionesController::class, 'vista'])->middleware(['auth', 'secretaria_docente'])->name('valorHab');
//generar certificado laboral
Route::get('/generar/certificado/laboral', [HabilitacionesController::class, 'laboral'])->middleware(['auth', 'secretaria_docente'])->name('certifLaboral');
Route::get('/generar/certificado/estudiantil/{id}', [HabilitacionesController::class, 'estudiantil'])->middleware(['auth','secretaria'])->name('certifEstu');
Route::get('/generar/certificado/estudiantil_tec/{id}', [HabilitacionesController::class, 'estudiantiltec'])->middleware(['auth','secretaria'])->name('certifEstuTec');
//generar pdf laboral docentes
Route::post('/generar/certificado/pdf', [PDFController::class, 'cerLaboral'])->middleware(['auth', 'secretaria_docente'])->name('pdfLaboral');
//generar pdf certificado estudiantil notas
Route::post('/generar/certificado_es/pdf', [PDFController::class, 'cerEstudiantil'])->middleware(['auth'])->name('pdfEstudiantil');
Route::post('/generar/certificado_not/pdf', [PDFController::class, 'cerNota'])->middleware(['auth'])->name('pdfEstudiantilNot');
//generar pdf certificado estudiantil matricula
Route::post('/generar/certificado_ma/pdf', [PDFController::class, 'matEstudiantil'])->middleware(['auth'])->name('pdfEstudiantilmat');
Route::post('/generar/certificado_matec/pdf', [PDFController::class, 'mattecEstudiantil'])->middleware(['auth','secretaria'])->name('pdfEstudiantilmattec');
Route::get('/generar/certificado_es/pdf/vista', [PDFController::class, 'cervista'])->middleware(['auth'])->name('pdfprueba');
//plan de estudios estudiante
Route::get('/plan/estudios', [EstudiosController::class, 'principal'])->middleware(['auth', 'estudiante'])->name('planEstudios');
Route::get('/plan/estudios/tecnicos', [EstudiosController::class, 'tecnico'])->middleware(['auth', 'estudiante'])->name('planEstudiosTec');
//notas estudiantes Modulo estudiantes
Route::post('/estudiante/notas/periodo', [EstudiantesNotController::class, 'vista'])->middleware(['auth', 'estudiante'])->name('calificacionesEstudiante');

//certificados estudiantes Modulo estudiantes
Route::post('/estudiante/certificado', [EstudiantesNotController::class, 'certificados'])->middleware(['auth', 'estudiante'])->name('certificadosEstudiante');
//certificados matriucla estudiantes Modulo estudiantes
Route::post('/estudiante/certificado/matricula', [EstudiantesNotController::class, 'certificadom'])->middleware(['auth', 'estudiante'])->name('matriculaEstudiante');

//RUTA LISTADO DOCENTES VISTA ESTUDIANTE
Route::get('/listado/docente', [DocenteController::class, 'lis_docente'])->middleware(['auth', 'estudiante'])->name('lis_docente');
//ruta boletin academico
Route::post('/estudiante/boletin', [EstudiantesNotController::class, 'boletin'])->middleware(['auth', 'secretaria'])->name('boletin');
Route::post('/estudiantetec/boletin', [EstudiantesNotController::class, 'boletintec'])->middleware(['auth', 'secretaria'])->name('boletintec');
//ruta boletin academico pdf
Route::post('/estudiante/boletin/pdf', [PDFController::class, 'boletin_es'])->middleware(['auth', 'secretaria'])->name('boletin_es');

//nivelaciones secretaria
Route::post('/nivelaciones', [EstudiantesNotController::class, 'nivelacion'])->middleware(['auth', 'secretaria'])->name('nivelacionEstudiante');
Route::post('/nivelaciones/estudiantes', [EstudiantesNotController::class, 'nivelaciones'])->middleware(['auth', 'secretaria_docente'])->name('nivelacionEstudiantedoc');
Route::get('/estudiantes/nivelaciones', [EstudiantesNotController::class, 'nivel'])->middleware(['auth', 'estudiante'])->name('nivelacionEstudiantes');

Route::post('/nivelaciones/estudiantes/tecnicos', [EstudiantesNotController::class, 'nivelTec'])->middleware(['auth', 'secretaria_docente'])->name('reporteNivelTec');
//perfil estudiante
Route::get('/perfil/estudiante/ver', [PerfilController::class, 'estudiantePEr'])->middleware(['auth', 'estudiante'])->name('perfilEstu');

Route::post('/perfil/estudiante/actualizar', [PerfilController::class, 'actuEstuPerfil'])->middleware(['auth', 'estudiante'])->name('actuPerfil_Estu');


//desactivar user
Route::get('/estado/usuario/{id}', [Roles::class, 'userEstado'])->middleware(['auth', 'secretaria'])->name('cambiarestadoUsu');

//actualizar rol
Route::post('/cambio/rol/user', [Roles::class, 'userRolCambio'])->middleware(['auth', 'secretaria'])->name('cambioRol');
//listar tecnicos estudiantes
Route::post('/reporte/tecnico/estudiantes/docente', [ReportesController::class, 'listadoEsTec'])->middleware(['auth', 'secretaria_docente'])->name('listaEsTecnicos');

//ver tecnicos en secretaria 
Route::post('/reporte/tecnico/estudiantes/admin', [ReportesController::class, 'nivelTecnicos'])->middleware(['auth', 'secretaria'])->name('nivelTecnicosVer');

Route::post('/filtrar/reporte/notas/sec', [ReportesController::class, 'notasSec'])->middleware(['auth', 'secretaria'])->name('filtrarNotasSec');
Route::post('/filtrar/reporte/notas/tec', [ReportesController::class, 'notasTec'])->middleware(['auth', 'secretaria'])->name('filtrarNotasTec');

Route::post('/reporte/estudiantes/notas/tecnico', [ReportesController::class, 'notasEsTec'])->middleware(['auth', 'estudiante'])->name('tecnicoCalf');

//listado docentes
Route::get('/generar/listado/docentes/pdf', [PDFController::class, 'listapdf'])->middleware(['auth'])->name('listapdf');
//carga masiva
//importar usuarios
Route::post('/admin/importar/usuarios', [EstudiantesController::class, 'archivoimpor'])->middleware(['auth', 'secretaria'])->name('usuariosImport');
Route::get('/admin/importar/usuarios/{id}', [EstudiantesController::class, 'archivoselect'])->middleware(['auth', 'secretaria'])->name('cargausu');
Route::get('/admin/eliminar/arc/usuarios/{id}', [EstudiantesController::class, 'archivoelmin'])->middleware(['auth', 'secretaria'])->name('eliminararchivo');
//pdfs

Route::get('/docente/generar/listado/{anio}/{per}/{cur}', [EstudiantesController::class, 'archivopdflista'])->middleware(['auth', 'secretaria_docente'])->name('pdfestudoc');
Route::get('/docente/generar/listado/tecnico/{anio}/{per}/{cur}', [ReportesController::class, 'pdfestutec'])->middleware(['auth', 'secretaria_docente']);
//eliminar objetivos tecnicos
Route::get('/eliminar/objetivostec/{id}',[ReporteAsigController::class, 'elim_objtec'])->middleware(['auth', 'secretaria_docente']);
//recibo de pago desde aqui se debe copiar
Route::post('/estudiante/nivelaciones/recibo', [EstudiantesNotController::class, 'guardar_recibo'])->middleware(['auth', 'secretaria_docente'])->name('recibo');
Route::get('/recibos/estudiante/{id}/{a}', [EstudiantesNotController::class, 'verarchivo'])->middleware(['auth', 'secretaria_docente']);
Route::post('/recibos/estudiante/actualizar', [EstudiantesNotController::class, 'actualizar_recibo'])->middleware(['auth', 'secretaria_docente'])->name('reciboactualizar');
Route::get('/archivo/estudiante/elim/{id}', [EstudiantesNotController::class, 'eliminararchivo'])->middleware(['auth', 'secretaria_docente']);
Route::get('/listado/nivelacion/recibos/{p}/{a}/{pr}', [EstudiantesNotController::class, 'listaarchi'])->middleware(['auth', 'secretaria_docente']);
//nivelaciones estudiantes
Route::get('/listado/nivelacion/estu', [EstudiantesNotController::class, 'listanivestu'])->middleware(['auth'])->name('listanestu');

//recibo de tecnicos
Route::post('/estudiante/tecnico/nivelaciones/recibo', [ReportesController::class, 'recibotecnico'])->middleware(['auth', 'secretaria_docente'])->name('recibotec');
Route::get('/tecnico/nivelacion/recibos/{a}/{p}', [ReportesController::class, 'consulrecibos'])->middleware(['auth', 'secretaria_docente']);
Route::post('/estudiante/tecnico/nivelaciones/recibo/act', [ReportesController::class, 'recibotecnicoactu'])->middleware(['auth', 'secretaria_docente'])->name('reciboactualizartec');
Route::get('/archivo/estudiante/elim/tec/{id}', [ReportesController::class, 'elimrecibotec'])->middleware(['auth', 'secretaria_docente']);
//###########3
Route::get('/recibos/estudiante/tecnico/{id}/{a}', [ReportesController::class, 'consultecarchivo'])->middleware(['auth', 'secretaria_docente']);
//###########eliminar db
Route::get('/vaciar/db', [ReportesController::class, 'vaciardb'])->middleware(['auth', 'secretaria_docente'])->name('eliminardb');

//RUTA LISTADO DE VINCULACION DE AIGNATURAS A UN tecnico
Route::post('/programas/listado_vinculacion/tecnicos', [ProgramasController::class, 'vinculacion_tec'])->middleware(['auth', 'secretaria'])->name('listado_asig_tec');

require __DIR__.'/auth.php';

