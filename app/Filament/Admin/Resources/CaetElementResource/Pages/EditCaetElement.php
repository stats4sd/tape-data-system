<?php

namespace App\Filament\Admin\Resources\CaetElementResource\Pages;

use App\Filament\Admin\Resources\CaetElementResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCaetElement extends EditRecord
{
    protected static string $resource = CaetElementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
