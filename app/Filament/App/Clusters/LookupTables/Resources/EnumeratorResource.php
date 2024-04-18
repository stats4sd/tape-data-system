<?php

namespace App\Filament\App\Clusters\LookupTables\Resources;

use App\Filament\App\Clusters\LookupTables;
use App\Filament\App\Clusters\LookupTables\Resources\EnumeratorResource\Pages;
use App\Filament\Traits\IsLookupListResource;
use App\Models\LookupTables\Enumerator;
use Filament\Resources\Resource;

class EnumeratorResource extends Resource
{
    use IsLookupListResource;

    protected static ?string $model = Enumerator::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $cluster = LookupTables::class;

    protected static ?string $navigationGroup = 'Required Lists';

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEnumerators::route('/'),
        ];
    }
}
