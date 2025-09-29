<?php

namespace Database\Seeders;

use App\Models\EditalAlunoOrientadors;
use Illuminate\Database\Seeder;

class EditalAlunoOrientadorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EditalAlunoOrientadors::factory()->count(100)->create();
    }
}
