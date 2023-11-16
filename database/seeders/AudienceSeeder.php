<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Audience;

class AudienceSeeder extends Seeder
{
    public function run(): void
    {
        Audience::create([
            'name' => 'Alumnos',
        ]);

        Audience::create([
            'name' => 'Profesores',
        ]);

        Audience::create([
            'name' => 'Abierto',
        ]);

        Audience::create([
            'name' => 'Alumnos y Profesores',
        ]);

        Audience::create([
            'name' => 'Especializado',
        ]);
    }
}
