<?php

namespace App\Filament\App\Clusters\LookupTables\Resources\AnimalResource\Pages;

use App\Filament\App\Clusters\LookupTables\Resources\AnimalResource;
use App\Models\Interfaces\LookupListEntry;
use App\Models\LookupTables\Animal;
use Filament\Actions;
use Filament\Facades\Filament;
use Filament\Resources\Pages\ListRecords;

class ListAnimals extends ListRecords
{
    protected static string $resource = AnimalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label('Add new animal list entry')
                ->mutateFormDataUsing(fn (array $data): array => collect($data)->put('team_id', Filament::getTenant()->id)->toArray()),

            Actions\Action::make('Mark as Complete')
            ->requiresConfirmation()
            ->action(fn () => Filament::getTenant()->markLookupListAsComplete(Animal::getLinkedDataset()))
            ->visible(fn () => ! Filament::getTenant()->hasCompletedLookupList(Animal::getLinkedDataset())),

            Actions\Action::make('Mark as Incomplete')
            ->requiresConfirmation()
            ->action(fn () => Filament::getTenant()->markLookupListAsIncomplete(Animal::getLinkedDataset()))
            ->visible(fn () => Filament::getTenant()->hasCompletedLookupList(Animal::getLinkedDataset())),
        ];
    }
}
