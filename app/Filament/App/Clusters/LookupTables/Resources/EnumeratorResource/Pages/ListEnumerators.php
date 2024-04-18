<?php

namespace App\Filament\App\Clusters\LookupTables\Resources\EnumeratorResource\Pages;

use App\Filament\Actions\CreateLookupListEntryAction;
use App\Filament\App\Clusters\LookupTables\Resources\EnumeratorResource;
use App\Models\LookupTables\Enumerator;
use App\Services\HelperService;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;

class ListEnumerators extends ListRecords
{
    protected static string $resource = EnumeratorResource::class;

    protected ?string $heading = 'Contextualise Survey: Enumerators';

    protected function getHeaderActions(): array
    {
        return [

            CreateLookupListEntryAction::make()
                ->label('Add Enumerator'),

            Action::make('Mark as Complete')
                ->requiresConfirmation()
                ->action(fn () => HelperService::getSelectedTeam()?->markLookupListAsComplete(Enumerator::getLinkedDataset()))
                ->visible(fn () => !HelperService::getSelectedTeam()?->hasCompletedLookupList(Enumerator::getLinkedDataset())),

            Action::make('Mark as Incomplete')
                ->requiresConfirmation()
                ->action(fn () => HelperService::getSelectedTeam()?->markLookupListAsIncomplete(Enumerator::getLinkedDataset()))
                ->visible(fn () => HelperService::getSelectedTeam()?->hasCompletedLookupList(Enumerator::getLinkedDataset())),

        ];
    }
}
