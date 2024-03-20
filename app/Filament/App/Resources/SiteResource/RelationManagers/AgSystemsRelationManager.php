<?php

namespace App\Filament\App\Resources\SiteResource\RelationManagers;

use App\Filament\App\Resources\AgSystemResource;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class AgSystemsRelationManager extends RelationManager
{
    protected static string $relationship = 'agSystems';

    public function isReadOnly(): bool
    {
        return false;
    }


    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\IconColumn::make('is_complete')
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Add new Entry')
                    ->successRedirectUrl(fn($record) => AgSystemResource::getUrl('edit', ['record' => $record])),
            ])
            ->actions([
                Tables\Actions\Action::make('Edit')
                    ->icon('heroicon-o-pencil')
                    ->link()
                    ->url(fn($record) => AgSystemResource::getUrl('edit', ['record' => $record])),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
