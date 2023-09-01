<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;
use App\Models\User;

class DepartmentsSeeder extends Seeder
{
    public function run()
    {
        $institucionId = 1; // Reemplaza 1 por el id de la institución a la que pertenecen los departamentos

        // Departamento "SUA"
        Department::create([
            'name' => 'SUA',
            'description' => 'Sistema Universidad Abierta',
            'responsible_id' => 2,
            'institution_id' => $institucionId,
        ]);
        
        // Departamento "UDEMAT"
        Department::create([
            'name' => 'UDEMAT',
            'description' => 'Unidad para el Desarrollo de Materiales de Enseñanza y Apropiación Tecnológica',
            'responsible_id' => 3,
            'institution_id' => $institucionId,
        ]);

        // Departamento "SASE"
        Department::create([
            'name' => 'SASE',
            'description' => 'Secretaría de Asuntos Estudiantiles',
            'responsible_id' => 4,
            'institution_id' => $institucionId,
        ]);

        // Departamento "POSGRADO"
        Department::create([
            'name' => 'POSGRADO',
            'description' => 'Posgrado',
            'responsible_id' => 5,
            'institution_id' => $institucionId,
        ]);

        
    }
}
