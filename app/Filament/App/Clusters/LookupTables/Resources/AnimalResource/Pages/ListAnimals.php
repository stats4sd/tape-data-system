<?php

namespace App\Filament\App\Clusters\LookupTables\Resources\AnimalResource\Pages;

use App\Filament\App\Clusters\LookupTables\Resources\AnimalResource;
use App\Models\LookupTables\Animal;
use App\Services\HelperService;
use Filament\Actions;
use Filament\Facades\Filament;
use Filament\Resources\Pages\ListRecords;

class ListAnimals extends ListRecords
{
    protected static string $resource = AnimalResource::class;

    protected ?string $heading = 'Contextualise Survey: Animals';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label('Add new animal list entry')
                ->mutateFormDataUsing(fn (array $data): array => collect($data)->put('team_id', Filament::getTenant()->id)->toArray()),

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
