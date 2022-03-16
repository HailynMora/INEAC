<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;//interacciones con las consultas

class TipoDocumento extends Seeder
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
            'descripcion' => 'Cedula de ciudadania',
            
             ],
            [
             'descripcion' => 'Tarjeta Identidad',
             
            ],
            [
             'descripcion' => 'Cedula Extranjera',
             
            ],
            [
             'descripcion' => 'Pasaporte',
                
            ]

        ];
        DB::table('tipo_documento')->insert($datos);//inserta los datos a la tabla roles
    }
}
