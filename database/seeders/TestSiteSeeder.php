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
            'name' => 'Test Site',
            'location' => 'Test Location',
        ]);

        Site::first()->agSystems()->create([
            'name' => 'Test Ag System',
        ]);

    }
}
