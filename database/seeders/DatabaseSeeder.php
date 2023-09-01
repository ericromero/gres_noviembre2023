<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SpaceAvailability;
use Database\Factories\SpaceAvailabilityFactory;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // Registra la factoría SpaceAvailabilityFactory
        //SpaceAvailability::factory()->count(50)->create();

        $this->call(RolesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(UsersTableSeeder::class);        
        $this->call(InstitutionsSeeder::class);
        $this->call(DepartmentsSeeder::class);        
        //$this->call(FakeUsersSeeder::class);
        $this->call(SpacesSeeder::class);
        //$this->call(EventsSeeder::class);
        //$this->call(SpaceAvailabilitySeeder::class);
    }
}
