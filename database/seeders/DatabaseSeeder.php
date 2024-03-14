<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RolesAndPermissionsSeeder::class);

        // run test seeder in local
        if (app()->environment('local')) {
            $this->call(TestSeeder::class);
        }

        $this->call(DatasetVariableSeeder::class);
        $this->call(AeZoneSeeder::class);

    }
}
