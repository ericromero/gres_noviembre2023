<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Faker\Factory as Faker;

class FakeUsersSeeder extends Seeder
{
    public function run()
    {
        // Crea 20 cuentas de usuario falsas
        $faker = Faker::create();
        $doi=2001;
        for ($i = 0; $i < 20; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'),
                'doi'=>$doi+$i
            ]);
        }
    }
}
