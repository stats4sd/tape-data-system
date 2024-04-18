<?php

namespace App\Filament\App\Clusters\LookupTables\Resources\CropResource\Pages;

use App\Filament\Actions\CreateLookupListEntryAction;
use App\Filament\App\Clusters\LookupTables\Resources\CropResource;
use App\Models\LookupTables\Crop;
use App\Services\HelperService;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCrops extends ListRecords
{
    protected static string $resource = CropResource::class;

    protected ?string $heading = 'Contextualise Survey: Crops';

    protected function getHeaderActions(): array
    {
        return [
            CreateLookupListEntryAction::make()
                ->label('Add Crop'),

            Actions\Action::make('Mark as Complete')
                ->requiresConfirmation()
                ->action(fn () => HelperService::getSelectedTeam()?->markLookupListAsComplete(Crop::getLinkedDataset()))
                ->visible(fn () => !HelperService::getSelectedTeam()?->hasCompletedLookupList(Crop::getLinkedDataset())),

            Actions\Action::make('Mark as Incomplete')
                ->requiresConfirmation()
                ->action(fn () => HelperService::getSelectedTeam()?->markLookupListAsIncomplete(Crop::getLinkedDataset()))
                ->visible(fn () => HelperService::getSelectedTeam()?->hasCompletedLookupList(Crop::getLinkedDataset())),
        ];
    }
}
