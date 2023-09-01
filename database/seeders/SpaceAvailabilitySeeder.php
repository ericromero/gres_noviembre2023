<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SpaceAvailability;

class SpaceAvailabilitySeeder extends Seeder
{
    public function run()
    {
        SpaceAvailability::factory()->times(50)->create();
    }
}
