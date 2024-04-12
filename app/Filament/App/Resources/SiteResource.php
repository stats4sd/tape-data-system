<?php

namespace App\Filament\App\Resources;

use App\Models\Site;
use Awcodes\Shout\Components\Shout;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;

class SiteResource extends Resource
{
    protected static ?string $model = Site::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Identifying Information')
                    ->schema([

                        Forms\Components\TextInput::make('name')
                            ->label('Enter an identifiable name for the site.')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('location')
                            ->label('Describe the geographic location of the survey site. (e.g., which administrative zone(s) does it cover, what are the boundaries, etc?)'),
                    ]),
                Forms\Components\Section::make('Agroecological Zone')
                    ->schema([

                        Shout::make('ae-zone-info')
                            ->content(fn (): HtmlString => new HtmlString(
                                'To find out the dominant AEZ, you either need to know the GPS coordinates of the site, or be able to find it on a map.
                        Click the link here to take you to an FAO tool that allows you to explore a map with the AE Zones shown. To use the map tool:
                        <br/>
                        <ul>
                        <li>Make sure you select the period TP_2010 (1981 - 2010)</
                        <li>Select the Open Street Map as the base map. This will let you see the names of places in the map under the AEZ classification layer.
                        We suggest reducing the opacity of the AEZ layer to around 50% so you can see the base map.</li>
                        <li>When you click a point on the map, a box will appear with information about the AEZ.</li>
                        <li>Alternatively, if you know the GPS co-ordinates of the site, you can paste them into the box that says "Search for locations" in the top left of the page.</li>
                        </ul><br/>
                        When you have found the dominant AE Zone for the site, select it from the dropdown below. You can type into the box to filter the list.'
                            ))
                        ->hiddenOn('view'),
                        Forms\Components\Select::make('ae_zone_id')
                            ->searchable()
                            ->preload()
                            ->label('Using the FAO classification of Agroecological Zones, what is the dominant FAO AEZ of the site?')
                            ->relationship('aeZone', 'name'),
                    ])

            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('aeZone.name'),
                Tables\Columns\TextColumn::make('location')->limit(50),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            \App\Filament\App\Resources\SiteResource\RelationManagers\AgSystemsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\App\Resources\SiteResource\Pages\ListSites::route('/'),
            'view' => \App\Filament\App\Resources\SiteResource\Pages\ViewSite::route('/{record}')
        ];
    }
}
