<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
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
            ->get("{$endpoint}/projects/{$xlsform->owner->odkProject->id}/forms/{$xlsform->odk_id}/submissions.csv.zip")
            ->throw();

        return response($results->body(), 200, [
            'Content-Type' => 'application/zip',
            'Content-Disposition' => 'attachment; filename="submissions.csv.zip"',
        ]);


    }
}
