<?php

namespace App\Filament\Admin\Resources\DatasetResource\Pages;

use App\Filament\Admin\Resources\DatasetResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDatasets extends ListRecords
{
    protected static string $resource = DatasetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
