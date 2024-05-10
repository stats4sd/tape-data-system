<?php

namespace App\Filament\App\Clusters\LookupTables\Resources;

use App\Filament\App\Clusters\LookupTables;
use App\Filament\App\Clusters\LookupTables\Resources\CropResource\Pages;
use App\Filament\Traits\IsLookupListResource;
use App\Models\LookupTables\Crop;
use Awcodes\Shout\Components\Shout;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;

class CropResource extends Resource
{
    use isLookupListResource;

    protected static ?string $model = Crop::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Optional Lists';

    protected static ?int $navigationSort = 3;

    protected static ?string $cluster = LookupTables::class;

    private static function getExtraFormFields(): array
    {
        return [
            Shout::make('validation_fields')
                ->content('In these next fields, please enter the highest likely value for the questions given. The values will be used to set "soft" validation checks for the listed question in the ODK survey.'),
            TextInput::make('total_max')
                ->integer()
                ->label('Enter the highest value for Total production (kg)'),
            TextInput::make('sold_max')
                ->integer()
                ->label('Enter the highest value for Quantity sold (kg)'),
            TextInput::make('farmgate_max')
                ->numeric()
                ->label('Enter the highest value for Farmgate price of this crop (per kg)'),
            TextInput::make('gift_max')
                ->integer()
                ->label('Enter the highest value for Quantity given for free (gift, present …) (Kg)'),
            TextInput::make('land_use_max')
                ->numeric()
                ->label('Enter the highest value for Land under production (ha)'),
            TextInput::make('varieties_max')
                ->integer()
                ->label('Enter the highest value for Number of varieties produced '),
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
            'index' => Pages\ListCrops::route('/'),
        ];
    }
}
