<?php

namespace App\Filament\App\Clusters\LookupTables\Resources;

use App\Filament\App\Clusters\LookupTables;
use App\Filament\App\Clusters\LookupTables\Resources\AnimalProductResource\Pages;
use App\Filament\Traits\IsLookupListResource;
use App\Models\LookupTables\AnimalProduct;
use Filament\Resources\Resource;

class AnimalProductResource extends Resource
{
    use IsLookupListResource;

    protected static ?string $model = AnimalProduct::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 2;

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
            'index' => Pages\ListAnimalProducts::route('/'),
        ];
    }
}
