<?php

namespace App\Filament\App\Clusters\LookupTables\Resources\CropProductResource\Pages;

use App\Filament\App\Clusters\LookupTables\Resources\CropProductResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCropProduct extends EditRecord
{
    protected static string $resource = CropProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
