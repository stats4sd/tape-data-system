<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\FarmResource\Pages;
use App\Models\SampleFrame\Farm;
use App\Models\SampleFrame\LocationLevel;
use App\Services\HelperService;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class FarmResource extends Resource
{
    protected static ?string $model = Farm::class;
    protected static ?string $navigationIcon = null;

    protected static ?string $tenantOwnershipRelationshipName = 'owner';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {

        $farms = Farm::all()->where('owner_id', HelperService::getSelectedTeam()->id);

        $locationLevelColumns = $farms->map(fn (Farm $farm) => $farm->location->locationLevel)
            ->unique()
            ->values()
            ->map(
                fn (LocationLevel $locationLevel) => Tables\Columns\TextColumn::make("location_{$locationLevel->id}")
                    ->getStateUsing(fn ($record) => $record->location->location_level_id === $locationLevel->id ? $record->location->name : '')
                    ->label($locationLevel->name)
                    ->sortable()
                    ->searchable()
            );


        $identifiers = $farms->map(fn (Farm $farm) => $farm->identifiers?->keys())
            ->flatten()->unique()->values();

        $idColumns = $identifiers->map(fn ($identifier) => Tables\Columns\TextColumn::make("identifiers.{$identifier}")->label(ucfirst($identifier))->sortable()->searchable());

        $properties = $farms->map(fn (Farm $farm) => $farm->properties?->keys())
            ->flatten()->unique()->values();

        $propertyColumns = $properties->map(fn ($property) => Tables\Columns\TextColumn::make("properties.{$property}")->label(ucfirst($property))->sortable()->searchable());

        return $table
            ->columns([
                Tables\Columns\TextColumn::make('agSystem.site.location.name')->label('Site'),
                ...$locationLevelColumns,
                Tables\Columns\TextColumn::make('agSystem.name')->label('Agricultural System'),
                Tables\Columns\TextColumn::make('team_code')->label('Unique Code')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('farmGroups.name')->listWithLineBreaks()->badge(),
                ...$idColumns,
                ...$propertyColumns,
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('farmGroup')
                    ->relationship('farmGroups', 'name')
                    ->multiple()
                    ->preload()
            ])
            ->actions([
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFarms::route('/'),
            'create' => Pages\CreateFarm::route('/create'),
            'edit' => Pages\EditFarm::route('/{record}/edit'),
        ];
    }
}
