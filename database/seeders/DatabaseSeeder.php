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
            OrientadorsSeeder::class,
            ServidorSeeder::class
        ]);
    }
}
