<?php

namespace App\Filament\App\Resources;

use Filament\Forms;
use App\Models\Site;
use Filament\Tables;
use App\Models\AgSystem;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Facades\Filament;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Filament\Support\Enums\VerticalAlignment;
use Stats4sd\FilamentOdkLink\Models\OdkLink\DatasetVariable;

class AgSystemResource extends Resource
{
    protected static ?string $model = AgSystem::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static bool $isScopedToTenant = false;

    // custom tenancy scoping (AG Systems are not directly related to teams)

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereHas('site', function (Builder $query) {
                $query->whereHas('team', function (Builder $query) {
                    $query->where('id', Filament::getTenant()->id);
                });
            });
    }

    public static function form(Form $form): Form
    {
        $propertyVariables = static::getModel()::getLinkedDataset()->variables;

        $propertyFields = $propertyVariables->map(function ($variable) {
            return static::getSystemSectionForm($variable);
        });

        return $form
            ->schema([
                Forms\Components\Fieldset::make('Key Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Add a short, descriptive name for the system')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('code')
                            ->label('Enter the code that will be used to identify this Agricultural System')
                            ->required(),
                        Forms\Components\Select::make('site_id')
                            ->label('Geographic Site')
                            ->options(Site::join('locations', 'sites.location_id', '=', 'locations.id')->pluck('locations.name', 'sites.id')->toArray())
                            ->disabled()
                            ->required(),
                    ]),

                ...$propertyFields,
            ]);
    }

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
            \App\Filament\App\Resources\AgSystemResource\RelationManagers\FarmsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\App\Resources\AgSystemResource\Pages\ListAgSystems::route('/'),
            'create' => \App\Filament\App\Resources\AgSystemResource\Pages\CreateAgSystem::route('/create'),
            'edit' => \App\Filament\App\Resources\AgSystemResource\Pages\EditAgSystem::route('/{record}/edit'),
            'view' => \App\Filament\App\Resources\AgSystemResource\Pages\ViewAgSystem::route('/{record}')
        ];
    }

    public static function getSystemSectionForm(DatasetVariable $variable): Forms\Components\Section
    {
        $name = $variable->name;
        $description = $variable->description;

        return Forms\Components\Section::make(Str::of($name)->title()->replace('_', ' '))
            ->schema([
                Forms\Components\Textarea::make('properties.'.$name)
                    ->label($description)
                    ->rows(5)
                    ->maxLength(65535)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, AgSystem $record) => $record->updateProperties([$name => $state]))
                    ->columnSpanFull(),
                Forms\Components\SpatieMediaLibraryFileUpload::make("{$name}_files")
                    ->label('Please add any files to support the explanation above')
                    ->collection($name),
                Forms\Components\Actions::make([
                    Forms\Components\Actions\Action::make($name.'_mark_as_complete')
                        ->label(fn (AgSystem $record) => $record->propertyIsCompleted($name) ? 'Mark section as incomplete' : 'Mark section as complete')
                        ->color(fn (AgSystem $record) => $record->propertyIsCompleted($name) ? 'grey' : 'info')
                        ->disabled(fn (AgSystem $record) => ! $record->properties[$name])
                        ->action(fn (AgSystem $record) => $record->togglePropertyCompleted($name)),
                ])->verticalAlignment(VerticalAlignment::Center)
                    ->alignCenter(),
            ])->columns(2)
            ->icon(fn (AgSystem $record) => $record->propertyIsCompleted($name) ? 'heroicon-o-check-circle' : 'heroicon-o-exclamation-circle')
            ->iconColor(fn ($record) => $record->propertyIsCompleted($name) ? 'success' : 'warning')
            ->headerActions([
            ])
            ->collapsible()
            ->hiddenOn('view');
    }
}
