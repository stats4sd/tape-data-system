<?php

namespace App\Filament\App\Resources\LocationLevelResource\Pages;

use App\Filament\App\Resources\LocationLevelResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLocationLevel extends EditRecord
{
    protected static string $resource = LocationLevelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
