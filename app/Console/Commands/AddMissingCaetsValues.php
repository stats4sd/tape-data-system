<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\SurveyData\MainSurvey;
use Stats4sd\FilamentOdkLink\Models\OdkLink\Entity;
use Stats4sd\FilamentOdkLink\Models\OdkLink\EntityValue;

class AddMissingCaetsValues extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:add-missing-caets-values';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adds missing values for CAET 6.2 and 6.3 in main_surveys table';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // This is an one-time command program to handle the missing values of CAET 6.2 and 6.3.
        // The possible cause is the inconsistency of ODK variable names for CAET 6.2 and 6.3 in ODK form.
        // They should be "food_self_suff" and "food_heritage" but they are "food-self-suff" and "food-heritage".
        // We should use underscore but hypen is used.
        //
        // Considering the survey should have been completed, all ODK submissions have been retrieved and stored in application.
        // It is not necessary to fix it from the upperstream and then retrieve all ODK submissions to handle them from the very beginning.
        // Instead, I would propose a workaround to fix it in a simpler way quickly.
        //
        // As values of food-self-suff and food-heritage are stored in entity_values table, we can just find out them and
        // update the corresponding main_survey record. The updated values will appear in data extraction for user processing.

        $this->info('start');

        // find all main surveys records
        $mainSurveys = MainSurvey::all();

        $this->comment('Processing ' . count($mainSurveys) . ' surveys...');

        // handle all main survey records one by one
        foreach ($mainSurveys as $mainSurvey) {
            // find all related entity ID of a submission
            $entities = Entity::where('submission_id', $mainSurvey->submission_id);

            // suppose there should be only one entity_value record for each variable in one submission
            $foodSelfSuff = EntityValue::where('dataset_variable_id', 'food_self_suff')->whereIn('entity_id', $entities->pluck('id'))->first();
            $foodHeritage = EntityValue::where('dataset_variable_id', 'food_heritage')->whereIn('entity_id', $entities->pluck('id'))->first();

            // update column values
            $mainSurvey['food-self-suff'] = $foodSelfSuff->value;
            $mainSurvey['food-heritage'] = $foodHeritage->value;

            // save record
            $mainSurvey->save();
        }

        $this->comment(count($mainSurveys) . ' surveys processed');

        $this->info('end');
    }
}
