<?php

namespace App\Filament\Traits;

use App\Models\Interfaces\LookupListEntry;
use App\Models\Team;
use App\Services\HelperService;
use Filament\Facades\Filament;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Tables\Actions\Action;
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

        $extraFields = static::getExtraFormFields();

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
                    ->readOnly(fn (LookupListEntry $record) => $record->isGlobal())
                    ->helperText('If you are familiar with ODK Form development, this corresponds to the "name" attribute of the <item> element in the XForm.'),
                TextInput::make('label')
                    ->required()
                    ->label('Enter a label. This is what enumerators will see in the survey.')
                    ->readOnly(fn (LookupListEntry $record) => $record->isGlobal())
                    ->helperText('At present, this platform only supports additional choice options in English. Multiple language support will come soon!'),
                ...$extraFields,
            ]);
    }

    // overwrite this in the main Resource if you want to enable editing of global entries
    public static function canEditGlobalItems(): bool
    {
        return false;
    }

    // standard table
    public static function table(Table $table): Table
    {
        $actions = [
            EditAction::make()->visible(fn (LookupListEntry $record): bool => !$record->isGlobal() || static::canEditGlobalItems()),
            DeleteAction::make()->visible(fn (LookupListEntry $record): bool => !$record->isGlobal()),
        ];

        if (static::getModel()::canBeHiddenFromContext()) {
            $actions[] = Action::make('Toggle Removed')
                ->visible(fn (LookupListEntry $record): bool => $record->isGlobal())
                ->label(fn (LookupListEntry $record): string => $record->isRemoved(HelperService::getSelectedTeam()) ? 'Restore to Context' : 'Remove from Context')
                ->action(fn (LookupListEntry $record) => $record->toggleRemoved(HelperService::getSelectedTeam()));
        }

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
            ->actions($actions)
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

    // override this in the model if you need to add extra fields to the form
    private static function getExtraFormFields(): array
    {
        return [];
    }

}
