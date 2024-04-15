<?php

namespace App\Filament\App\Clusters\LookupTables\Resources\LookupTablesResource\Pages;

use App\Filament\App\Clusters\LookupTables\Resources\LookupTablesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLookupTables extends EditRecord
{
    protected static string $resource = LookupTablesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
