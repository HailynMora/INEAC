<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Aprobado extends Seeder
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
            'nombre' => 'Cursando'
             ],
            [
             'nombre' => 'Aprobado'
            ],
            [
             'nombre' => 'Reprobado'
            ],
            [
             'nombre' => 'Retirado'
            ],
            [
             'nombre' => 'Finalizado'
            ]

        ];
        DB::table('aprobado')->insert($datos);
    }
}
