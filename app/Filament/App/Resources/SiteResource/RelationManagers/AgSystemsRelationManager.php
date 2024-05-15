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

        // This form is only used for creating new records. Editing is done in the AgSystemResource.
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Enter an identifiable name for the Agricultural System.')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->heading(fn () => 'Agricultural Systems')
            ->description(fn () => 'All farms that will be surveyed exist within a broader agricultural system, and each geographical site may have multiple systems. Systems have distinct characteristics, including biophysical, social and economic features, that influence the activities and productivity of the farms. This section allows you to define the systems that the farms in the study belong to, which will help to contextualise the farm-level data collected.')
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\IconColumn::make('is_complete'),
                Tables\Columns\TextColumn::make('farms_count')
                    ->label('# of Farms')
                    ->counts('farms'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Add new Entry')
                    // Redirect the user to the edit page after creating a new record
                    ->successRedirectUrl(fn ($record) => AgSystemResource::getUrl('edit', ['record' => $record])),
            ])
            ->actions([
                Tables\Actions\Action::make('Edit')
                    ->icon('heroicon-o-pencil')
                    ->link()
                    ->url(fn ($record) => AgSystemResource::getUrl('edit', ['record' => $record])),
                Tables\Actions\DeleteAction::make(),
            ]);
    }
}
