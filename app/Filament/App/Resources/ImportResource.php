<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\ImportResource\Pages;
use App\Filament\Infolists\Components\ListRepeatableEntry;
use App\Models\Import;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\Section;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;

class ImportResource extends Resource
{
    protected static ?string $model = Import::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Section::make('Import Info')
                ->schema([
                    TextEntry::make('model_type')->label('Import for:')->inlineLabel(),
                    TextEntry::make('created_at')->label('Date:')->inlineLabel(),
                    TextEntry::make('file_name')->label('File Name:')->inlineLabel()
                        ->url(fn ($record) => $record->getFirstMediaUrl()),
                    IconEntry::make('success')->label('Status:')->inlineLabel(),
                ]),
            ListRepeatableEntry::make('errors')
                ->contained(false)
                ->extraAttributes(['class' => 'space-y-0'])
                ->schema([
                    TextEntry::make('location')
                        ->label('Location')
                        ->inlineLabel()
                        ->formatStateUsing(function ($state) {
                            $state = explode(",", $state);
                            return new HtmlString("Row: {$state[0]}, Column: {$state[1]}");
                        }),
                    TextEntry::make('errors')->hiddenLabel()->columnSpanFull()
                        ->bulleted()
                ])
                ->columns(2)

        ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('model_type')->label('Import for'),
                Tables\Columns\TextColumn::make('created_at')->label('Date'),
                Tables\Columns\TextColumn::make('file_name')->label('File Name')
                    ->url(fn ($record) => $record->getFirstMediaUrl()),
                Tables\Columns\IconColumn::make('success')->label('Status')->boolean(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->modalHeading(''),
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
            'index' => Pages\ListImports::route('/'),
            'create' => Pages\CreateImport::route('/create'),
            'edit' => Pages\EditImport::route('/{record}/edit'),
        ];
    }
}
