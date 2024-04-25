<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\SubmissionResource\Pages;
use App\Filament\App\Resources\SubmissionResource\RelationManagers;
use Awcodes\Shout\Components\Shout;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Table;
use Stats4sd\FilamentOdkLink\Models\OdkLink\Submission;

class SubmissionResource extends Resource
{
    protected static ?string $model = Submission::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Shout::make('disclaimer')
                    ->content('NOTE: This interface is a work in progress. We are currently exploring options for how best to enable editing of submission data after submission to fix errors identified during review. For now, if you are unsure of how to proceed, please contact the FAO TAPE team for advice.'),
                Forms\Components\Section::make('Submission Metadata')
                    ->schema([
                        Forms\Components\TextInput::make('odk_id')
                            ->label('ODK UUID')->readOnly(),
                        Forms\Components\TextInput::make('submitted_at')->readOnly()
                            ->disabled(),

                        // Hard coded stuff for TAPE Survey.
                        // NOTE: This will need to be updated whenever the ODK form is updated...
                        Forms\Components\TextInput::make('content.survey_start.inquirer')
                        ->label('Enumerator'),

                        Forms\Components\TextInput::make('content.start')
                        ->label('Survey Start Time'),
                        Forms\Components\TextInput::make('content.start')
                        ->label('Survey End Time'),

                    ])


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                DeleteAction::make(),
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
            'index' => Pages\ListSubmissions::route('/'),
        ];
    }
}
