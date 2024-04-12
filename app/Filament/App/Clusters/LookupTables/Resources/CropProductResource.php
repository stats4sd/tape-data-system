<?php

namespace App\Filament\App\Clusters\LookupTables\Resources;

use App\Filament\App\Clusters\LookupTables;
use App\Filament\App\Clusters\LookupTables\Resources\CropProductResource\Pages;
use App\Filament\Traits\IsLookupListResource;
use App\Models\LookupTables\CropProduct;
use Filament\Forms\Form;
use Filament\Resources\Resource;

class CropProductResource extends Resource
{
    use IsLookupListResource;

    protected static ?string $model = CropProduct::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $cluster = LookupTables::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

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
            'create' => Pages\CreateCropProduct::route('/create'),
            'edit' => Pages\EditCropProduct::route('/{record}/edit'),
        ];
    }
}
