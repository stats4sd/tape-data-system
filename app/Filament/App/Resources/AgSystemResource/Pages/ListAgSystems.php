<?php

namespace App\Filament\App\Resources\AgSystemResource\Pages;

use App\Filament\App\Resources\AgSystemResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAgSystems extends ListRecords
{
    protected static string $resource = AgSystemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
