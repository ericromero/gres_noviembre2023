<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        // Crea el permiso "Gestión de usuarios" si no existe
        $permission = Permission::firstOrCreate(['name' => 'Gestionar usuarios']);
    }
}
