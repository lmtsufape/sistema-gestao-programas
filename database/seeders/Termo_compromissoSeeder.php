<?php

namespace Database\Seeders;

use App\Models\TermoCompromisso;
use Illuminate\Database\Seeder;

class Termo_compromissoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $termo_compromisso = Termo_compromisso::create([
            'id_programa' => 1
        ]);
    }
}
