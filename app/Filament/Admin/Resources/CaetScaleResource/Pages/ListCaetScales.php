<?php

namespace App\Filament\Admin\Resources\CaetScaleResource\Pages;

use App\Filament\Admin\Resources\CaetScaleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCaetScales extends ListRecords
{
    protected static string $resource = CaetScaleResource::class;

    protected ?string $heading = 'CAET Elements and Indices';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
