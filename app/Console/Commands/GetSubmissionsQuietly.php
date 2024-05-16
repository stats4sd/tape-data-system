<?php

namespace App\Console\Commands;

use App\Jobs\PullSubmissionsFromXlsformQuietly;
use Illuminate\Console\Command;
use Stats4sd\FilamentOdkLink\Jobs\PullSubmissionsFromXlsform;
use Stats4sd\FilamentOdkLink\Models\OdkLink\Xlsform;

class GetSubmissionsQuietly extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-submissions-quietly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pulls submissions from ODK Central without running any additional processing. No Entities are created; no custom models are created. Mostly used for testing';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $xlsforms = Xlsform::where('is_active', true)->get()
            ->each(function (Xlsform $xlsform) {
                $this->info("Processing {$xlsform->title}...");
                PullSubmissionsFromXlsformQuietly::dispatch($xlsform);
            });
    }
}
