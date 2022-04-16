<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use DB;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {   $val=DB::table('roles')->count();
        if($val!=0){
            $b=1;
            $roles=DB::table('roles')->get();
            return view('auth.register')->with('roles', $roles)->with('b', $b);
        }
        else{
            $b=0;
            $roles ="no hay datos";
            return view('auth.register')->with('roles', $roles)->with('b', $b);
        }
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            //'rol' => ['required', 'string', 'rol', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],

        ]);

        $em=$request->numero;
        $cor=$request->email;
        $val=DB::table('estudiante')->where('estudiante.num_doc', '=', $em)->count();
        $doc=DB::table('docente')->where('docente.num_doc', '=', $em)->count();
        if($val==1){
                $es=DB::table('roles')->where('roles.descripcion', '=', 'Estudiante')->select('roles.id as idest')->first();

                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'id_rol' => $es->idest,
                    'password' => Hash::make($request->password),
                ]);
    
                event(new Registered($user));
    
                Auth::login($user);
    
               $dat= DB::table('users')->where('users.email', $cor)->select('users.id')->first(); 
               DB::table('estudiante')->where('estudiante.num_doc', $em)->update(['id_usuario' => $dat->id]);
                return redirect(RouteServiceProvider::HOME);    

            }
            else{
                if($doc==1){
                    $docen=DB::table('roles')->where('roles.descripcion', '=', 'Docente')->select('roles.id as idoc')->first();
                    $user = User::create([
                        'name' => $request->name,
                        'email' => $request->email,
                        'id_rol' => $docen->idoc,
                        'password' => Hash::make($request->password),
                    ]);
        
                    event(new Registered($user));
        
                    Auth::login($user);
        
                   $dato= DB::table('users')->where('users.email', $cor)->select('users.id')->first(); 
                   DB::table('docente')->where('docente.num_doc', $em)->update(['id_usuario' => $dato->id]);
                    return redirect(RouteServiceProvider::HOME);    
    
                }
                else{
                    return back()->with('warning','No se encuentra registrado. comunicate con secretaria!');
                }
            }
          
        
       
    }
}
