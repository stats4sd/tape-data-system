<?php

namespace App\Filament\App\Clusters\LookupTables\Resources;

use App\Filament\App\Clusters\LookupTables;
use App\Filament\App\Clusters\LookupTables\Resources\UnitResource\Pages;
use App\Filament\Traits\IsLookupListResource;
use App\Models\LookupTables\Unit;
use App\Services\HelperService;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;

class UnitResource extends Resource
{
    use IsLookupListResource;

    protected static ?string $model = Unit::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?int $navigationSort = 0;
    protected static ?string $navigationGroup = 'Required Tables';

    protected static ?string $cluster = LookupTables::class;


    // Provides a custom form for units. Most lookups only require name and label. Units also require 'type' and 'conversion_factor'.
    public static function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                Select::make('unit_type_id')
                    ->relationship('unitType', 'name')
                    ->label('What type of unit is this?')
                    ->required(),

                TextInput::make('name')
                    ->required()
                    ->unique()
                    ->label('Enter a unique code. This is what you will see in the exported data.')
                    ->validationMessages([
                        'required' => 'Please enter a unique code',
                        'unique' => 'This code is already in use. Please enter a unique code.',
                    ])
                    ->helperText('If you are familiar with ODK Form development, this corresponds to the "name" attribute of the <item> element in the XForm.'),

                TextInput::make('label')
                    ->required()
                    ->label('Enter a label. This is what enumerators will see in the survey. This should ideally include both the name of the unit and the conversion to the S.I units so enumerators have that information. For example "Baskets (1 basket = 8KG)".')
                    ->helperText('At present, this platform only supports additional choice options in English. Multiple language support will come soon!'),

                TextInput::make('conversion_rate')
                    ->required()
                    ->label('Enter the conversion rate. This is the number of S.I units that one unit of this measurement represents. For example, if one basket is 8kg, the conversion rate would be "8".'),


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
            'index' => Pages\ListUnits::route('/'),
        ];
    }
}
