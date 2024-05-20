<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Spatie\MediaLibrary\Support\MediaStream;
use Stats4sd\FilamentOdkLink\Models\OdkLink\Submission;
use Stats4sd\FilamentOdkLink\Services\OdkLinkService;

class SurveyMonitoringController extends Controller
{
    /**
     * @param Team $team - the team to get the submission summary for
     * @param string $isTest - whether to get the submission summary for the test form or the live form (test/live) - NOTE: In this setup, it is assumed there are *only* 2 forms per team - one that is marked as test and one that is marked as live.
     * @return array - containing the count of submissions and the date of the latest submission
     */
    public function getSubmissionSummary(Team $team, string $isTest)
    {
        [$xlsform, $odkLinkService] = $this->getFormAndLinkService($team, $isTest === 'test');

        $token = $odkLinkService->authenticate();
        $endpoint = config('filament-odk-link.odk.base_endpoint');

        $results = Http::withToken($token)
            ->get("{$endpoint}/projects/{$xlsform->owner->odkProject->id}/forms/{$xlsform->odk_id}/submissions")
            ->throw()
            ->json();


        $count = count($results);
        $latestSubmission = collect($results)
            ->sort(fn ($submission) => $submission['createdAt'])
            ->last();

        if($count === 0) {
            return [
                'count' => 0,
                'latestSubmissionDate' => null,
            ];
        }

        // Submission Summary based on pulled data
        $submissions = Submission::all();

        $successfulSurveys = $submissions->filter(fn (Submission $submission) => $submission->content['reg']['respondent_check']['respondent_available'] === "1" &&
            $submission->content['consent_grp']['consent'] === "1");

        $surveysWithoutRespondentPresent = $submissions->filter(fn (Submission $submission) => $submission->content['reg']['respondent_check']['respondent_available'] === "0")->count();

        $surveysWithNonConsentingRespondent = $submissions->filter(fn (Submission $submission) => $submission->content['consent_grp']['consent'] === "0")->count();

        $beneficiaryFarmsSurveyed = $successfulSurveys->filter(fn (Submission $submission) => $submission->content['reg']['farm_id'] !== "-99")->count();
        $nonBeneficiaryFarmsSurveyed = $successfulSurveys->filter(fn (Submission $submission) => $submission->content['reg']['farm_id'] === "-99")->count();


        return [
            'count' => $count,
            'latestSubmissionDate' => (new Carbon($latestSubmission['createdAt']))->format('Y-m-d H:i:s'),
            'successfulSurveys' => $successfulSurveys->count(),
            'beneficiaryFarmsSurveyed' => $beneficiaryFarmsSurveyed,
            'nonBeneficiaryFarmsSurveyed' => $nonBeneficiaryFarmsSurveyed,
            'surveysWithoutRespondentPresent' => $surveysWithoutRespondentPresent,
            'surveysWithNonConsentingRespondent' => $surveysWithNonConsentingRespondent,

        ];
    }


    /*
     * Function to download the submissions from ODK Central. The submission data are retrieved directly from the API and returned exactly as if you downloaded the data manually from ODK Central.
     * @param Team $team - which team?
     * @param string $isTest - retrieve the test or live form?
     * @return \Illuminate\Http\Response (zip file containing the csv data)
     */
    public function downloadData(Team $team, string $isTest)
    {
        [$xlsform, $odkLinkService] = $this->getFormAndLinkService($team, $isTest === 'test');
        $token = $odkLinkService->authenticate();
        $endpoint = config('odk-link.odk.base_endpoint');


        $results = Http::withToken($token)
            ->get("{$endpoint}/projects/{$xlsform->owner->odkProject->id}/forms/{$xlsform->odk_id}/submissions.csv.zip")
            ->throw();

        return response($results->body(), 200, [
            'Content-Type' => 'application/zip',
            'Content-Disposition' => 'attachment; filename="submissions.csv.zip"',
        ]);
    }

    /**
     * Function to retrieve the XLSForm model and the Link Service class instance. This is a helper function to avoid repeating the same code in multiple functions.
     * @param Team $team - which team?
     * @param $isTest - retrieve the test or live form?L
     * @return array
     */
    public function getFormAndLinkService(Team $team, $isTest): array
    {
        $xlsform = $team->xlsforms->where('is_test', $isTest)->first();
        $odkLinkService = app()->make(OdkLinkService::class);
        return array($xlsform, $odkLinkService);
    }

    /**
     * Function to download all attached media from the submissions. This assumes the submissions (and their media) have already been pulled from ODK Central. This function will zip all the media files and return a MediaStream object.
     * @param Team $team - which team?
     * @param string $isTest - retrieve the test or live form?
     * @return MediaStream
     */
    public function downloadAttachedMedia(Team $team, string $isTest)
    {
        [$xlsform, $odkLinkService] = $this->getFormAndLinkService($team, $isTest === 'test');

        $downloads = [];

        foreach ($xlsform->submissions as $submission) {
            foreach ($submission->getMedia() as $media) {
                $downloads[] = $media;
            }
        }

        return MediaStream::create('map-survey-attachments.zip')->addMedia($downloads);
    }
}
