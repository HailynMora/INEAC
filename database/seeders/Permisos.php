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
            'nombre'=>'Todos los permisos',
            'descripcion' => 'Este usuario podrá agregar, modificar y eliminar información.',
             ],
            [
            'nombre'=>'Editor',
            'descripcion' => 'Este usuario podrá leer y editar la información.',
            ],
            [
            'nombre'=>'Lector',
            'descripcion' => 'Este usuario solo podrá observar la información.',
            ],   

        ];
        DB::table('permisos')->insert($datos);//inserta los datos a la tabla roles
    }
}
