<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\XlsformResource\Pages;
use App\Filament\App\Resources\XlsformResource\RelationManagers;
use App\Models\Xlsform;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class XlsformResource extends Resource
{
    protected static ?string $model = Xlsform::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $tenantOwnershipRelationshipName = 'owner';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            RelationManagers\SubmissionEditingRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListXlsforms::route('/'),
            'view' => Pages\ViewXlsform::route('/{record}'),
        ];
    }
}
