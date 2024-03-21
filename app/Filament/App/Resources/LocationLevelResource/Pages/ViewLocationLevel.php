<?php

namespace App\Filament\App\Resources\LocationLevelResource\Pages;

use App\Filament\App\Resources\LocationLevelResource;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Str;

class ViewLocationLevel extends ViewRecord
{
    protected static string $resource = LocationLevelResource::class;

    public function getTitle(): string|Htmlable
    {
        return Str::of($this->record->name)->plural()->title();
    }
}
