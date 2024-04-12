<?php

namespace Database\Seeders;

use Database\Seeders\DatasetSeeders\AgSystemDatasetSeeder;
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
            $this->call(TestLocationsSeeder::class);
            $this->call(TestSiteSeeder::class);
        }

        $this->call(AgSystemDatasetSeeder::class);
        $this->call(AeZoneSeeder::class);

    }
}
