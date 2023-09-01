<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ParticipationType;

class ParticipationTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $participantTypes = [
            'Ponente',
            'Moderador',
        ];

        foreach ($participantTypes as $type) {
            ParticipationType::create([
                'name' => $type,
            ]);
        }
    }
}
