<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\SampleFrame\Farm;
use App\Models\SurveyData\MainSurvey;
use Stats4sd\FilamentOdkLink\Models\OdkLink\Submission;

class AddGpsDetails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:add-gps-details';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Find GPS details from submissions.content, add it to main_surveys table and farms table';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('start');

        // find all main surveys records
        $mainSurveys = MainSurvey::all();

        $this->info('Processing ' . count($mainSurveys) . ' main survey records...');

        $countMissing = 0;

        // handle all main survey records one by one
        foreach ($mainSurveys as $mainSurvey) {
            // find the corresponding submissions record
            $submission = Submission::find($mainSurvey->submission_id);

            // get ODK submission JSON content
            $data = $submission->content;

            // find GPS details from ODK submission JSON content
            $latitude = $data['farm_info']['gps_loc']['coordinates'][0];
            $longitude = $data['farm_info']['gps_loc']['coordinates'][1];
            $altitude = $data['farm_info']['gps_loc']['coordinates'][2];
            $accuracy = $data['farm_info']['gps_loc']['properties']['accuracy'];

            // save GPS details to main_surveys record
            $mainSurvey->latitude = $latitude;
            $mainSurvey->longitude = $longitude;
            $mainSurvey->altitude = $altitude;
            $mainSurvey->accuracy = $accuracy;
            $mainSurvey->save();

            $this->comment($mainSurvey->respondent_name . ' main survey updated');

            // find the corresponding farms record
            $farm = $mainSurvey->farm;

            if (!$farm) {
                $this->comment('*** ' . $mainSurvey->respondent_name . ' FARM NOT FOUND');
                $countMissing++;
                continue;
            }

            $this->comment($mainSurvey->respondent_name . ' farm updated');
            // save GPS details to farms record
            $farm->latitude = $latitude;
            $farm->longitude = $longitude;
            $farm->altitude = $altitude;
            $farm->accuracy = $accuracy;
            $farm->save();
        }

        $this->info(count($mainSurveys) . ' main survey records processed');
        $this->info($countMissing . ' farms NOT FOUND');

        $this->info('end');
    }
}
