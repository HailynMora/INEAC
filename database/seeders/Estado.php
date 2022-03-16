<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;//interacciones con las consultas

class Estado extends Seeder
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
            'descripcion' => 'Activo'
             ],
            [
             'descripcion' => 'Inactivo'
                ]

        ];
        DB::table('estado')->insert($datos);//inserta los datos a la tabla roles
    }
}
