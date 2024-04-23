<?php

namespace App\Filament\App\Resources\CaetInterpretationResource\Pages;

use App\Filament\App\Resources\CaetInterpretationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCaetInterpretation extends EditRecord
{
    protected static string $resource = CaetInterpretationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
