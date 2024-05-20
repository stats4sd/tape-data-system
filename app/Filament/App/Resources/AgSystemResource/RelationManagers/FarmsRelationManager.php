<?php

namespace App\Filament\App\Resources\AgSystemResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Tables\Table;
use App\Services\HelperService;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\RelationManagers\RelationManager;

class FarmsRelationManager extends RelationManager
{
    protected static string $relationship = 'farms';
    protected static ?string $inverseRelationship = 'agSystem';

    public function isReadOnly(): bool
    {
        return false;
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('team_code')
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
                Tables\Actions\AssociateAction::make()
                    ->preloadRecordSelect()
                    ->recordSelect(
                        fn (Forms\Components\Select $select) => $select->placeholder('Select a farm'),
                    )
                    ->recordSelectOptionsQuery(fn (Builder $query) => $query->where('owner_id', HelperService::getSelectedTeam()->id))
            ])
            ->actions([
                Tables\Actions\DissociateAction::make(),
            ]);
    }
}
