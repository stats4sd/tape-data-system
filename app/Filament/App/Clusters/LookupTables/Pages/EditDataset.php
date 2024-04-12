<?php

namespace App\Filament\App\Clusters\LookupTables\Pages;

use App\Filament\App\Clusters\LookupTables\DatasetResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDataset extends EditRecord
{
    protected static string $resource = DatasetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
