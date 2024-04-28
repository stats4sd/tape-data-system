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


        $districtLevel = $team->locationLevels()->create(['name' => 'District']);
        $subDistrictLevel = $team->locationLevels()->create(['name' => 'Sub-District', 'parent_id' => $districtLevel->id]);
        $villageLevel = $team->locationLevels()->create(['name' => 'Village', 'has_farms' => 1, 'parent_id' => $subDistrictLevel->id]);

        $this->command->info('Location levels seeded');
    }
}
