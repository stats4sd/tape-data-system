<?php

namespace App\Filament\App\Clusters\LookupTables\Resources\CropProductResource\Pages;

use App\Filament\App\Clusters\LookupTables\Resources\CropProductResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCropProducts extends ListRecords
{
    protected static string $resource = CropProductResource::class;

    protected ?string $heading = 'Contextualise Survey: Crop Products';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
