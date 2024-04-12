<?php

namespace App\Filament\App\Clusters\LookupTables\Resources;

use App\Filament\App\Clusters\LookupTables;
use App\Filament\App\Clusters\LookupTables\Resources\AnimalResource\Pages;
use App\Filament\Traits\IsLookupListResource;
use App\Models\LookupTables\Animal;
use Filament\Forms\Form;
use Filament\Resources\Resource;

class AnimalResource extends Resource
{
    use IsLookupListResource;

    protected static ?string $model = Animal::class;

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
            'index' => Pages\ListAnimals::route('/'),
            'create' => Pages\CreateAnimal::route('/create'),
            'edit' => Pages\EditAnimal::route('/{record}/edit'),
        ];
    }
}
