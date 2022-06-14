<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Desempenio extends Seeder
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
            'descripcion' => 'Excelente'
             ],
            [
             'descripcion' => 'Aceptable'
            ],
            [
             'descripcion' => 'Sobresaliente'
            ],
            [
             'descripcion' => 'Insuficiente'
            ],
            [
            'descripcion' => 'Deficiente'
            ]

        ];
        DB::table('desempenos')->insert($datos);//inserta los datos a la tabla roles
    }
}
