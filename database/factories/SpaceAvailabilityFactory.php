<?php

namespace Database\Factories;

use App\Models\SpaceAvailability;
use App\Models\Space;
use Illuminate\Database\Eloquent\Factories\Factory;

class SpaceAvailabilityFactory extends Factory
{
    protected $model = SpaceAvailability::class;

    public function definition()
    {
        // Generar horas aleatorias entre las 9:00 y las 20:00 horas
        $startTime = mt_rand(9, 19);
        $endTime = mt_rand($startTime + 1, 20);

        // Asignar minutos 00 o 30
        $minutes = [0, 30];
        $startMinute = $minutes[array_rand($minutes)];
        $endMinute = $minutes[array_rand($minutes)];

        return [
            'space_id' => Space::all()->random()->id,
            'day' => mt_rand(1, 7), // Generar número aleatorio para representar el día de la semana (1 a 7)
            'start_time' => sprintf('%02d:%02d', $startTime, $startMinute),
            'end_time' => sprintf('%02d:%02d', $endTime, $endMinute),
        ];
    }
}

