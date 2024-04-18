<?php

namespace App\Filament\App\Clusters\LookupTables\Resources\UnitResource\Pages;

use App\Filament\Actions\CreateLookupListEntryAction;
use App\Filament\App\Clusters\LookupTables\Resources\UnitResource;
use App\Models\LookupTables\Unit;
use App\Services\HelperService;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;

class ListUnits extends ListRecords
{
    protected static string $resource = UnitResource::class;

    protected ?string $heading = 'Contextualise Survey: Units';

    protected function getHeaderActions(): array
    {
        return [
            CreateLookupListEntryAction::make()
                ->label('Add Local Unit'),

            Action::make('Mark as Complete')
            ->requiresConfirmation()
            ->action(fn () => HelperService::getSelectedTeam()?->markLookupListAsComplete(Unit::getLinkedDataset()))
            ->visible(fn () => ! HelperService::getSelectedTeam()?->hasCompletedLookupList(Unit::getLinkedDataset())),

            Action::make('Mark as Incomplete')
            ->requiresConfirmation()
            ->action(fn () => HelperService::getSelectedTeam()?->markLookupListAsIncomplete(Unit::getLinkedDataset()))
            ->visible(fn () => HelperService::getSelectedTeam()?->hasCompletedLookupList(Unit::getLinkedDataset())),
        ];
    }
}
