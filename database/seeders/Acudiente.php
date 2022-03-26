<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;//interacciones con las consultas

class Acudiente extends Seeder
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
            'nombre' => 'Default',
            'apellido' => 'Default',
            'direccion'=>'Default',
            'telefono'=>'Default',
            'num_doc'=>'Default',
            'id_parentesco'=>1,
            'id_tipo_doc'=>1,
            'id_genero'=>1,
             ]
        ];
        DB::table('acudiente')->insert($datos);//inserta los datos a la tabla roles
    }
}
