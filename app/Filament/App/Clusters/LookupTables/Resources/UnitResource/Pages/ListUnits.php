<?php

namespace App\Filament\App\Clusters\LookupTables\Resources\UnitResource\Pages;

use App\Filament\App\Clusters\LookupTables\Resources\UnitResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUnits extends ListRecords
{
    protected static string $resource = UnitResource::class;

    protected ?string $heading = 'Contextualise Survey: Units';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
