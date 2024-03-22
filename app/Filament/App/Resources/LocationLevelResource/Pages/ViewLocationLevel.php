<?php

namespace App\Filament\App\Resources\LocationLevelResource\Pages;

use App\Filament\App\Resources\LocationLevelResource;
use App\Filament\Tables\Actions\ImportLocationsAction;
use App\Imports\LocationImport;
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

    protected function getHeaderActions(): array
    {


        return [
            ImportLocationsAction::make()
                ->use(LocationImport::class)
            ->color('primary')
            ->label('Import ' . Str::of($this->record->name)->plural()),
        ];
    }
}
