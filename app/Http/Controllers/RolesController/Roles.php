<?php

namespace App\Http\Controllers\RolesController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RolesModal\Rol;
use DB;
Use Session;

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
            ->select('users.id','users.name','users.email','users.id_rol', 'users.estado',
                    'roles.id as idrol','roles.descripcion as rol','roles.id_permiso',
                    'permisos.id as idper','permisos.nombre as permiso','permisos.descripcion as despre')
            ->paginate(10);


        //consultar el rol para poder editarlo a cada usuario
        $rol = DB::table('roles')
                ->select('roles.id as idrol', 'roles.descripcion as nomrol')->get();

        return view('admin.reporte')->with('u', $u)->with('rol', $rol);
    }
  
    //desactivar o activar users
   public function userEstado($id){
    
    $usu = DB::table('users')->where('users.id', $id)->where('users.estado', '=', '1')->select('users.estado as esta')->count();
      if($usu != 0){

        DB::table('users')->where('users.id', $id)->update(['estado' => 2]); //el estado 2 se desactiva

      }else{

        DB::table('users')->where('users.id', $id)->update(['estado' => 1]);

      }
      Session::flash('infoEs','Se cambio el estado del usuario satisfactoriamente.');
      return back();

   }

   //cambiar el rol del usuario en admin en docente en estudiante
   public function userRolCambio(Request $request){

        DB::table('users')->where('users.id', $request->idusuario)->update(['id_rol' => $request->newrol]);
        Session::flash('infoRol','Usuario actualizado exitosamente.');
        return back();

   }
   
}
