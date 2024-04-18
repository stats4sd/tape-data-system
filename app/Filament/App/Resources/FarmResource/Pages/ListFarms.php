<?php

namespace App\Filament\App\Resources\FarmResource\Pages;

use App\Filament\App\Resources\FarmResource;
use App\Filament\Tables\Actions\ImportFarmsAction;
use App\Imports\FarmImport;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFarms extends ListRecords
{
    protected static string $resource = FarmResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            FarmResource\Widgets\FarmListHeaderWidget::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            ImportFarmsAction::make()
                ->use(FarmImport::class)
                ->color('primary')
                ->label('Import Farm list'),
        ];
    }
}
