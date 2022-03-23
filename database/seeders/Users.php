<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;//interacciones con las consultas

class Users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datos = [//array de datos 
            [
            'name' => 'Default',
            'email' => 'default@gmail.com',
            'password'=>'123456789',
             ]
        ];
        DB::table('users')->insert($datos);//inserta los datos a la tabla roles
    }
}
