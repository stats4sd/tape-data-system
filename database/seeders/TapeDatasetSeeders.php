<?php

namespace Database\Seeders;

use App\Models\Dataset;
use App\Models\SampleFrame\Farm;
use Illuminate\Database\Seeder;

class TapeDatasetSeeders extends Seeder
{
    /**
     * Add datasets for the sample frame and TAPE survey data outputs
     */
    public function run(): void
    {
        // SAMPLE FRAME
        $farmDataset = Dataset::create([
            'name' => 'Farms',
            'primary_key' => 'id',
            'entity_model' => Farm::class,
            'lookup_table' => 1,
        ]);

        $locationLevelDataset = Dataset::create([
            'name' => 'Location Levels',
            'primary_key' => 'id',
            'entity_model' => \App\Models\SampleFrame\LocationLevel::class,
            'lookup_table' => 1,
        ]);

        $locationDataset = Dataset::create([
            'name' => 'Locations',
            'primary_key' => 'id',
            'entity_model' => \App\Models\SampleFrame\Location::class,
            'lookup_table' => 1,
        ]);


        // EXTRA TAPE LOOKUPS
        $caetScaleDataset = Dataset::create([
            'name' => 'Caet Scales',
            'primary_key' => 'id',
            'entity_model' => \App\Models\CaetScale::class,
            'lookup_table' => 1,
            'is_universal' => 1,
        ]);

        $caetInterpretationsDataset = Dataset::create([
            'name' => 'Caet Interpretations',
            'primary_key' => 'id',
            'entity_model' => \App\Models\CaetInterpretation::class,
            'lookup_table' => 1,
        ]);

        // TAPE SURVEY DATA
        $caetAssessmentDataset = Dataset::create([
            'name' => 'CAET Assessments',
            'primary_key' => 'id',
            'entity_model' => \App\Models\SurveyData\CaetAssessment::class,
        ]);

        $performanceAssessmentDataset = Dataset::create([
            'name' => 'Performance Assessments',
            'primary_key' => 'id',
            'entity_model' => \App\Models\SurveyData\PerformanceAssessment::class,
        ]);

        $performanceActivitiesDataset = Dataset::create([
            'name' => 'Performance Assessments - Activities',
            'primary_key' => 'id',
            'entity_model' => \App\Models\SurveyData\Performance\PerformanceActivity::class,
        ]);

        $performanceAnimalDataset = Dataset::create([
            'name' => 'Performance Assessments - Animals',
            'primary_key' => 'id',
            'entity_model' => \App\Models\SurveyData\Performance\PerformanceAnimal::class,
        ]);

        $performanceAnimalProductDataset = Dataset::create([
            'name' => 'Performance Assessments - Animal Products',
            'primary_key' => 'id',
            'entity_model' => \App\Models\SurveyData\Performance\PerformanceAnimalProduct::class,
        ]);

        $performanceChemicalPesticideDataset = Dataset::create([
            'name' => 'Performance Assessments - Chemical Pesticides',
            'primary_key' => 'id',
            'entity_model' => \App\Models\SurveyData\Performance\PerformanceChemicalPesticide::class,
        ]);

        $performanceCropDataset = Dataset::create([
            'name' => 'Performance Assessments - Crops',
            'primary_key' => 'id',
            'entity_model' => \App\Models\SurveyData\Performance\PerformanceCrop::class,
        ]);

        $performanceCropProductDataset = Dataset::create([
            'name' => 'Performance Assessments - Crop Products',
            'primary_key' => 'id',
            'entity_model' => \App\Models\SurveyData\Performance\PerformanceCropProduct::class,
        ]);

        $performanceMachineDataset = Dataset::create([
            'name' => 'Performance Assessments - Machines',
            'primary_key' => 'id',
            'entity_model' => \App\Models\SurveyData\Performance\PerformanceMachine::class,
        ]);

        $performanceOrganicPesticideDataset = Dataset::create([
            'name' => 'Performance Assessments - Organic Pesticides',
            'primary_key' => 'id',
            'entity_model' => \App\Models\SurveyData\Performance\PerformanceOrganicPesticide::class,
        ]);

        $performanceYouthEmigrantDataset = Dataset::create([
            'name' => 'Performance Assessments - Youth Emigrants',
            'primary_key' => 'id',
            'entity_model' => \App\Models\SurveyData\Performance\PerformanceYouthEmigrant::class,
        ]);

        $performanceYouthFemaleDataset = Dataset::create([
            'name' => 'Performance Assessments - Youth Female',
            'primary_key' => 'id',
            'entity_model' => \App\Models\SurveyData\Performance\PerformanceYouthFemale::class,
        ]);

        $performanceYouthMaleDataset = Dataset::create([
            'name' => 'Performance Assessments - Youth Male',
            'primary_key' => 'id',
            'entity_model' => \App\Models\SurveyData\Performance\PerformanceYouthMale::class,
        ]);


    }
}
