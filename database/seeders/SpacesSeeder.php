<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Space;
use App\Models\Department;

class SpacesSeeder extends Seeder
{
    public function run()
    {
        //$faker = \Faker\Factory::create();

        $departments = Department::all();

        // Espacio de SUA
        Space::create([
            'department_id' => 1,
            'name' => 'Sala de videoconferencia',
            'location' => 'Edificio B, primer piso',
            'capacity'=>40
        ]);

        // Espacio de UDEMAT
        Space::create([
            'department_id' => 2,
            'name' => 'Sala de maestros',
            'location' => 'Parte posterior del edificio A',
            'capacity'=>20
        ]);

        // Espacio de SASE
        Space::create([
            'department_id' => 3,
            'name' => 'Auditorio Dr. Luis Lara Tapia',
            'location' => 'Planta baja del edificio A',
            'capacity'=>100
        ]);

        // Espacio de SASE
        Space::create([
            'department_id' => 3,
            'name' => 'Auditorio Dra. María Luisa Morales',
            'location' => 'Edificio C, primer piso',
            'capacity'=> 40
        ]);

        // Espacio de POSGRADO
        Space::create([
            'department_id' => 4,
            'name' => 'Auditorio Dra. Silvia Macotela',
            'location' => 'Edificio D, primer piso',
            'capacity'=> 60
        ]);
    }
}

