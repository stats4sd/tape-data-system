<?php

namespace App\Filament\Templates;

use Filament\Resources\Pages\CreateRecord;

class CreateRecordWithRedirect extends CreateRecord
{

    // redirect back to index unless that is impossible
    protected function getRedirectUrl(): string
    {
        $resource = static::getResource();

        return $resource::getUrl('index');
    }
}
