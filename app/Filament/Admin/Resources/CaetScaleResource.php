<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\CaetScaleResource\Pages;
use App\Models\CaetScale;
use Awcodes\Shout\Components\Shout;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CaetScaleResource extends Resource
{
    protected static ?string $model = CaetScale::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'CAET Elements and Indices';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Shout::make('note')
                    ->content(fn ($record) => "Editing Scale entry for the element {$record->caetIndex->caetElement->name}; index {$record->caetIndex->name}."),
                TextInput::make('score')
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(4)
                    ->step(0.5)
                    ->required(),
                Textarea::make('definition')->required()
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('caetIndex.caetElement.name')
                    ->label('Element')
                    ->wrap(),
                Tables\Columns\TextColumn::make('caetIndex.name')
                    ->label('Index')
                    ->wrap(),
                Tables\Columns\TextColumn::make('score'),
                Tables\Columns\TextColumn::make('definition')
                    ->wrap(),

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
            'index' => Pages\ListCaetScales::route('/'),
        ];
    }
}
