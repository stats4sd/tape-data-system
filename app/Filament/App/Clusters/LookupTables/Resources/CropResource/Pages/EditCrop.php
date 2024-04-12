<?php

namespace App\Filament\App\Clusters\LookupTables\Resources\CropResource\Pages;

use App\Filament\App\Clusters\LookupTables\Resources\CropResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCrop extends EditRecord
{
    protected static string $resource = CropResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
