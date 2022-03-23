<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;//interacciones con las consultas

class Certificados extends Seeder
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
            'cert_medico' => 'Default',
            'cert_estudios' => 'Default',
            'foto'=>'Default',
            'recibo_energia'=>'Default',
            'copia_doc_estudiante'=>'Default',
            'copia_doc_acudiente'=>'Default',
             ]
        ];
        DB::table('certificados')->insert($datos);//inserta los datos a la tabla roles
    }
}
