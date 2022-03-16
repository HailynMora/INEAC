<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;//interacciones con las consultas

class Permisos extends Seeder
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
            'descripcion' => 'Leer',
            'id_estado' => 1
             ],
            [
             'descripcion' => 'Escribir',
             'id_estado' => 1
            ],
            [
             'descripcion' => 'Eliminar',
             'id_estado' => 1
            ],
            [
            'descripcion' => 'Lectura y escritura',
            'id_estado' => 1
            ],
            [
             'descripcion' => 'Todos los permisos',
             'id_estado' => 1
            ],
    

        ];
        DB::table('permisos')->insert($datos);//inserta los datos a la tabla roles
    }
}
