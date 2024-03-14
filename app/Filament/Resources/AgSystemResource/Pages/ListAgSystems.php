<?php

namespace App\Filament\Resources\AgSystemResource\Pages;

use App\Filament\Resources\AgSystemResource;
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
