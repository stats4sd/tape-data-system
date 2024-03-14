<?php

namespace App\Filament\Admin\Resources\DatasetResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VariablesRelationManager extends RelationManager
{
    protected static string $relationship = 'variables';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('id')
            ->label('Enter the variable name as it should appear in a dataset (column header)')
            ->helperText('Ideally, this should be in snake_case (e.g. "productive_activities")'),
                Forms\Components\TextInput::make('name')
                    ->label('The label for the variable')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
            ])
            ->columns(1);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('name'),
                TextColumn::make('description')->limit(50),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
