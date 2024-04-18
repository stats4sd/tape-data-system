<?php

namespace App\Filament\App\Clusters\LookupTables\Resources\EnumeratorResource\Pages;

use App\Filament\App\Clusters\LookupTables\Resources\EnumeratorResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEnumerator extends EditRecord
{
    protected static string $resource = EnumeratorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
