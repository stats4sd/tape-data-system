<?php

namespace App\Filament\App\Resources\AgSystemResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FarmsRelationManager extends RelationManager
{
    protected static string $relationship = 'farms';

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('team_code')->label('Unique Code')
                    ->sortable(),
                Tables\Columns\TextColumn::make('farmGroups.name')->listWithLineBreaks()->badge(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('farmGroup')
                    ->relationship('farmGroups', 'name')
                    ->multiple()
                    ->preload()
            ])
            ->headerActions([
                Tables\Actions\AssociateAction::make()->preloadRecordSelect()->multiple()
            ])
            ->actions([
                Tables\Actions\DissociateAction::make(),
            ]);
    }
}
