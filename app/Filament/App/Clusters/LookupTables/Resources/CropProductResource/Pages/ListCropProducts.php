<?php

namespace App\Filament\App\Clusters\LookupTables\Resources\CropProductResource\Pages;

use App\Filament\Actions\CreateLookupListEntryAction;
use App\Filament\App\Clusters\LookupTables\Resources\CropProductResource;
use App\Models\LookupTables\CropProduct;
use App\Services\HelperService;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCropProducts extends ListRecords
{
    protected static string $resource = CropProductResource::class;

    protected ?string $heading = 'Contextualise Survey: Crop Products';

    protected function getHeaderActions(): array
    {
        return [
            CreateLookupListEntryAction::make()
                ->label('Add Crop Product'),

            Actions\Action::make('Mark as Complete')
                ->requiresConfirmation()
                ->action(fn () => HelperService::getSelectedTeam()?->markLookupListAsComplete(CropProduct::getLinkedDataset()))
                ->visible(fn () => !HelperService::getSelectedTeam()?->hasCompletedLookupList(CropProduct::getLinkedDataset())),

            Actions\Action::make('Mark as Incomplete')
                ->requiresConfirmation()
                ->action(fn () => HelperService::getSelectedTeam()?->markLookupListAsIncomplete(CropProduct::getLinkedDataset()))
                ->visible(fn () => HelperService::getSelectedTeam()?->hasCompletedLookupList(CropProduct::getLinkedDataset())),
        ];
    }
}
