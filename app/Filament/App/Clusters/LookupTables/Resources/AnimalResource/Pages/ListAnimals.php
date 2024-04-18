<?php

namespace App\Filament\App\Clusters\LookupTables\Resources\AnimalResource\Pages;

use App\Filament\Actions\CreateLookupListEntryAction;
use App\Filament\App\Clusters\LookupTables\Resources\AnimalResource;
use App\Models\LookupTables\Animal;
use App\Services\HelperService;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAnimals extends ListRecords
{
    protected static string $resource = AnimalResource::class;

    protected ?string $heading = 'Contextualise Survey: Animals';

    protected function getHeaderActions(): array
    {
        return [
            CreateLookupListEntryAction::make()
            ->label('Add Animal'),

            Actions\Action::make('Mark as Complete')
            ->requiresConfirmation()
            ->action(fn () => HelperService::getSelectedTeam()?->markLookupListAsComplete(Animal::getLinkedDataset()))
            ->visible(fn () => ! HelperService::getSelectedTeam()?->hasCompletedLookupList(Animal::getLinkedDataset())),

            Actions\Action::make('Mark as Incomplete')
            ->requiresConfirmation()
            ->action(fn () => HelperService::getSelectedTeam()?->markLookupListAsIncomplete(Animal::getLinkedDataset()))
            ->visible(fn () => HelperService::getSelectedTeam()?->hasCompletedLookupList(Animal::getLinkedDataset())),
        ];
    }
}
