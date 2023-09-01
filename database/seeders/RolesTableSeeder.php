<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        // Crea el rol "Administrador" si no existe
        $adminRole = Role::firstOrCreate(['name' => 'Administrador']);
    }
}
