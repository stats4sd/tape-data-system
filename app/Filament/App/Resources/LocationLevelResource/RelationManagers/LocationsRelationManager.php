<?php

namespace App\Filament\App\Resources\LocationLevelResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class LocationsRelationManager extends RelationManager
{
    protected static string $relationship = 'locations';

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return Str::of($ownerRecord->name)->title().' List';
    }

    public function isReadOnly(): bool
    {
        return true;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->hintIcon('heroicon-o-information-circle')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        $columns = [];
        $filters = [];

        if ($this->getOwnerRecord()->parent) {
            $columns[] = Tables\Columns\TextColumn::make('parent.name')->label(fn () => $this->getOwnerRecord()->parent->name)->sortable();
            $filters[] = Tables\Filters\SelectFilter::make('parent')
                ->relationship('parent', 'name', fn (Builder $query) => $query->where('location_level_id', $this->getOwnerRecord()->parent->id));
        }

        $columns[] = Tables\Columns\TextColumn::make('name')->label($this->getOwnerRecord()->name);
        $columns[] = Tables\Columns\TextColumn::make('code');

        $columns[] = Tables\Columns\TextColumn::make('farms_all_count')
            ->label('# of Farms');

        return $table
            ->recordTitleAttribute('name')
            ->columns($columns)
            ->filters($filters)
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
