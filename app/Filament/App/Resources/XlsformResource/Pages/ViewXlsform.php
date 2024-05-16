<?php

namespace App\Filament\App\Resources\XlsformResource\Pages;

use App\Filament\App\Resources\XlsformResource;
use App\Http\Controllers\SurveyMonitoringController;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Http;
use Stats4sd\FilamentOdkLink\Services\OdkLinkService;

class ViewXlsform extends ViewRecord
{
    protected static string $resource = XlsformResource::class;

    protected static string $view = 'filament.app.resources.xlsform-resource.pages.view-xlsform';

    public function getHeading(): string|Htmlable
    {
        return 'Submissions for form: ' . $this->record->title;
    }

    // Question: This function is being called twice now...
    // Is it possible to define a public variable to store the summary array?
    public function getSummary(): array
    {
        return (new SurveyMonitoringController())->getSubmissionSummary($this->record->owner, false);
    }

    public function exportAsExcelFile()
    {
        return app()->make(OdkLinkService::class)->exportAsExcelFile($this->getRecord());
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('download raw survey data')
                ->label('Download Raw Survey Data')
                // url instead of action because the downloadDataDirect function expects a full page reload instead of a livewire request. TODO - fix or remove this entire section when the proper downloads are ready.
                ->url(url('/resources/xlsform-resource/' . $this->record->id . '/download-data-direct-from-odk')),
            Action::Make('download-processed')
            ->label('Export Processed Data')
            ->url(url('/resources/xlsform-resource/' . $this->record->id . '/download-processed-data')),
        ];
    }


}
