<?php

namespace App\Jobs;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Stats4sd\FilamentOdkLink\Models\OdkLink\Xlsform;
use Stats4sd\FilamentOdkLink\Services\OdkLinkService;

class PullSubmissionsFromXlsformQuietly implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public Xlsform $xlsform)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $odkLinkService = app()->make(OdkLinkService::class);

        // get submissions from ODK without doing any extra processing. Just put them into the Submissions table

        // Mostly used for testing.

        $token = $odkLinkService->authenticate();

        $oDataServiceUrl = config('filament-odk-link.odk.base_endpoint') . "/projects/{$this->xlsform->owner->odkProject->id}/forms/{$this->xlsform->odk_id}.svc";

        $results = Http::withToken($token)
            ->get($oDataServiceUrl . '/Submissions?$expand=*')
            ->throw()
            ->json();

        // only process new submissions
        $resultsToAdd = Collect($results['value'])->whereNotIn('__id', $this->xlsform->submissions->pluck('odk_id')->toArray());

        foreach ($resultsToAdd as $entry) {

            // ******* CREATE SUBMISSION RECORD ******* //
            $xlsformVersion = $this->xlsform->xlsformVersions()->firstWhere('version', $entry['__system']['formVersion']);

            if (!$xlsformVersion) {

                $messageContent = collect([
                    'formVersion' => $entry['__system']['formVersion'],
                    'xlsformId' => $xlsform->id,
                    'xlsformTitle' => $xlsform->title,
                    'ownerName' => $xlsform->owner->name,
                ]);

                abort(500, "The system tried to get submission data for a form version that does not exist.  Please copy the following details and send them to the system administrator: " . $messageContent->map(fn ($item, $key) => "$key: $item")->implode(', '));
            }

            // Question: For column submission.content, should we store the original $entry instead of the return value of processEntry()?
            $submission = $xlsformVersion?->submissions()->create([
                'odk_id' => $entry['__id'],
                'submitted_at' => (new Carbon($entry['__system']['submissionDate']))->toDateTimeString(),
                'submitted_by' => $entry['__system']['submitterName'],
                'content' => $entry,
                'enumerator' => $entry['survey_start']['inquirer'],
                'deviceid' => $entry['deviceid'],
                'farm_id' => $entry['reg']['farm_id'],
                'location_id' => $entry['reg']['final_location_id'],
                'consent' => $entry['consent_grp']['consent'],
                'respondent_available' =>  $entry['respondent_check']['respondent_available'] ?? null,
            ]);

        }
    }
}
