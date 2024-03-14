<?php

namespace App\Filament\Templates;

use Filament\Resources\Pages\EditRecord;

class EditRecordWithRedirect extends EditRecord
{

    // redirect back to index unless that is impossible
    protected function getRedirectUrl(): string
    {
        $resource = static::getResource();

        return $resource::getUrl('index');
    }
}
