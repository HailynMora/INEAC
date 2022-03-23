<?php

namespace App\Http\Controllers\Estudiantes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\GeneroModel\Genero;
use App\Models\ParentescoModel\Parentesco;
use App\Models\TipoDocumentoModel\TipoDocumento;
use App\Models\ParentescoModel\Acudiente;
use App\Models\ParentescoModel\EtniaModel;
use App\Models\EstudianteModel\Estudiante;
use App\Models\CertificadoModel\Certificado;
use App\Models\EstadoModel\Estado;
use App\Models\User;

class EstudiantesController extends Controller
{
    public function registro(){
        $tipodoc=TipoDocumento::all();
        $genero=Genero::all();
        $etnia=EtniaModel::all();
        $acu=Acudiente::all();
        $estado=Estado::all();
        $certificado=Certificado::all();
        $user=User::all();
        return view('estudiantes.registroestu')->with('tipodoc', $tipodoc)->with('genero', $genero)->with('etnia', $etnia)->with('acu', $acu)->with('estado', $estado)->with('certificado', $certificado)->with('user', $user);
    }

    public function regisacudiente(){
        $tipodoc=TipoDocumento::all();
        $paren=Parentesco::all();
        $genero=Genero::all();
        return view('estudiantes.acudiente')->with('tipodoc', $tipodoc)->with('paren', $paren)->with('genero', $genero);
    }

    public function datos(Request $request){
        $category = new Acudiente();
        $category->nombre = $request->input('nombre');
        $category->apellido = $request->input('apellido');
        $category->direccion = $request->input('direccion');
        $category->telefono = $request->input('telefono');
        $category->num_doc = $request->input('numerodoc');
        $category->id_parentesco = $request->input('parentesco');
        $category->id_tipo_doc = $request->input('tipodoc');
        $category->id_genero = $request->input('genero');
        $category->save();
        return back();
    }

    public function matricula(Request $request){
       $Registrar = new Estudiante();
        $Registrar->nombre = $request->input('nombre');
        $Registrar->apellido = $request->input('apellido');
        $Registrar->direccion = $request->input('direccion');
        $Registrar->telefono = $request->input('telefono');
        $Registrar->num_doc = $request->input('numerodoc');
        $Registrar->correo = $request->input('correo');
        $Registrar->estrato = $request->input('estrato');
        $Registrar->id_etnia = $request->input('etnia');
        $Registrar->id_genero = $request->input('genero');
        $Registrar->id_acudiente = $request->input('acudiente');
        $Registrar->id_tipo_doc = $request->input('tipodoc');
        $Registrar->id_certificados = $request->input('certificado');
        $Registrar->id_estado = $request->input('estado');
        $Registrar->id_usuario = $request->input('usuario');
        $Registrar->save();
        return back();
    }
}