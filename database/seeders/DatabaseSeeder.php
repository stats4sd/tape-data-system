<?php

namespace Database\Seeders;

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

        // get all files inside DatasetSeeders and run them
        $files = glob(database_path('seeders/DatasetSeeders/*.php'));
        foreach ($files as $file) {
            require_once $file;
            $class = pathinfo($file, PATHINFO_FILENAME);
            $this->call("Database\Seeders\DatasetSeeders\\$class");
        }



        $this->call(AeZoneSeeder::class);

    }
}
