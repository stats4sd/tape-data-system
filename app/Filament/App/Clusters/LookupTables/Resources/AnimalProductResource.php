<?php

namespace App\Filament\App\Clusters\LookupTables\Resources;

use App\Filament\App\Clusters\LookupTables;
use App\Filament\App\Clusters\LookupTables\Resources\AnimalProductResource\Pages;
use App\Filament\Traits\IsLookupListResource;
use App\Models\LookupTables\AnimalProduct;
use Awcodes\Shout\Components\Shout;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;

class AnimalProductResource extends Resource
{
    use IsLookupListResource;

    protected static ?string $model = AnimalProduct::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Optional Lists';

    protected static ?int $navigationSort = 2;

    protected static ?string $cluster = LookupTables::class;

    private static function getExtraFormFields(): array
    {
        return [
            Shout::make('validation_fields')
                ->content('In these next fields, please enter the highest likely value for the questions given. The values will be used to set "soft" validation checks for the listed question in the ODK survey.'),
            TextInput::make('total_max')
                ->integer()
                ->label('Total quantity produced'),
            TextInput::make('unit_default')
                ->label('Unit of measurement (for the total quantity'),
            TextInput::make('sold_max')
                ->integer()
                ->label('Quantity sold'),
            TextInput::make('farmgate_max')
                ->numeric()
                ->label('Farmgate price of this crop (per unit) :'),
            TextInput::make('given_max')
                ->integer()
                ->label('Quantity given for free (gift, present …)'),

        ];
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
        ];
    }
}
