<?php

namespace Database\Seeders;

use App\Models\AgSystem;
use App\Models\Dataset;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Stats4sd\FilamentOdkLink\Models\OdkLink\DatasetVariable;

class DatasetVariableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $dataset = Dataset::create([
            'name' => 'Agricultural Systems',
            'primary_key' => 'id',
            'entity_model' => AgSystem::class,
        ]);

        DatasetVariable::create([
            'dataset_id' => $dataset->id,
            'name' => 'productive_activities',
            'label' => 'Productive Activities',
            'description' => 'Describe the productive activities relating to crops, livestock, agroforestry, forests and fishing in this system
',
        ]);

        DatasetVariable::create([
            'dataset_id' => $dataset->id,
            'name' => 'biophysical_resources',
            'label' => 'Biophysical Resources',
            'description' => 'Describe the current status of biophysical resources used in farming and the trends that have affected them in the recent past.
',
        ]);

        DatasetVariable::create([
            'dataset_id' => $dataset->id,
            'name' => 'demographics',
            'label' => 'Demographics',
            'description' => 'What are the demographic characteristics of the farmers in this system?
',
        ]);

        DatasetVariable::create([
            'dataset_id' => $dataset->id,
            'name' => 'main_problems',
            'label' => 'Main Problems',
            'description' => 'What are the main problems affecting farming in the system? If you need a historical perspective to contextualise the answer, please provide it.
',
        ]);

        DatasetVariable::create([
            'dataset_id' => $dataset->id,
            'name' => 'market_conditions',
            'label' => 'Market Conditions',
            'description' => 'What are the market conditions affecting farmers? (Both barriers and enablers)
',
        ]);

        DatasetVariable::create([
            'dataset_id' => $dataset->id,
            'name' => 'policies',
            'label' => 'Policies',
            'description' => 'Are there any policies that have an important effect on farmers within the system at this point in time?
',
        ]);

        DatasetVariable::create([
            'dataset_id' => $dataset->id,
            'name' => 'economic',
            'label' => 'Economic',
            'description' => 'Are there economic aspects that affect production and productivity in the system?
',
        ]);

        DatasetVariable::create([
            'dataset_id' => $dataset->id,
            'name' => 'climate_change',
            'label' => 'Climate Change',
            'description' => 'How is climate change affecting farming within the system? (Please back up the assessment with data or reports)
',
        ]);

        DatasetVariable::create([
            'dataset_id' => $dataset->id,
            'name' => 'overall_performance',
            'label' => 'Overall Performance',
            'description' => 'Based on all these factors and your own understanding of the system, please provide your own analysis of the level at which the system is performing.

',
        ]);
    }
}
