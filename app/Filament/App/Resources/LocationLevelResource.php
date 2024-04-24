<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\LocationLevelResource\Pages;
use App\Filament\App\Resources\LocationLevelResource\RelationManagers\LocationsRelationManager;
use App\Filament\Traits\IsLookupListResource;
use App\Models\SampleFrame\LocationLevel;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Navigation\NavigationItem;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Str;

class LocationLevelResource extends Resource
{
    use IsLookupListResource;

    protected static ?string $model = LocationLevel::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationIcon(): string|Htmlable|null
    {
        return null;
    }
    public static function getNavigationItems(): array
    {
        // make sure the original nav item is only 'active' when the index page is active.
        $original = collect(parent::getNavigationItems())
            ->map(function ($item) {
                return $item->isActiveWhen(fn () => request()->routeIs(static::getRouteBaseName() . '.index'));
            })->toArray();

        $baseRoute = static::getUrl('index');

        $navItems = LocationLevel::all()
            ->map(function ($level) use ($baseRoute) {
                return NavigationItem::make(Str::plural($level->name))
                    ->url($baseRoute . '/' . $level->slug)
                    ->group('Survey Sample Frame')
                    ->isActiveWhen(fn () => request()->routeIs(static::getRouteBaseName() . '.view') && request()->route('record') === $level->slug);
            });

        return array_merge($original, $navItems->toArray());
    }

    public static function getNavigationBadge(): ?string
    {
        return null;
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return null;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('parent_id')
                    ->label('Is this location level a sub-level of another level?')
                    ->helperText('E.g. "Village" may be a sub-level of "District", and "District" may be a sub-level of "Province". Select None if this is the top level in your sample frame.')
                    ->placeholder('None')
                    ->relationship('parent', 'name'),
                TextInput::make('name')
                    ->maxLength(255),
                Toggle::make('has_farms')
                    ->label('Are there farms at this level?')
                    ->helperText('Only say yes if there are farms directly at this location level, not in a lower location level. E.g. "Village" may have farms, but "District" may not.'),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('parent.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('locations_count')
                    ->counts('locations')
                    ->label('No. of Entries')
                    ->sortable(),
                Tables\Columns\IconColumn::make('has_farms')
                    ->boolean()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            \Filament\Infolists\Components\Section::make('Key Details')
                ->schema([
                    TextEntry::make('name')->label('Level'),
                    TextEntry::make('parent.name')->label('Parent Level'),
                ]),
        ])
            ->columns(2);
    }

    public static function getRelations(): array
    {
        return [
            LocationsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLocationLevels::route('/'),
            'view' => Pages\ViewLocationLevel::route('/{record}'),
        ];
    }
}
