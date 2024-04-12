<?php

namespace App\Filament\App\Clusters\LookupTables\Resources\AnimalProductResource\Pages;

use App\Filament\App\Clusters\LookupTables\Resources\AnimalProductResource;
use Filament\Resources\Pages\CreateRecord;

class CreateAnimalProduct extends CreateRecord
{
    protected static string $resource = AnimalProductResource::class;
}
