<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Team;


class TeamsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Team::create([
            'department_id' => 1,
            'user_id'       => 1,
            'register_id'   => 1,
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);
    }
}
