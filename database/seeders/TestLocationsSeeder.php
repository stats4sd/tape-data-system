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
        $districtLevel = LocationLevel::create(['name' => 'District', 'owner_id' => Team::first()->id]);
        $subDistrictLevel = LocationLevel::create(['name' => 'Sub-District', 'owner_id' => Team::first()->id, 'parent_id' => $districtLevel->id]);
        $villageLevel = LocationLevel::create(['name' => 'Village', 'owner_id' => Team::first()->id, 'has_farms' => 1, 'parent_id' => $subDistrictLevel->id]);

        $this->command->info('Location levels seeded');
    }
}
