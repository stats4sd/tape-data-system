<?php

namespace App\Models\SurveyData;

use App\Exports\MainSurveyExport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;
use Stats4sd\FilamentOdkLink\Models\OdkLink\Xlsform;
use Stats4sd\FilamentOdkLink\Services\OdkLinkService;

class TempSubmissionController extends Controller
{
    /*
     * Function to download the submissions from ODK Central. The submission data are retrieved directly from the API and returned exactly as if you downloaded the data manually from ODK Central.
     * @param Team $team - which team?
     * @param string $isTest - retrieve the test or live form?
     * @return \Illuminate\Http\Response (zip file containing the csv data)
     */
    public function downloadDataDirectFromOdk(Xlsform $xlsform): \Illuminate\Http\Response
    {
        $token = app()->make(OdkLinkService::class)->authenticate();
        $endpoint = config('filament-odk-link.odk.base_endpoint');


        $results = Http::withToken($token)
            ->get("{$endpoint}/projects/{$xlsform->owner->odkProject->id}/forms/{$xlsform->odk_id}/submissions.csv.zip?groupPaths=false")
            ->throw();

        return response($results->body(), 200, [
            'Content-Type' => 'application/zip',
            'Content-Disposition' => 'attachment; filename="submissions.csv.zip"',
        ]);
    }

    /*
     * Function to download the processed data. The processed data are the data that have been cleaned and transformed into a format that is ready for analysis.
     */
    public function downloadProcessedData(Xlsform $xlsform): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $today = now()->format('Y-m-d');
        $filename = "TAPE_survey_ethiopia_{$today}.xlsx";
        return Excel::download(new MainSurveyExport($xlsform), $filename);
    }
}
