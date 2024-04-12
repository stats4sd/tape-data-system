<?php

namespace App\Filament\Traits;

use Filament\Facades\Filament;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

trait IsLookupListResource
{
    // do not use tenancy by default, but instead filter by tenancy + add in items with team_id === null;

    public static function isScopedToTenant(): bool
    {
        return false;
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereDoesntHave('team')
            ->orWhere('team_id', Filament::getTenant()->id);
    }

    // standard table
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('label'),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
            ])
            ->defaultPaginationPageOption('all');
    }

}
