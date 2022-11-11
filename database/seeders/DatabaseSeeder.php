<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            PermissionsSeeder::class,
            AlunosSeeder::class,
            ProfessoresSeeder::class,
            ServidorSeeder::class,
            VinculosSeeder::class
        ]);
    }
}
