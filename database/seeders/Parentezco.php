<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;//interacciones con las consultas

class Parentezco extends Seeder
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
            'descripcion' => 'Padre de familia'
             ],
            [
             'descripcion' => 'Madre de familia'
            ],
            [
             'descripcion' => 'Hermanos mayores de edad'
            ],
            [
             'descripcion' => 'Tio'
            ],
            [
            'descripcion' => 'Otro'
            ],

        ];
        DB::table('parentezco')->insert($datos);//inserta los datos a la tabla roles
    }
}
