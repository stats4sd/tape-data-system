<?php

namespace App\Filament\App\Clusters\LookupTables\Resources;

use App\Filament\App\Clusters\LookupTables;
use App\Filament\App\Clusters\LookupTables\Resources\AnimalProductResource\Pages;
use App\Filament\Traits\IsLookupListResource;
use App\Models\LookupTables\AnimalProduct;
use Filament\Forms\Form;
use Filament\Resources\Resource;

class AnimalProductResource extends Resource
{
    use IsLookupListResource;

    protected static ?string $model = AnimalProduct::class;

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
            'index' => Pages\ListAnimalProducts::route('/'),
            'create' => Pages\CreateAnimalProduct::route('/create'),
            'edit' => Pages\EditAnimalProduct::route('/{record}/edit'),
        ];
    }
}
