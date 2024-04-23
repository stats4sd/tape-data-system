<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\CaetInterpretationResource\Pages;
use App\Models\CaetInterpretation;
use Awcodes\Shout\Components\Shout;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CaetInterpretationResource extends Resource
{
    protected static ?string $model = CaetInterpretation::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'CAET';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Shout::make('info')
            ->content(fn(CaetInterpretation $record) => "Add a contextualised interpretation for the index {$record->caetIndex->name} of the element {$record->caetIndex->caetElement->name}."),
                Textarea::make('interpretation'),
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('caetIndex.caetElement.name')->label('Element'),
                Tables\Columns\TextColumn::make('caetIndex.name')->label('Index'),
                Tables\Columns\IconColumn::make('has_contextualised_interpretation')->label('Has Contextualised Interpretation?')
                ->boolean(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListCaetInterpretations::route('/'),
        ];
    }
}
