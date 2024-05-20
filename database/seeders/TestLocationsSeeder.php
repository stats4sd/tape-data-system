<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Seeder;

class TestLocationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $team = Team::first();

        if (!$team) {
            return;
        }


        $districtLevel = $team->locationLevels()->create(['name' => 'District', 'parent_id' => 1, 'top_level' => 0]);
        $villageLevel = $team->locationLevels()->create(['name' => 'Village', 'has_farms' => 1, 'parent_id' => $districtLevel->id, 'top_level' => 0]);

        $this->command->info('Location levels seeded');

        $topLevelLocation = $team->locations()->create(['location_level_id' => 1, 'code' => 'location_234', 'name' => 'Top level location 1']);
    }
}
