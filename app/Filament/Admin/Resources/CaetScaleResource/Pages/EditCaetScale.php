<?php

namespace App\Filament\Admin\Resources\CaetScaleResource\Pages;

use App\Filament\Admin\Resources\CaetScaleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCaetScale extends EditRecord
{
    protected static string $resource = CaetScaleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
