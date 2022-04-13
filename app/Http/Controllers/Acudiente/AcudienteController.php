<?php

namespace App\Http\Controllers\Acudiente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\ParentescoModel\Acudiente;
use App\Models\GeneroModel\Genero;
use App\Models\ParentescoModel\Parentesco;
use App\Models\TipoDocumentoModel\TipoDocumento;

class AcudienteController extends Controller
{
    public function visualizar(){
        $val = DB::table('acudiente')->count();
        if($val!=0){
            $b=1;
            $acu = DB::table('acudiente')->join('parentezco', 'acudiente.id_parentesco', '=', 'parentezco.id')
            ->join('tipo_documento', 'acudiente.id_tipo_doc', '=', 'tipo_documento.id')
            ->join('genero', 'acudiente.id_genero', '=', 'genero.id')
            ->where('acudiente.nombre', '!=', 'Default')
            ->select('acudiente.id', 'acudiente.nombre', 'acudiente.apellido', 'acudiente.direccion', 'acudiente.telefono',
            'acudiente.num_doc', 'parentezco.descripcion as parent', 'tipo_documento.descripcion as tipodoc',
            'genero.descripcion as gen')
            ->get();
    
        }
        else{
            $b=0;
            $acu="sin datos";
        }
        return view('acudiente.acudiente')->with('acu', $acu)->with('b', $b);
    }
    public function form_actualizar($id){
        // $est = Estudiante::findOrFail($id);
        $acu = DB::table('acudiente')->join('parentezco', 'acudiente.id_parentesco', '=', 'parentezco.id')
            ->join('tipo_documento', 'acudiente.id_tipo_doc', '=', 'tipo_documento.id')
            ->join('genero', 'acudiente.id_genero', '=', 'genero.id')
            ->where('acudiente.id', '=', $id)
            ->select('acudiente.id', 'acudiente.nombre', 'acudiente.apellido', 'acudiente.direccion', 'acudiente.telefono',
            'acudiente.num_doc','acudiente.id_genero','acudiente.id_tipo_doc','acudiente.id_parentesco', 
            'parentezco.descripcion as parent', 'tipo_documento.descripcion as tipodoc',
            'genero.descripcion as gen')
            ->get();
        $tipodoc=TipoDocumento::all();
        $paren=Parentesco::all();
        $genero=Genero::all();
        return view('acudiente.actualizar', compact('acu','tipodoc','genero','paren'));
     }
     public function actualizar_acudiente(Request $request,$id){
        $category = Acudiente::FindOrFail($id);;
        $category->nombre = $request->input('nombre');
        $category->apellido = $request->input('apellido');
        $category->direccion = $request->input('direccion');
        $category->telefono = $request->input('telefono');
        $category->num_doc = $request->input('numerodoc');
        $category->id_parentesco = $request->input('parentesco');
        $category->id_tipo_doc = $request->input('tipodoc');
        $category->id_genero = $request->input('tipogen');
        $category->save();
         
         return redirect('/admin/visualizar/acudiente');
 
     }
}

/* <div class="row">
                        <div class="col-md-4">Nombre</div>
                        <div class="col-md-4 ml-auto">{{$d->nombre}} {{$d->apellido}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Dirección</div>
                        <div class="col-md-4 ml-auto">{{$d->direccion}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Tipo Doc.</div>
                        <div class="col-md-4 ml-auto">{{$d->tdoces}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Número</div>
                        <div class="col-md-4 ml-auto">{{$d->num_doc}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Genero</div>
                        <div class="col-md-4 ml-auto">{{$d->generoestu}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Etnia</div>
                        <div class="col-md-4 ml-auto">{{$d->etniaestu}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Estrato</div>
                        <div class="col-md-4 ml-auto">{{$d->estrato}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Usuario</div>
                        <div class="col-md-4 ml-auto">{{$d->usuestu}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Acudiente Nombres</div>
                        <div class="col-md-4 ml-auto">{{$d->nomacu}} {{$d->apeacu}} </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Parentesco</div>
                        <div class="col-md-4 ml-auto">{{$d->paren}} </div>
                    </div> */