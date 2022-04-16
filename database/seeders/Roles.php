<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;//interacciones con las consultas

class Roles extends Seeder
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
            'descripcion' => 'Administrador',
            'id_permiso' => 1
             ],
            [
             'descripcion' => 'Docente',
             'id_permiso' => 2
            ],
            [
             'descripcion' => 'Estudiante',
             'id_permiso' => 3
            ]

             

        ];
        DB::table('roles')->insert($datos);//inserta los datos a la tabla roles
    }
}
