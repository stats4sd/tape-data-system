<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\CaetElementResource\Pages;
use App\Models\CaetElement;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CaetElementResource extends Resource
{
    protected static ?string $model = CaetElement::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
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
            'index' => Pages\ListCaetElements::route('/'),
            'create' => Pages\CreateCaetElement::route('/create'),
            'edit' => Pages\EditCaetElement::route('/{record}/edit'),
        ];
    }
}
