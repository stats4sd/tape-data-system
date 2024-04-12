<?php

namespace App\Filament\App\Clusters\LookupTables\Resources\AnimalProductResource\Pages;

use App\Filament\App\Clusters\LookupTables\Resources\AnimalProductResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAnimalProduct extends EditRecord
{
    protected static string $resource = AnimalProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
