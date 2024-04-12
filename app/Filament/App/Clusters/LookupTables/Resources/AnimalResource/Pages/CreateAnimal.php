<?php

namespace App\Filament\App\Clusters\LookupTables\Resources\AnimalResource\Pages;

use App\Filament\App\Clusters\LookupTables\Resources\AnimalResource;
use Filament\Resources\Pages\CreateRecord;

class CreateAnimal extends CreateRecord
{
    protected static string $resource = AnimalResource::class;
}
