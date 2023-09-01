<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;
use App\Models\Space;
use App\Models\User;

class EventsSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create();

        // Obtén un array con los IDs de todos los espacios y usuarios disponibles
        $spaceIds = Space::pluck('id')->toArray();
        $userIds = User::pluck('id')->toArray();

        // Crea 5 eventos falsos
        for ($i = 0; $i < 5; $i++) {
            Event::create([
                'title' => $faker->sentence(5),
                'summary' => $faker->paragraph,
                'start_date' => $faker->dateTimeBetween('now', '+1 month'),
                'end_date' => $faker->dateTimeBetween('now', '+2 months'),
                'start_time' => $faker->time('H:i'),
                'end_time' => $faker->time('H:i'),
                'cover_image' => $faker->imageUrl(640, 480),
                'space_id' => $faker->randomElement($spaceIds),
                'user_id' => $faker->randomElement($userIds),
                'number_of_attendees' => $faker->numberBetween(10, 100),
                'registration_required' => $faker->boolean(30), // 30% de requerir registro
                'registration_url' => $faker->url,
                'status' => $faker->randomElement(['solicitado', 'aceptado', 'rechazado']),
                'published' => $faker->boolean(80), // 80% de estar publicado
            ]);
        }
    }
}
