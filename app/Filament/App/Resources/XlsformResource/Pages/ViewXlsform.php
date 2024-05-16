<?php

namespace App\Filament\App\Resources\XlsformResource\Pages;

use App\Filament\App\Resources\XlsformResource;
use App\Http\Controllers\SurveyMonitoringController;
use Filament\Actions\Action;
use Filament\Infolists\Components\Tabs;
use Filament\Infolists\Components\ViewEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;
use Stats4sd\FilamentOdkLink\Services\OdkLinkService;

class ViewXlsform extends ViewRecord
{
    protected static string $resource = XlsformResource::class;

    protected static string $view = 'filament.app.resources.xlsform-resource.pages.view-xlsform';

    public function hasCombinedRelationManagerTabsWithContent(): bool
    {
        return true;
    }

    public function getContentTabLabel(): ?string
    {
        return 'Summary';
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Tabs::make()
                ->columnSpanFull()
                ->tabs([
                    Tabs\Tab::make('Summary'),
                    Tabs\Tab::make('Per Location')
                    ->schema([
                        ViewEntry::make('locations')
                        ->view('infolists.components.locations-view-wrapper')
                    ]),
                    Tabs\Tab::make('Per Enumerator'),
                ]),
        ]);
    }

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
        ];
    }


}
