<?php

namespace App\Filament\App\Clusters\LookupTables\Pages;

use App\Filament\App\Clusters\LookupTables\DatasetResource;
use Filament\Resources\Pages\ListRecords;

class ListDatasets extends ListRecords
{
    protected static string $resource = DatasetResource::class;

    protected ?string $heading = 'Contextualise Survey Lookups';
    protected ?string $subheading = 'The core TAPE survey includes a number of select questions that can be modified to suit the local context. The table below shows all the lookup lists that can be modified.';

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
