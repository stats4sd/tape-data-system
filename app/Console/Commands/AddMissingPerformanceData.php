<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\SurveyData\MainSurvey;
use Stats4sd\FilamentOdkLink\Models\OdkLink\Submission;
use App\Models\SurveyData\Performance\PerformanceMachine;
use App\Models\SurveyData\Performance\PerformanceActivity;

class AddMissingPerformanceData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:add-missing-performance-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add missing performance activities and performance machines data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('start');

        // find all main surveys records
        $mainSurveys = MainSurvey::all();

        $this->info('Processing ' . count($mainSurveys) . ' main survey records...');

        // remove all records from performance_activities and performance_machines tables
        PerformanceActivity::truncate();
        PerformanceMachine::truncate();

        // handle all main survey records one by one
        foreach ($mainSurveys as $mainSurvey) {
            // find the corresponding submissions record
            $submission = Submission::find($mainSurvey->submission_id);

            $this->comment('Handling ' . $mainSurvey->respondent_name . '...');

            // get ODK submission JSON content
            $data = $submission->content;

            // find performance activities data
            $activnum = $data['step2']['agdiv']['outputs_grp']['topactiv']['activnum_grp']['activnum'];

            $this->comment($activnum . ' performance activity found');

            if ($activnum > 0) {
                $acs = $data['step2']['agdiv']['outputs_grp']['topactiv']['ac'];

                foreach ($acs as $ac) {
                    $ac_num = $ac['ac_num'];
                    $acname = $ac['ac_inner_grp']['acname'];
                    $acname_other = $ac['ac_inner_grp']['acname_other'];
                    $acrev = $ac['ac_inner_grp']['acrev'];
                    $acrev_high_ack = $ac['ac_inner_grp']['acrev_high_ack'];
                    $this->comment($mainSurvey->id . ' - ' . $submission->id);
                    $this->comment($ac_num . ' - ' . $acname . ', ' . $acname_other . ', ' . $acrev . ', ' . $acrev_high_ack);

                    $performanceActivity = $mainSurvey->performanceActivities()->create([
                        'main_survey_id' => $mainSurvey->id,
                        'acname' => $acname,
                        'acname_other' => $acname_other,
                        'acrev' => $acrev,
                        'submission_id' => $submission->id,
                    ]);
                }
            }




            // find performance machines data
            $machnum = $data['step2']['agdiv']['inputs_grp']['machin_grp']['machin_start']['machnum'];

            $this->comment($machnum . ' performance machine found');

            if ($machnum > 0) {
                $ms = $data['step2']['agdiv']['inputs_grp']['machin_grp']['m'];

                foreach ($ms as $m) {
                    $m_number = $m['m_number'];
                    $mname = $m['m_inner_grp']['mname'];
                    $machine_not_answer_note = $m['m_inner_grp']['machine_not_answer_note'];
                    $mowned = $m['m_inner_grp']['mowned'];
                    $mprice = $m['m_inner_grp']['mprice'];
                    $myused = $m['m_inner_grp']['myused'];
                    $myplan = $m['m_inner_grp']['myplan'];
                    $this->comment($mainSurvey->id . ' - ' . $submission->id);
                    $this->comment($m_number . ' - ' . $mname . ', ' . $machine_not_answer_note . ', ' . $mowned . ', ' . $mprice . ', ' . $myused . ', ' . $myplan);

                    $performanceMachine = $mainSurvey->performanceMachines()->create([
                        'main_survey_id' => $mainSurvey->id,
                        'mname' => $mname,
                        'mowned' => $mowned,
                        'mprice' => $mprice,
                        'myused' => $myused,
                        'myplan' => $myplan,
                        'submission_id' => $submission->id,
                    ]);
                }
            }
        }

        $this->info(count($mainSurveys) . ' main survey records processed');

        $this->info('end');
    }
}
