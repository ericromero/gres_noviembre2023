<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Crea el usuario "Eric Romero Martínez" si no existe
        User::firstOrCreate([
            'name' => 'Eric Romero Martínez',
            'email' => 'ericrm@unam.mx',
            'doi'=>'843913',
            'degree'=>'Mtro.',
            ], [
            'password' => Hash::make('SuperAdmin123###'),
            ])->assignRole('Administrador');

        // Asigna el rol "Administrador" al usuario utilizando Spatie Permission
        // $adminRole = Role::firstOrCreate(['name' => 'Administrador']);
        // $user->assignRole($adminRole);

        //Crea usuarios responsables del los departamentos
        // $user = User::firstOrCreate([
        //     'name' => 'Karina',
        //     'email' => 'karina@unam.mx',
        //     'doi'=>'1001'
        // ], [
        //     'password' => Hash::make('123456'),
        // ]);

        // $user = User::firstOrCreate([
        //     'name' => 'Carlos',
        //     'email' => 'carlos@unam.mx',
        //     'doi'=>'1002'
        // ], [
        //     'password' => Hash::make('123456'),
        // ]);
        // $user = User::firstOrCreate([
        //     'name' => 'Ricardo',
        //     'email' => 'ricardo@unam.mx',
        //     'doi'=>'1003'
        // ], [
        //     'password' => Hash::make('123456'),
        // ]);
        // $user = User::firstOrCreate([
        //     'name' => 'Magda',
        //     'email' => 'magda@unam.mx',
        //     'doi'=>'1004'
        // ], [
        //     'password' => Hash::make('123456'),
        // ]);
        
        
    }
}
