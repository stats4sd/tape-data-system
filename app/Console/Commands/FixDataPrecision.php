<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\SurveyData\MainSurvey;
use Stats4sd\FilamentOdkLink\Models\OdkLink\Entity;
use App\Models\SurveyData\Performance\PerformanceCrop;
use Stats4sd\FilamentOdkLink\Models\OdkLink\EntityValue;
use App\Models\SurveyData\Performance\PerformanceOrganicPesticide;
use App\Models\SurveyData\Performance\PerformanceChemicalPesticide;

class FixDataPrecision extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fix-data-precision';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix data precision issue for area and land related columns in different tables';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // This is an one-time command program to handle data precision issue for area and land related columns.
        // These columns were defined as decimal(20,2). According to actual data we received, we need decimal(24,6) to support 6 d.p.
        //
        // Considering the survey should have been completed, all ODK submissions have been retrieved and stored in application.
        // It is not necessary to fix it from the upperstream and then retrieve all ODK submissions to handle them from the very beginning.
        // Instead, I would propose a workaround to fix it in a simpler way quickly.
        //
        // As these values are stored in entity_values table, we can just find out them and
        // update the corresponding record. The updated values will appear in data extraction for user processing.

        $this->info('start');

        // find all main surveys records
        $mainSurveys = MainSurvey::all();

        $this->info('Processing ' . count($mainSurveys) . ' main survey records...');

        // handle all main survey records one by one
        foreach ($mainSurveys as $mainSurvey) {
            // find all related entity ID of a submission
            $entities = Entity::where('submission_id', $mainSurvey->submission_id);

            // suppose there should be only one entity_value record for each variable in one submission
            $area = EntityValue::where('dataset_variable_id', 'area')->whereIn('entity_id', $entities->pluck('id'))->first();
            $area_ha = EntityValue::where('dataset_variable_id', 'area_ha')->whereIn('entity_id', $entities->pluck('id'))->first();
            $area_natural_veg = EntityValue::where('dataset_variable_id', 'area_natural_veg')->whereIn('entity_id', $entities->pluck('id'))->first();
            $area_natural_veg_ha = EntityValue::where('dataset_variable_id', 'area_natural_veg_ha')->whereIn('entity_id', $entities->pluck('id'))->first();
            $areaarea_permanent_pasture = EntityValue::where('dataset_variable_id', 'area_permanent_pasture')->whereIn('entity_id', $entities->pluck('id'))->first();
            $area_permanent_pasture_ha = EntityValue::where('dataset_variable_id', 'area_permanent_pasture_ha')->whereIn('entity_id', $entities->pluck('id'))->first();
            $area_common_pasture = EntityValue::where('dataset_variable_id', 'area_common_pasture')->whereIn('entity_id', $entities->pluck('id'))->first();
            $area_common_pasture_ha = EntityValue::where('dataset_variable_id', 'area_common_pasture_ha')->whereIn('entity_id', $entities->pluck('id'))->first();

            // update column values
            $mainSurvey['area'] = $area->value;
            $mainSurvey['area_ha'] = $area_ha->value;
            $mainSurvey['area_natural_veg'] = $area_natural_veg->value;
            $mainSurvey['area_natural_veg_ha'] = $area_natural_veg_ha->value;
            $mainSurvey['area_permanent_pasture'] = $areaarea_permanent_pasture->value;
            $mainSurvey['area_permanent_pasture_ha'] = $area_permanent_pasture_ha->value;
            $mainSurvey['area_common_pasture'] = $area_common_pasture->value;
            $mainSurvey['area_common_pasture_ha'] = $area_common_pasture_ha->value;

            // save record
            $mainSurvey->save();
        }

        $this->info(count($mainSurveys) . ' main survey records processed');


        // ********** //


        // find all performance_chemical_pesticides records
        $performanceChemicalPesticides = PerformanceChemicalPesticide::all();

        $this->info('Processing ' . count($performanceChemicalPesticides) . ' performance_chemical_pesticides records...');

        foreach ($performanceChemicalPesticides as $performanceChemicalPesticide) {
            // find related entities
            $entities = Entity::where('submission_id', $performanceChemicalPesticide->submission_id)->where('model_type', 'like', '%PerformanceChemicalPesticide%');

            // find entity id corresponding to this record
            $entityValues = EntityValue::whereIn('entity_id', $entities->pluck('id'))->where('dataset_variable_id', 'cpname')->where('value', '=', $performanceChemicalPesticide->cpname);
            $this->comment($performanceChemicalPesticide->submission_id . ' : ' . $entities->pluck('id') . ' => ' . $entityValues->pluck('entity_id'));

            $cparea = EntityValue::where('entity_id', $entityValues->pluck('entity_id'))->where('dataset_variable_id', 'cparea')->first();
            $cparea_ha = EntityValue::where('entity_id', $entityValues->pluck('entity_id'))->where('dataset_variable_id', 'cparea_ha')->first();

            $this->comment('cparea: ' . $performanceChemicalPesticide->cparea . ' => ' . $cparea->value);
            $this->comment('cparea_ha: ' . $performanceChemicalPesticide->cparea_ha . ' => ' . $cparea_ha->value);

            // update column values
            $performanceChemicalPesticide['cparea'] = $cparea->value;
            $performanceChemicalPesticide['cparea_ha'] = $cparea_ha->value;

            // save record
            $performanceChemicalPesticide->save();
        }

        $this->info(count($performanceChemicalPesticides) . ' records processed');


        // ********** //


        // find all performance_crops records
        $performanceCrops = PerformanceCrop::all();

        $this->info('Processing ' . count($performanceCrops) . ' performance_crops records...');

        foreach ($performanceCrops as $performanceCrop) {
            // find related entities
            $entities = Entity::where('submission_id', $performanceCrop->submission_id)->where('model_type', 'like', '%PerformanceCrop%');

            // find entity id corresponding to this record
            $entityValues = EntityValue::whereIn('entity_id', $entities->pluck('id'))->where('dataset_variable_id', 'cname_id')->where('value', '=', $performanceCrop->cname_id);

            // if multiple entity found, try another ODK variable to find a unique entity
            // There are 2 records for cname_id = "77", with cname_label "Inset" and "No other crop soft ware problem"
            if (count($entityValues->get()->all()) > 1) {
                $this->comment('   *** ' . count($entityValues->get()->all()) . ' entities found, try another ODK variable for a unique entity');
                $entityValues = EntityValue::whereIn('entity_id', $entities->pluck('id'))->where('dataset_variable_id', 'cname_label')->where('value', '=', $performanceCrop->cname_label);
            }

            $this->comment($performanceCrop->submission_id . ' : ' . $entities->pluck('id') . ' => ' . $entityValues->pluck('entity_id'));

            $cland = EntityValue::where('entity_id', $entityValues->pluck('entity_id'))->where('dataset_variable_id', 'cland')->first();
            $cland_ha = EntityValue::where('entity_id', $entityValues->pluck('entity_id'))->where('dataset_variable_id', 'cland_ha')->first();

            $this->comment('cland: ' . $performanceCrop->cland . ' => ' . $cland->value);
            $this->comment('cland_ha: ' . $performanceCrop->cland_ha . ' => ' . $cland_ha->value);

            // update column values
            $performanceCrop['cland'] = $cland->value;
            $performanceCrop['cland_ha'] = $cland_ha->value;

            // save record
            $performanceCrop->save();
        }

        $this->info(count($performanceCrops) . ' records processed');


        // ********** //


        // find all performance_organic_pesticides records
        $performanceOrganicPesticides = PerformanceOrganicPesticide::all();

        $this->info('Processing ' . count($performanceOrganicPesticides) . ' performance_organic_pesticides records...');

        foreach ($performanceOrganicPesticides as $performanceOrganicPesticide) {
            // find related entities
            $entities = Entity::where('submission_id', $performanceOrganicPesticide->submission_id)->where('model_type', 'like', '%PerformanceOrganicPesticide%');

            // find entity id corresponding to this record
            $entityValues = EntityValue::whereIn('entity_id', $entities->pluck('id'))->where('dataset_variable_id', 'coname1')->where('value', '=', $performanceOrganicPesticide->coname1);
            $this->comment($performanceOrganicPesticide->submission_id . ' : ' . $entities->pluck('id') . ' => ' . $entityValues->pluck('entity_id'));

            $coarea1 = EntityValue::where('entity_id', $entityValues->pluck('entity_id'))->where('dataset_variable_id', 'coarea1')->first();
            $coarea1_ha = EntityValue::where('entity_id', $entityValues->pluck('entity_id'))->where('dataset_variable_id', 'coarea1_ha')->first();

            $this->comment('coarea1: ' . $performanceOrganicPesticide->coarea1 . ' => ' . $coarea1->value);
            $this->comment('coarea1_ha: ' . $performanceOrganicPesticide->coarea1_ha . ' => ' . $coarea1_ha->value);

            // update column values
            $performanceOrganicPesticide['coarea1'] = $coarea1->value;
            $performanceOrganicPesticide['coarea1_ha'] = $coarea1_ha->value;

            // save record
            $performanceOrganicPesticide->save();
        }

        $this->info(count($performanceOrganicPesticides) . ' records processed');

        $this->info('end');
    }
}
