<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;//hace funcionar los auth
use DB;

class Secretaria
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)

    {   
        $admin = DB::table('roles')->where('roles.descripcion', '=', 'Administrador')->select('roles.id')->first();
        $doc = DB::table('roles')->where('roles.descripcion', '=', 'Docente')->select('roles.id')->first();
        if (auth()->check() && (Auth::user()->id_rol==$admin->id || Auth::user()->id_rol==$doc->id)){
            return $next($request);
            }
        else{
            return redirect('dashboard');
        }
            
           
        //##############################
    }
}
