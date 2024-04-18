<?php

namespace App\Filament\Traits;

use App\Models\Interfaces\LookupListEntry;
use App\Models\Team;
use App\Services\HelperService;
use Filament\Facades\Filament;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

trait IsLookupListResource
{
    // do not use tenancy by default, but instead filter by tenancy + add in items with team_id === null;

    public static function isScopedToTenant(): bool
    {
        return false;
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where(function (Builder $query) {
                $query->where('owner_id', null)
                    ->orWhereHasMorph('owner', Team::class, fn (Builder $query): Builder => $query->whereKey(Filament::getTenant()->id));
            });
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->unique()
                    ->label('Enter a unique code.')
                    ->validationMessages([
                        'required' => 'Please enter a unique code',
                        'unique' => 'This code is already in use. Please enter a unique code.',
                    ])
                    ->helperText('If you are familiar with ODK Form development, this corresponds to the "name" attribute of the <item> element in the XForm.'),
                TextInput::make('label')
                    ->required()
                    ->label('Enter a label. This is what enumerators will see in the survey.')
                    ->helperText('At present, this platform only supports additional choice options in English. Multiple language support will come soon!'),
            ]);
    }

    // standard table
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Unique Code')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('label')
                    ->sortable()
                    ->searchable(),
                IconColumn::make('is_customised_entry')
                    ->label('Is custom entry?')
                    ->boolean(),
            ])
            ->filters([
                TernaryFilter::make('custom')
                    ->label('Show custom entries?')
                    ->queries(
                        true: fn (Builder $query): Builder => $query->whereHasMorph('owner', Team::class),
                        false: fn (Builder $query): Builder => $query->where('owner_id', null),
                    )
            ])
            ->actions([
                EditAction::make()->hidden(fn (LookupListEntry $record): bool => $record->isGlobal()),
                DeleteAction::make()->hidden(fn (LookupListEntry $record): bool => $record->isGLobal()),
            ])
            ->defaultPaginationPageOption('all')
            ->defaultSort('label', 'asc');
    }

    public static function getNavigationBadge(): ?string
    {
        $team = HelperService::getSelectedTeam();
        if ($team?->hasCompletedLookupList(self::getModel()::getLinkedDataset())) {
            return 'Complete';
        }

        return 'In Progress';

    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        $team = HelperService::getSelectedTeam();

        if ($team?->hasCompletedLookupList(self::getModel()::getLinkedDataset())) {
            return 'success';
        }

        return 'info';
    }

}
