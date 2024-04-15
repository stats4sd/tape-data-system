<?php

namespace App\Filament\App\Clusters\LookupTables\Resources;

use App\Filament\App\Clusters\LookupTables;
use App\Filament\App\Clusters\LookupTables\Resources\CropProductResource\Pages;
use App\Filament\Traits\IsLookupListResource;

use App\Models\LookupTables\CropProduct;
use Filament\Resources\Resource;

class CropProductResource extends Resource
{
    use IsLookupListResource;

    protected static ?string $model = CropProduct::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?int $navigationSort = 4;

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
            'index' => Pages\ListCropProducts::route('/'),
        ];
    }
}
