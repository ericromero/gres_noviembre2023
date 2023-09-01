<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Institution;

class InstitutionsSeeder extends Seeder
{
    public function run()
    {
        // Crea la institución "Facultad de Psicología" si no existe
        Institution::firstOrCreate([
            'name' => 'Facultad de Psicología',
        ]);
    }
}
