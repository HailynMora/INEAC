<?php

namespace App\Http\Controllers\RolesController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RolesModal\Rol;
use DB;

class Roles extends Controller
{
    public function index(){
        $rol=DB::table('roles')->join('permisos', 'roles.id_permiso', '=', 'permisos.id')
            ->select('roles.id as idrol', 'roles.descripcion as nomrol', 'roles.id_permiso as idper', 
            'permisos.descripcion as pdescrip', 'permisos.nombre as name')
            ->orderby('idrol', 'asc')
            ->get();
        $per=DB::table('permisos')->get();
        return view('admin.roles')->with('rol', $rol)->with('per', $per);
    }

    public function cambiar(Request $request, $id){
        $per= $request->radio;
        DB::table('roles')->where('roles.id', $id)->update(['id_permiso' => $per]);
        return back();
    }
}
