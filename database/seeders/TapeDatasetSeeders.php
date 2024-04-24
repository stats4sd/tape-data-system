<?php

namespace Database\Seeders;

use App\Models\Dataset;
use App\Models\SampleFrame\Farm;
use Illuminate\Database\Seeder;

class TapeDatasetSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $farmDataset = Dataset::create([
            'name' => 'Farms',
            'primary_key' => 'id',
            'entity_model' => Farm::class,
        ]);

        $caetScaleDataset = Dataset::create([
            'name' => 'Caet Scales',
            'primary_key' => 'id',
            'entity_model' => \App\Models\CaetScale::class,
        ]);

        $caetInterpretationsDataset = Dataset::create([
            'name' => 'Caet Interpretations',
            'primary_key' => 'id',
            'entity_model' => \App\Models\CaetInterpretation::class,
        ]);

        $locationLevelDataset = Dataset::create([
            'name' => 'Location Levels',
            'primary_key' => 'id',
            'entity_model' => \App\Models\SampleFrame\LocationLevel::class,
        ]);

        $locationDataset = Dataset::create([
            'name' => 'Locations',
            'primary_key' => 'id',
            'entity_model' => \App\Models\SampleFrame\Location::class,
        ]);



    }
}
