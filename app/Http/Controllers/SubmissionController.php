<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Stats4sd\FilamentOdkLink\Models\OdkLink\Submission;

class SubmissionController extends Controller
{
    // This function will be called when there are new submissions to be pulled from ODK central
    public static function process(Submission $submission): void
    {
        // application specific business logic goes here
        // logger('SubmissionController.process()...');
    }
}
