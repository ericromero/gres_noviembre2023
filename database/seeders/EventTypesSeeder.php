<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EventType;

class EventTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $eventTypes = [
            'Congreso',
            'Encuentro',
            'Conferencia',
            'Taller',
            'Curso',
        ];

        foreach ($eventTypes as $type) {
            EventType::create([
                'name' => $type,
            ]);
        }
    }
}
