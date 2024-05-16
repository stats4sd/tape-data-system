<?php

namespace App\Filament\App\Resources\AgSystemResource\Pages;

use App\Filament\App\Resources\AgSystemResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewAgSystem extends ViewRecord
{
    protected static string $resource = AgSystemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()
                ->label('Edit'),
        ];
    }
}
