<?php

namespace App\Filament\App\Clusters\LookupTables\Pages;

use App\Filament\App\Clusters\LookupTables\DatasetResource;
use Filament\Resources\Pages\CreateRecord;

class CreateDataset extends CreateRecord
{
    protected static string $resource = DatasetResource::class;
}
