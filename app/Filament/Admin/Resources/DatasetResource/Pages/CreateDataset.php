<?php

namespace App\Filament\Admin\Resources\DatasetResource\Pages;

use App\Filament\Admin\Resources\DatasetResource;
use App\Filament\Templates\CreateRecordWithRedirect;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDataset extends CreateRecordWithRedirect
{
    protected static string $resource = DatasetResource::class;
}
