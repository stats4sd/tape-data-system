<?php

namespace App\Filament\App\Clusters\LookupTables\Resources;

use App\Filament\App\Clusters\LookupTables;
use App\Filament\App\Clusters\LookupTables\Resources\CropProductResource\Pages;
use App\Filament\Traits\IsLookupListResource;
use App\Models\LookupTables\CropProduct;
use Awcodes\Shout\Components\Shout;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;

class CropProductResource extends Resource
{
    use IsLookupListResource;

    protected static ?string $model = CropProduct::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Optional Lists';

    protected static ?int $navigationSort = 4;

    protected static ?string $cluster = LookupTables::class;

        public static function canEditGlobalItems(): bool
    {
        return true;
    }

    private static function getExtraFormFields(): array
    {
        return [
            Section::make('Validation - Maximums')
                ->columnSpanFull()
                ->columns(1)
                ->schema([
                    Shout::make('validation_fields')
                        ->content('In these next fields, please enter the highest likely value for the questions given. The values will be used to set "soft" validation checks for the listed question in the ODK survey.'),
                    TextInput::make('total_max')
                        ->integer()
                        ->label('Total quantity produced'),
                    TextInput::make('unit_default')
                        ->label('Unit of measurement (that that the total quantities are in'),
                    TextInput::make('sold_max')
                        ->integer()
                        ->label('Quantity sold'),
                    TextInput::make('farmgate_max')
                        ->numeric()
                        ->label('Farmgate price of this crop product (per unit) :'),
                    TextInput::make('given_max')
                        ->integer()
                        ->label('Quantity given for free (gift, present …)'),
                ])
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
            'index' => Pages\ListCropProducts::route('/'),
        ];
    }
}
