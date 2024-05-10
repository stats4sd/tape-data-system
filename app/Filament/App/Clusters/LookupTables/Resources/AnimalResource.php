<?php

namespace App\Filament\App\Clusters\LookupTables\Resources;

use App\Filament\App\Clusters\LookupTables;
use App\Filament\App\Clusters\LookupTables\Resources\AnimalResource\Pages;
use App\Filament\Traits\IsLookupListResource;
use App\Models\LookupTables\Animal;
use Awcodes\Shout\Components\Shout;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;

class AnimalResource extends Resource
{
    use IsLookupListResource;

    protected static ?string $model = Animal::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Optional Lists';


    protected static ?int $navigationSort = 1;

    protected static ?string $cluster = LookupTables::class;

    private static function getExtraFormFields(): array
    {
        return [
            Shout::make('validation_fields')
                ->content('In these next fields, please enter the highest likely value for the questions given. The values will be used to set "soft" validation checks for the listed question in the ODK survey.'),
            TextInput::make('raised_max')
                ->integer()
                ->label('Number of animals currently raised in the farm'),
            TextInput::make('breeds_max')
                ->integer()
                ->label('Number of breeds of this species'),
            TextInput::make('born_max')
                ->integer()
                ->label('Number of animals that were born during the last 12 months'),
            TextInput::make('died_max')
                ->integer()
                ->label('Number of animals that died of natural causes during the last 12 months'),
            TextInput::make('slaughtered_max')
                ->integer()
                ->label('Number of animals that were slaughtered during the last 12 months'),
            TextInput::make('purchased_max')
                ->integer()
                ->label('Number of animals that were purchased during the last 12 months'),
            TextInput::make('sold_max')
                ->integer()
                ->label('Number of animals sold'),
            TextInput::make('farmgate_max')
                ->integer()
                ->label('Farm-gate price of this animal (per animal)'),
            TextInput::make('gifted_max')
                ->integer()
                ->label('Number of animals given for free (gift, present …)'),
            TextInput::make('expenditures_feed_max')
                ->integer()
                ->label('Total expenditures for FEED for this animal:'),
            TextInput::make('expenditures_vet_max')
                ->integer()
                ->label('Total expenditures for VETERINARY SERVICES for this animal:'),

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
            'index' => Pages\ListAnimals::route('/'),
        ];
    }
}
