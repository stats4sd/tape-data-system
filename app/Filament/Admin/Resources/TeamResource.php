<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\TeamResource\Pages;
use App\Filament\Admin\Resources\TeamResource\RelationManagers\UsersRelationManager;
use App\Models\Team;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Stats4sd\FilamentOdkLink\Filament\Resources\TeamResource\RelationManagers\XlsformsRelationManager;

class TeamResource extends \Stats4sd\FilamentOdkLink\Filament\Resources\TeamResource
{
    protected static ?string $model = Team::class;

    public static function getRelations(): array
    {
        return [
            UsersRelationManager::class,
            XlsformsRelationManager::class,
        ];
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                TextEntry::make('description')->hiddenLabel(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('avatar'),
                TextColumn::make('name'),
                TextColumn::make('xlsforms_count')
                    ->label('# Xlsforms')
                    ->counts('xlsforms'),
                TextColumn::make('users_count')
                    ->label('# Users')
                    ->counts('users'),
                TextColumn::make('created_at'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTeams::route('/'),
            'view' => Pages\ViewTeam::route('/{record}'),
        ];
    }
}
