<?php

namespace App\Filament\Admin\Resources\DatasetResource\Pages;

use App\Filament\Admin\Resources\DatasetResource;
use App\Filament\Templates\EditRecordWithRedirect;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDataset extends EditRecordWithRedirect
{
    protected static string $resource = DatasetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
