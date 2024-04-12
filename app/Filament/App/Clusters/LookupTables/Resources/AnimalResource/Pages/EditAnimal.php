<?php

namespace App\Filament\App\Clusters\LookupTables\Resources\AnimalResource\Pages;

use App\Filament\App\Clusters\LookupTables\Resources\AnimalResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAnimal extends EditRecord
{
    protected static string $resource = AnimalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
