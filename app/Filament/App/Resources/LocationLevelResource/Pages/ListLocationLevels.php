<?php

namespace App\Filament\App\Resources\LocationLevelResource\Pages;

use App\Filament\App\Resources\LocationLevelResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLocationLevels extends ListRecords
{
    protected static string $resource = LocationLevelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
