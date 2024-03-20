<?php

namespace App\Filament\App\Resources\AgSystemResource\Pages;

use App\Filament\App\Resources\AgSystemResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditAgSystem extends EditRecord
{
    protected static string $resource = AgSystemResource::class;

    protected ?string $heading = 'Step 0 - Agricultural System Information';
    protected ?string $subheading = 'Add or edit information about the agricultural system. This will provide context for the survey data you collect.';

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
