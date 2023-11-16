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

        // $this->call(RolesTableSeeder::class);
        // $this->call(PermissionsTableSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UsersTableSeeder::class);      
        $this->call(InstitutionsSeeder::class);
        $this->call(DepartmentsSeeder::class);
        $this->call(AudienceSeeder::class);
        $this->call(EventCategorySeeder::class);
        $this->call(KnowledgeAreaSeeder::class);

        $this->call(EventTypesSeeder::class);
        $this->call(ParticipationTypesSeeder::class);
        $this->call(TeamsSeeder::class);
        
        //$this->call(SpacesSeeder::class);
        //$this->call(EventsSeeder::class);
        
    }
}
