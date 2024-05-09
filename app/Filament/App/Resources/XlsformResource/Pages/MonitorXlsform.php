<?php

namespace App\Filament\App\Resources\XlsformResource\Pages;

use Filament\Resources\Pages\Page;
use App\Filament\App\Resources\XlsformResource;
use App\Http\Controllers\SurveyMonitoringController;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;

class MonitorXlsform extends Page
{
    use InteractsWithRecord;

    protected static string $resource = XlsformResource::class;

    protected static string $view = 'filament.app.resources.xlsform-resource.pages.monitor-xlsform';

    public function mount(int | string $record): void
    {
        $this->record = $this->resolveRecord($record);
    }

    // Question: This function is being called twice now...
    // Is it possible to define a public variable to store the summary array?
    public function getSummary(): array
    {
        $surveyMonitoringController = new SurveyMonitoringController();
        $summary = $surveyMonitoringController->getSubmissionSummary($this->record->owner, false);

        return $summary;
    }
}
