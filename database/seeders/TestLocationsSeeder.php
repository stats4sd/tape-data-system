<?php

namespace Database\Seeders;

use App\Models\SampleFrame\LocationLevel;
use App\Models\Team;
use Illuminate\Database\Seeder;

class TestLocationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LocationLevel::create(['name' => 'District', 'team_id' => Team::first()->id]);
        LocationLevel::create(['name' => 'Sub-District','team_id' => Team::first()->id]);
        LocationLevel::create(['name' => 'Village', 'team_id' => Team::first()->id, 'has_farms' => 1]);

        $this->command->info('Location levels seeded');
    }
}
