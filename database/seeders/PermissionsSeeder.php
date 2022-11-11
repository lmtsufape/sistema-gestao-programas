<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsSeeder extends Seeder 
{
    public function run ()
    {
        $this->create();
    }

    private function create()
    {
        return DB::table('permissions')->insert([
            [
            'name' => 'servidor',
            'guard_name' => 'web',
            'created_at' => date('Y-m-d h:i:s')
            ],
            [
            'name' => 'aluno',
            'guard_name' => 'web',
            'created_at' => date('Y-m-d h:i:s')
            ]
        ]);
    }
}