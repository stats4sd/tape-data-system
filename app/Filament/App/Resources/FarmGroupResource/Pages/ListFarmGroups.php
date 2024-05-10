<?php

namespace App\Filament\App\Resources\FarmGroupResource\Pages;

use App\Filament\App\Resources\FarmGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFarmGroups extends ListRecords
{
    protected static string $resource = FarmGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
