<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\FarmGroupResource\Pages;
use App\Filament\App\Resources\FarmGroupResource\RelationManagers;
use App\Models\SampleFrame\FarmGroup;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FarmGroupResource extends Resource
{
    protected static ?string $model = FarmGroup::class;
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
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
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
            'index' => Pages\ListFarmGroups::route('/'),
            'create' => Pages\CreateFarmGroup::route('/create'),
            'edit' => Pages\EditFarmGroup::route('/{record}/edit'),
        ];
    }
}
