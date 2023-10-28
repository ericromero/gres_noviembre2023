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

        // Espacio de UDEMAT
        Space::create([
            'department_id' => 8,
            'name' => 'Sala de cómputo',
            'location' => 'Parte posterior del edificio A',
            'capacity'=>20
        ]);

        // Espacio de SASE
        Space::create([
            'department_id' => 9,
            'name' => 'Auditorio Dr. Luis Lara Tapia',
            'location' => 'Planta baja del edificio A',
            'capacity'=>138
        ]);

        // Espacio de POSGRADO
        Space::create([
            'department_id' => 4,
            'name' => 'Auditorio Dra. Silvia Macotela',
            'location' => 'Edificio D, primer piso',
            'capacity'=> 69
        ]);

        // Espacio de POSGRADO
        Space::create([
            'department_id' => 4,
            'name' => 'Auditorio Dr. Florente López',
            'location' => 'Edificio D, primer piso',
            'capacity'=> 39
        ]);
    }
}

