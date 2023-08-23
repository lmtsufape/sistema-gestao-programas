<?php

namespace Database\Seeders;

use App\Models\Instituicao;
use Illuminate\Database\Seeder;

class InstituicaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $instituicao1 = Instituicao::create([
            'instituicao' => 'Universidade de Pernambuco',
            'sigla' => 'UPE',
            'cnpj' => '12345678912345',
            'natureza_juridica' => 'universidade',
            'endereco' => 'rua X',
            'numero' => 'S/N',
            'complemento' => 'Casa',
            'CEP' => '55768254',
            'bairro' => 'brasilia',
            'cidade' => 'Garanhuns',
            'estado' => 'PE',
            'representante' => 'Patrícia',
            'cargo_representante' => 'professora'
        ]);
    }
}
