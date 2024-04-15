<?php

namespace App\Filament\App\Clusters\LookupTables\Resources;

use App\Filament\App\Clusters\LookupTables;
use App\Filament\App\Clusters\LookupTables\Resources\CropResource\Pages;
use App\Filament\Traits\IsLookupListResource;
use App\Models\LookupTables\Crop;
use Filament\Resources\Resource;

class CropResource extends Resource
{
    use isLookupListResource;

    protected static ?string $model = Crop::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?int $navigationSort = 3;

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
            'index' => Pages\ListCrops::route('/'),
        ];
    }
}
