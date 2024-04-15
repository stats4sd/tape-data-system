<?php

namespace App\Filament\App\Clusters\LookupTables\Resources;

use App\Filament\App\Clusters\LookupTables;
use App\Filament\App\Clusters\LookupTables\Resources\UnitResource\Pages;
use App\Filament\Traits\IsLookupListResource;
use App\Models\LookupTables\Unit;
use Filament\Resources\Resource;

class UnitResource extends Resource
{
    use IsLookupListResource;

    protected static ?string $model = Unit::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?int $navigationSort = 0;
    protected static ?string $navigationGroup = 'Required Tables';

    protected static ?string $cluster = LookupTables::class;

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUnits::route('/'),
        ];
    }
}
