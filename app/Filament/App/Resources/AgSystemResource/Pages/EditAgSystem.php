<?php

namespace App\Filament\App\Resources\AgSystemResource\Pages;

use App\Filament\App\Resources\AgSystemResource;
use App\Models\AgSystem;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;

class EditAgSystem extends EditRecord
{
    protected static string $resource = AgSystemResource::class;

    // protected ?string $heading = 'Step 0 - Agricultural System Information';
    protected ?string $subheading = 'Add or edit information about the agricultural system. This will provide context for the survey data you collect.';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function getHeading(): string | Htmlable
    {
        return $this->getRecord()->name;
    }

    protected function handleRecordUpdate(AgSystem|Model $record, array $data): AgSystem
    {
        // most fields are for the properties json

        // remove fields that are *not* for properties:
        $name = $data['name'];

        unset($data['name']);


        $record->updateProperties($data);

        return $record;

    }

}
