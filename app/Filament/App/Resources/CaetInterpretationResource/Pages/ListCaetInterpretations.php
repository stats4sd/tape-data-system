<?php

namespace App\Filament\App\Resources\CaetInterpretationResource\Pages;

use App\Filament\App\Resources\CaetInterpretationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCaetInterpretations extends ListRecords
{
    protected static string $resource = CaetInterpretationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
