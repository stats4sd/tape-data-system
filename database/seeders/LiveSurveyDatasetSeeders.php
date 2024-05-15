<?php

namespace Database\Seeders;

use App\Models\SurveyData\MainSurvey;
use App\Models\SurveyData\Performance\PerformanceActivity;
use App\Models\SurveyData\Performance\PerformanceAnimal;
use App\Models\SurveyData\Performance\PerformanceAnimalProduct;
use App\Models\SurveyData\Performance\PerformanceChemicalPesticide;
use App\Models\SurveyData\Performance\PerformanceCrop;
use App\Models\SurveyData\Performance\PerformanceCropProduct;
use App\Models\SurveyData\Performance\PerformanceMachine;
use App\Models\SurveyData\Performance\PerformanceOrganicPesticide;
use App\Models\SurveyData\Performance\PerformanceYouthEmigrant;
use App\Models\SurveyData\Performance\PerformanceYouthFemale;
use App\Models\SurveyData\Performance\PerformanceYouthMale;
use Illuminate\Database\Seeder;
use Stats4sd\FilamentOdkLink\Models\OdkLink\Dataset;

class LiveSurveyDatasetSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Dataset::firstOrCreate([
            'name' => 'Main Survey Entries',
            'primary_key' => 'id',
            'entity_model' => MainSurvey::class,
        ]);

        Dataset::firstOrCreate([
            'name' => 'Performance Assessments - Activities',
            'primary_key' => 'id',
            'entity_model' => PerformanceActivity::class,
        ]);

        Dataset::firstOrCreate([
            'name' => 'Performance Assessments - Animals',
            'primary_key' => 'id',
            'entity_model' => PerformanceAnimal::class,
        ]);


        Dataset::firstOrCreate([
            'name' => 'Performance Assessments - Animal Products',
            'primary_key' => 'id',
            'entity_model' => PerformanceAnimalProduct::class,
        ]);

        Dataset::firstOrCreate([
            'name' => 'Performance Assessments - Chemical Pesticides',
            'primary_key' => 'id',
            'entity_model' => PerformanceChemicalPesticide::class,
        ]);

        Dataset::firstOrCreate([
            'name' => 'Performance Assessments - Crops',
            'primary_key' => 'id',
            'entity_model' => PerformanceCrop::class,
        ]);

        Dataset::firstOrCreate([
            'name' => 'Performance Assessments - Crop Products',
            'primary_key' => 'id',
            'entity_model' => PerformanceCropProduct::class,
        ]);

        Dataset::firstOrCreate([
            'name' => 'Performance Assessments - Machines',
            'primary_key' => 'id',
            'entity_model' => PerformanceMachine::class,
        ]);

        Dataset::firstOrCreate([
            'name' => 'Performance Assessments - Organic Pesticides',
            'primary_key' => 'id',
            'entity_model' => PerformanceOrganicPesticide::class,
        ]);

        Dataset::firstOrCreate([
            'name' => 'Performance Assessments - Youth Emigrants',
            'primary_key' => 'id',
            'entity_model' => PerformanceYouthEmigrant::class,
        ]);

        Dataset::firstOrCreate([
            'name' => 'Performance Assessments - Youth Female',
            'primary_key' => 'id',
            'entity_model' => PerformanceYouthFemale::class,
        ]);

        Dataset::firstOrCreate([
            'name' => 'Performance Assessments - Youth Male',
            'primary_key' => 'id',
            'entity_model' => PerformanceYouthMale::class,
        ]);

        Dataset::firstOrCreate([
            'name' => 'Location Rpt',
            'primary_key' => 'id',
            'entity_model' => null,
        ]);

        Dataset::firstOrCreate([
            'name' => 'FieldNotePhotos',
            'primary_key' => 'id',
            'entity_model' => null,
        ]);

    }
}
