<?php

namespace App\Filament\App\Clusters\LookupTables\Resources\AnimalProductResource\Pages;

use App\Filament\Actions\CreateLookupListEntryAction;
use App\Filament\App\Clusters\LookupTables\Resources\AnimalProductResource;
use App\Models\LookupTables\AnimalProduct;
use App\Services\HelperService;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;

class ListAnimalProducts extends ListRecords
{
    protected static string $resource = AnimalProductResource::class;

    protected ?string $heading = 'Contextualise Survey: Animal Products';

    protected function getHeaderActions(): array
    {
        return [
            CreateLookupListEntryAction::make()
            ->label('Add Animal Product'),

            Action::make('Mark as Complete')
            ->requiresConfirmation()
            ->action(fn () => HelperService::getSelectedTeam()?->markLookupListAsComplete(AnimalProduct::getLinkedDataset()))
            ->visible(fn () => ! HelperService::getSelectedTeam()?->hasCompletedLookupList(AnimalProduct::getLinkedDataset())),

            Action::make('Mark as Incomplete')
            ->requiresConfirmation()
            ->action(fn () => HelperService::getSelectedTeam()?->markLookupListAsIncomplete(AnimalProduct::getLinkedDataset()))
            ->visible(fn () => HelperService::getSelectedTeam()?->hasCompletedLookupList(AnimalProduct::getLinkedDataset())),

        ];
    }
}
