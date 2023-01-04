<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tipo_servidor;

class Tipo_servidorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipoServidor1 = Tipo_servidor::create([
            'nome' => "servidor"
        ]);

        $tipoServidor1 = Tipo_servidor::create([
            'nome' => "adm"
        ]);

        $tipoServidor1 = Tipo_servidor::create([
            'nome' => "pro_reitor"
        ]);
    }
}
