<?php

namespace Database\Seeders;

use App\Models\Site;
use App\Models\Team;
use Illuminate\Database\Seeder;

class TestSiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Team::first()->sites()->create([
            'location_id' => 1, 
            'location_description' => 'Optional description of the location'
        ]);

        Site::first()->agSystems()->create([
            'name' => 'Test Ag System',
            'code' => 'ag_sys_1'
        ]);

    }
}
