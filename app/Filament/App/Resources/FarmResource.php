<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\FarmResource\Pages;
use App\Models\SampleFrame\Farm;
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

        $identifiers = Farm::all()->map(fn (Farm $farm) => $farm->identifiers->keys())
            ->flatten()->unique()->values();

        $idColumns = $identifiers->map(fn ($identifier) => Tables\Columns\TextColumn::make("identifiers.{$identifier}")->label(ucfirst($identifier)));

        return $table
            ->columns([
                Tables\Columns\TextColumn::make('site.name'),
                Tables\Columns\TextColumn::make('location.name'),
                Tables\Columns\TextColumn::make('team_code')->label('Unique Code'),
                ...$idColumns,

            ])
            ->filters([
                //
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
