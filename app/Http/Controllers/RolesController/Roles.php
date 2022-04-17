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

    public function listar_usu(){
        $u = DB::table('users')
            ->join('roles','users.id_rol','=','roles.id')
            ->join('permisos','roles.id_permiso','permisos.id')
            ->select('users.id','users.name','users.email','users.id_rol',
                    'roles.id as idrol','roles.descripcion as rol','roles.id_permiso',
                    'permisos.id as idper','permisos.nombre as permiso','permisos.descripcion as despre')
            ->paginate(5);
        return view('admin.reporte')->with('u', $u);
    }
}
