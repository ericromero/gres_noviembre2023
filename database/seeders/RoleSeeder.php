<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $RoleAdmin=Role::create(['name'=>'Administrador']);
        $RoleCoordinador=Role::create(['name'=>'Coordinador']);
        $RoleGestor=Role::create(['name'=>'Gestor de eventos']);
        $RoleGestor=Role::create(['name'=>'Gestor de espacios']);
        $RoleGestor=Role::create(['name'=>'Gestor de transmision']);
        $RoleGestor=Role::create(['name'=>'Gestor de grabacion']);

        $CUsuarios=Permission::create(['name'=>'Crear usuarios']);
        $RUsuarios=Permission::create(['name'=>'Ver usuarios']);
        $UUsuarios=Permission::create(['name'=>'Actualizar usuarios']);
        $DUsuarios=Permission::create(['name'=>'Borrar usuarios']);

        $CUsuarios->syncRoles([$RoleAdmin,$RoleCoordinador,$RoleGestor]);
        $RUsuarios->syncRoles([$RoleAdmin,$RoleCoordinador,$RoleGestor]);
        $UUsuarios->assignRole($RoleAdmin);
        $DUsuarios->assignRole($RoleAdmin);

    }
}
