<?php

namespace App\Filament\App\Resources\LocationLevelResource\RelationManagers;

use App\Filament\Tables\Actions\ExcelTableImportAction;
use App\Imports\LocationImport;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

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
                ExcelTableImportAction::make()
                    ->form(fn (ExcelTableImportAction $action) => [
                        Forms\Components\FileUpload::make('upload')
                            ->label(fn ($livewire) => str($livewire->getTable()->getPLuralModelLabel())->title().' '.'Excel Data')
                            ->default(1)
                            ->disk($action->getDisk())
                            ->columns()
                            ->required()
                            ->live()
                            ->afterStateUpdated(function (?TemporaryUploadedFile $state, Forms\Set $set) {
                                $headings = (new HeadingRowImport)->toArray($state->getRealPath());

                                // $headings is an array(sheets) of arrays(headers)
                                // We only want the first sheet
                                $headings = $headings[0][0];

                                $set('header_columns', $headings ?? []);
                            }),

                        Forms\Components\Section::make('Column Mapping')
                            ->columns(2)
                            ->schema(function ($livewire) {
                                $currentLevel = $livewire->getOwnerRecord();
                                $parents = collect([]);

                                while ($currentLevel->parent) {
                                    $parents->push($currentLevel->parent);
                                    $currentLevel = $currentLevel->parent;
                                }

                                $parentQuestions = $parents->reverse()->map(function ($parent) {
                                    return collect([
                                        Forms\Components\Select::make("parent_{$parent->id}_code_column")
                                            ->label(fn ($livewire) => "Which column contains the {$parent->name} unique code?")
                                            ->options(fn (Forms\Get $get) => $get('header_columns'))
                                            ->notIn(['na'])
                                            ->required(),
                                        Forms\Components\Select::make("parent_{$parent->id}_name_column")
                                            ->label(fn ($livewire) => "Which column contains the {$parent->name} name?")
                                            ->options(fn (Forms\Get $get) => $get('header_columns'))
                                            ->notIn(['na'])
                                            ->required(),
                                    ]);
                                })->flatten();

                                $currentLevelQuestions = collect([
                                    Forms\Components\Select::make('code_column')
                                        ->label(fn ($livewire) => "Which column contains the {$livewire->getOwnerRecord()->name} unique code?")
                                        ->options(fn (Forms\Get $get) => $get('header_columns'))
                                        ->notIn(['na'])
                                        ->required(),
                                    Forms\Components\Select::make('name_column')
                                        ->label(fn ($livewire) => "Which column contains the {$livewire->getOwnerRecord()->name} name?")
                                        ->options(fn (Forms\Get $get) => $get('header_columns'))
                                        ->notIn(['na'])
                                        ->required(),
                                ]);

                                return $parentQuestions->merge($currentLevelQuestions)->toArray();
                            }),

                        Forms\Components\Hidden::make('header_columns')
                            ->default(['na' => '~~upload a file to see the headers~~'])
                            ->live(),
                        Forms\Components\Hidden::make('level')
                            ->default(fn ($livewire) => $livewire->getOwnerRecord()),
                        Forms\Components\Hidden::make('user_id')
                            ->default(fn () => auth()->id()),

                    ])
                    ->use(LocationImport::class),
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
