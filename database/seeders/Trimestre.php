<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Trimestre extends Seeder
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
            'nombretri' => 'Trimestre I'
             ],
            [
             'nombretri' => 'Trimestre II'
            ],
            [
             'nombretri' => 'Trimestre III'
            ],
            [
              'nombretri' => 'Trimestre IV'
            ],
            [
              'nombretri' => 'Trimestre V'
            ],
            [
              'nombretri' => 'Trimestre VI'
            ],
        ];
        DB::table('trimestre_tecnicos')->insert($datos);
    }
}
