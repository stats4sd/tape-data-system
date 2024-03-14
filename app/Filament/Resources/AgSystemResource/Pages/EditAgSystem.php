<?php

namespace App\Filament\Resources\AgSystemResource\Pages;

use App\Filament\Resources\AgSystemResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditAgSystem extends EditRecord
{
    protected static string $resource = AgSystemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        // most fields are for the properties json

        // remove fields that are *not* for properties:
        $name = $data['name'];

        unset($data['name']);


        $props = $record->properties;

        foreach($data as $key => $value) {
            $props[$key] = $value;
        }

        $record->update([
            'name' => $name,
            'properties' => $props,
        ]);

    }

}
