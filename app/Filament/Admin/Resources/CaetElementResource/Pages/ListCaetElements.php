<?php

namespace App\Filament\Admin\Resources\CaetElementResource\Pages;

use App\Filament\Admin\Resources\CaetElementResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCaetElements extends ListRecords
{
    protected static string $resource = CaetElementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
