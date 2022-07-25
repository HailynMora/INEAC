<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;//interacciones con las consultas
use Illuminate\Support\Facades\Hash;


class Users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   $pass="123456789";
        $datos = [//array de datos 
            [
            'name' => 'Default',
            'email' => 'adm@gmail.com',
            'password'=>Hash::make($pass),
            'id_rol'=>1,
            'estado'=>1,
             ]
        ];
        DB::table('users')->insert($datos);//inserta los datos a la tabla roles
    }
}
