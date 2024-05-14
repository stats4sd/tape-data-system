<?php

namespace App\Filament\App\Resources\XlsformResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\LookupTables\Enumerator;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\App\Resources\SubmissionResource;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Stats4sd\FilamentOdkLink\Models\OdkLink\Submission;
use Filament\Resources\RelationManagers\RelationManager;
use ValentinMorice\FilamentJsonColumn\FilamentJsonColumn;

class SubmissionsRelationManager extends RelationManager
{
    protected static string $relationship = 'submissions';

    public function isReadOnly(): bool
    {
        return false;
        $this->getSelectedTableRecords();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('odk_id')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),
                FilamentJsonColumn::make('content')
                    ->columnSpanFull(),
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
                // Tables\Columns\TextColumn::make('enumerator')
                // ->getStateUsing(function ($record) {
                //     $enumeratorId = $record->content['survey_start']['inquirer_choice'];
                //     if($enumeratorId === "77") {
                //         return $record->content['survey_start']['inquirer_text'];
                //     }
                //     return Enumerator::firstWhere('name', $record->content['survey_start']['inquirer_choice']) ?? '~not found~';
                // }),
                // Tables\Columns\TextColumn::make('farm_name')
                //     ->getStateUsing(function ($record) {
                //         return $record->content['reg']['farm_name'];
                //     }),
                // Tables\Columns\TextColumn::make('respondent_available')
                //     ->getStateUsing(function ($record) {
                //         return $record->content['reg']['respondent_check']['respondent_available'];
                //     }),
                // Tables\Columns\TextColumn::make('consent')
                //     ->getStateUsing(function ($record) {
                //         return $record->content['consent_grp']['consent'] === "1" ? "Yes" : "No";
                //     }),
            ])
            ->filters([
                //
            ])
            ->headerActions([])
            ->actions([
                Tables\Actions\EditAction::make(),

                // TODO: Edit button in table, click to show Edit page in a separate page instead of a popup modal
                // Tables\Actions\EditAction::make()
                //     ->url(fn (Submission $record): string => SubmissionResource::getUrl('edit', ['record' => $record])),

                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
