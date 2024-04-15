<?php

namespace App\Filament\App\Clusters\LookupTables\Resources\AnimalProductResource\Pages;

use App\Filament\App\Clusters\LookupTables\Resources\AnimalProductResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAnimalProducts extends ListRecords
{
    protected static string $resource = AnimalProductResource::class;

    protected ?string $heading = 'Contextualise Survey: Animal Products';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
