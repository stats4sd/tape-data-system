<?php

namespace App\Filament\App\Resources\XlsformResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SubmissionsRelationManager extends RelationManager
{
    protected static string $relationship = 'submissions';

    public function isReadOnly(): bool
    {
        return false;$this->getSelectedTableRecords()
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('odk_id')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->heading('')
            ->emptyStateDescription('Submissions will appear here once they have been submitted through ODK Collct and synced with the server.')
            ->recordTitleAttribute('odk_id')
            ->columns([
                Tables\Columns\TextColumn::make('odk_id'),
                Tables\Columns\TextColumn::make('submitted_at'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
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
