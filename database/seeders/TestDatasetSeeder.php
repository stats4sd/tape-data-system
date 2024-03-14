<?php

namespace Database\Seeders;

use App\Models\Farm;
use App\Models\SurveyData\CaetAssessment;
use App\Models\SurveyData\PerformanceAssessment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Team;

class TestDatasetSeeder extends Seeder
{
    public function run(): void
    {
        // T EMP
        CaetAssessment::destroy(CaetAssessment::all()->pluck('id'));
        PerformanceAssessment::destroy(PerformanceAssessment::all()->pluck('id'));

        // check if the test-data is available at scripts/tape-data-platform-test-data/prosoils-dumps/
        $testDataPath = base_path('scripts/tape-data-platform-test-data/prosoils-dumps/');

        if (!file_exists($testDataPath)) {
            dump('It looks like you do not have the Test Data Package installed. Aborting');
            return;
        }

        // There may already be teams in the database, so we need to get the actual team models to know what IDs to use.
        $teams = [];

        $teams[] = Team::updateOrCreate([
            'name' => 'Kenya Team',
        ]);

        $teams[] = Team::updateOrCreate([
            'name' => 'Ethiopia Team'
        ]);

        $teams[] = Team::updateOrCreate([
            'name' => 'Madagascar Team',
        ]);

        $teams[] = Team::updateOrCreate([
            'name' => 'Benin Team',
        ]);

        foreach ($teams as $team) {
            $team->farms()->delete();
        }

        // import farms data from csv
        $farmDataFile = fopen($testDataPath . 'farms.csv', 'r');

        $header = fgetcsv($farmDataFile);

        while ($row = fgetcsv($farmDataFile)) {

            $farmData = array_combine($header, $row);

            Farm::create([
                'id' => $farmData['id'], // need to use the existing ID to properly link to CAET and performance assessment data.
                'team_id' => $teams[$farmData['team_id'] - 1]->id, // handle case where there are already teams in the database.
                'team_code' => $farmData['pro_soils_farm_code'],
                'latitude' => $farmData['latitude'] !== "" ? $farmData['latitude'] : null,
                'longitude' => $farmData['longitude'] !== "" ? $farmData['longitude'] : null,
                'altitude' => $farmData['altitude'] !== "" ? $farmData['altitude'] : null,
                'identifiers' => collect([
                    'name' => $farmData['name'] ?? null,
                    'hh_head_male_name' => $farmData['hh_head_male_name'] ?? null,
                    'hh_head_female_name' => $farmData['hh_head_female_name'] ?? null,
                    'respondent_name' => $farmData['respondent_name'] ?? null,
                    'respondent_gender' => $farmData['respondent_gender'] ?? null,
                ]),
                'properties' => collect([
                    'pro_soils_group' => $farmData['pro_soils_group'] ?? null,
                    'location_level_one_id' => $farmData['location_level_one_id'] ?? null,
                    'location_level_two_id' => $farmData['location_level_two_id'] ?? null,
                    'location_level_three_id' => $farmData['location_level_three_id'] ?? null,
                    'village' => $farmData['village'] ?? null,
                    'replacement' => $farmData['replacement'] ?? null,
                    'sub_location' => $farmData['sub_location'] ?? null,
                    'gave_consent_to_the_survey' => $farmData['gave_consent_to_the_survey'] ?? null,
                ]),
            ]);
        }


        // run all raw SQL files in the test-data directory
        $files = glob($testDataPath . '*.sql');
        foreach ($files as $file) {

           // if ($file === $testDataPath . 'test.sql') {
                $sql = file_get_contents($file);


                \DB::unprepared($sql);

            //}
        }


    }
}
