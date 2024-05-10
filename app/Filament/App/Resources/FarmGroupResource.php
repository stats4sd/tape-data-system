<?php

namespace App\Filament\App\Resources;

use Filament\Forms;
use Grouping\Group;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Services\HelperService;
use Filament\Resources\Resource;
use App\Models\SampleFrame\FarmGroup;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\App\Resources\FarmGroupResource\Pages;
use App\Filament\App\Resources\FarmGroupResource\RelationManagers;

class FarmGroupResource extends Resource
{
    protected static ?string $model = FarmGroup::class;
    protected static ?string $navigationIcon = null;

    protected static ?string $tenantOwnershipRelationshipName = 'owner';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('farm_grouping_id')
                                    ->relationship(name: 'farmGrouping', titleAttribute: 'name')
                                    ->required()
                                    ->label('Select the grouping this group belongs to')
                                    ->helperText('E.g. grouping \'Farm size\' has groups \'Big\' and \'Small\', grouping \'Beneficiary\' has groups \'Beneficiary\' and \'Non beneficiary\'')
                                    ->placeholder('Select a grouping')
                                    ->loadingMessage('Loading groupings...')
                                    ->createOptionForm([
                                        Forms\Components\TextInput::make('name')
                                            ->label('Grouping name')
                                            ->required(),
                                        Forms\Components\Hidden::make('owner_type')
                                            ->default('App\Models\Team'),
                                        Forms\Components\Hidden::make('owner_id')
                                            ->default(HelperService::getSelectedTeam()->id),
                                    ]),
                Forms\Components\TextInput::make('name')
                                    ->label('Group name')
                                    ->required(),
                Forms\Components\TextInput::make('code')
                                    ->label('Enter the code that will be used to identify this group')
                                    ->required(),
                Forms\Components\TextArea::make('description')
                                    ->label('Optional: Add a short description for the group')
                                    ->maxLength(255),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultGroup('farmGrouping.name')
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('code'),
                Tables\Columns\TextColumn::make('description')->wrap(),
                Tables\Columns\TextColumn::make('farms_count')
                                    ->counts('farms')
                                    ->label('# of Farms')
                                    ->sortable(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFarmGroups::route('/'),
            'create' => Pages\CreateFarmGroup::route('/create'),
            'edit' => Pages\EditFarmGroup::route('/{record}/edit'),
        ];
    }
}
