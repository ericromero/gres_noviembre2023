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

        // Departamento "Direccion"
        Department::create([
            'name' => 'Direccion',
            'description' => 'Direccion',
            'responsible_id' => null,
            'institution_id' => $institucionId,
        ]);

        // Secretaria General
        Department::create([
            'name' => 'Secretaria General',
            'description' => 'Secretaria General',
            'responsible_id' => null,
            'institution_id' => $institucionId,
        ]);

        // Departamento "SUA"
        Department::create([
            'name' => 'SUA',
            'description' => 'Sistema Universidad Abierta',
            'responsible_id' => null,
            'institution_id' => $institucionId,
        ]);

        // Departamento "DEPI"
        Department::create([
            'name' => 'DEPI',
            'description' => 'División de Estudios de Posgrado e Investigación',
            'responsible_id' => null,
            'institution_id' => $institucionId,
        ]);

        // Departamento "DEP"
        Department::create([
            'name' => 'DEP',
            'description' => 'División de Estudios Profesionales',
            'responsible_id' => null,
            'institution_id' => $institucionId,
        ]);

        // Departamento "DEC"
        Department::create([
            'name' => 'DEC',
            'description' => 'División de Educación Continua',
            'responsible_id' => null,
            'institution_id' => $institucionId,
        ]);

        // Departamento "PUEP"
        Department::create([
            'name' => 'PUEP',
            'description' => 'Programa Único de Especialiaciones',
            'responsible_id' => null,
            'institution_id' => $institucionId,
        ]);

        // Departamento "UDEMAT"
        Department::create([
            'name' => 'UDEMAT',
            'description' => 'Unidad para el Desarrollo de Materiales de Enseñanza y Apropiación Tecnológica',
            'responsible_id' => null,
            'institution_id' => $institucionId,
        ]);

        // Departamento "SASE"
        Department::create([
            'name' => 'SASE',
            'description' => 'Secretaría de Asuntos Estudiantiles',
            'responsible_id' => null,
            'institution_id' => $institucionId,
        ]);

        // Departamento "PE"
        Department::create([
            'name' => 'PE',
            'description' => 'Coordinación Psicología de la Educación',
            'responsible_id' => null,
            'institution_id' => $institucionId,
        ]);

        // Departamento "PO"
        Department::create([
            'name' => 'PO',
            'description' => 'Coordinación Psicología Organizacional',
            'responsible_id' => null,
            'institution_id' => $institucionId,
        ]);

        // Departamento "PPC"
        Department::create([
            'name' => 'PPC',
            'description' => 'Coordinación de Procesos Psicosociales y Culturales',
            'responsible_id' => null,
            'institution_id' => $institucionId,
        ]);

        // Departamento "PN"
        Department::create([
            'name' => 'PN',
            'description' => 'Coordinación Psicobiología y Neurociencias',
            'responsible_id' => null,
            'institution_id' => $institucionId,
        ]);

        // PCS
        Department::create([
            'name' => 'PCS',
            'description' => 'Coordinación de Psicología Clínica y de la Salud',
            'responsible_id' => null,
            'institution_id' => $institucionId,
        ]);

        // CCC
        Department::create([
            'name' => 'CCC',
            'description' => 'Ciencias cognitivas y del comportamiento',
            'responsible_id' => null,
            'institution_id' => $institucionId,
        ]);

        // Tutorías
        Department::create([
            'name' => 'Tutorías',
            'description' => 'Tutorías',
            'responsible_id' => null,
            'institution_id' => $institucionId,
        ]);

        // UPLAN
        Department::create([
            'name' => 'UPLAN',
            'description' => 'Unidad de Planeación',
            'responsible_id' => null,
            'institution_id' => $institucionId,
        ]);

        // Comunicación Social
        Department::create([
            'name' => 'Comunicación Social',
            'description' => 'Comunicación Social',
            'responsible_id' => null,
            'institution_id' => $institucionId,
        ]);

        // Coordinación de Centros
        Department::create([
            'name' => 'Coordinación de Centros',
            'description' => 'Coordinación de Centros',
            'responsible_id' => null,
            'institution_id' => $institucionId,
        ]);
        
    }
}
