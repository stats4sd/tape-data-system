<?php

namespace App\Filament\App\Resources\FarmResource\Pages;

use App\Filament\App\Resources\FarmResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFarm extends EditRecord
{
    protected static string $resource = FarmResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
