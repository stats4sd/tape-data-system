<?php

namespace App\Filament\App\Clusters\LookupTables\Resources;

use App\Filament\App\Clusters\LookupTables;
use App\Filament\App\Clusters\LookupTables\Resources\LookupTablesResource\Pages;
use App\Filament\Traits\IsLookupListResource;
use App\Models\Dataset;
use Filament\Facades\Filament;
use Filament\Forms\Form;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class LookupTablesResource extends Resource
{
    protected static ?string $model = Dataset::class;

    protected static ?string $navigationIcon = 'heroicon-o-document';

    protected static ?string $navigationLabel = "Introduction";
    protected static ?int $navigationSort = 0;

    protected static ?string $cluster = LookupTables::class;

    protected static bool $isScopedToTenant = false;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('lookup_table', true);
    }

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
                Tables\Columns\TextColumn::make('label'),
                Tables\Columns\IconColumn::make('lookup_is_complete')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_required')
                ->boolean()
                    ->getStateUsing(fn ($record) => $record->name === 'Units'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('Review List')
                    ->url(fn ($record) => url('app/' . Filament::getTenant()->id . '/lookup-tables/' . Str::of($record->name)->lower()->slug('-'))),
            ])
            ->bulkActions([
            ]);
    }


    // custom infolist function - this controls the infolist that appears above the table on the List / Index page.
    public static function tableInfoList(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('')
                    ->schema([
                        TextEntry::make('into1')
                            ->hiddenLabel()
                            ->default('This page is designed to help you contextualise key response option lists within the TAPE survey. The table below shows all the response lists that can be customised. You must review the lists marked as "required" before publishing the survey. If you have time, we also recommend you review the other lists to ensure they are appropriate for your context. '),
                        TextEntry::make('intro2')
                            ->hiddenLabel()
                            ->default('For each list, there is a default list that all TAPE surveys include. You cannot edit or remove these items. However, you can add new items to the list, or edit or remove items that you have added.'),
                        TextEntry::make('intro3')
                            ->hiddenLabel()
                            ->default('We recommend that you review the default list for each item and consider whether you need to add or remove items to better reflect the context of your survey. For example, in Ethiopia, Teff is an important crop. While there is an "other cereals" option, this may not be detailed enough for a survey running in Ethiopia, so you may choose to add Teff to the crops list. '),
                    ]),
            ])
            ->state([]);

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
            'index' => Pages\ListLookupTables::route('/'),
        ];
    }
}
