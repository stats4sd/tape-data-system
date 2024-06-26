<?php

namespace App\Filament\App\Resources;

use Filament\Forms;
use Grouping\Group;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Forms\Components\Hidden;
use Forms\Components\Select;
use Forms\Components\TextArea;
use Tables\Columns\TextColumn;
use App\Services\HelperService;
use Forms\Components\TextInput;
use Filament\Resources\Resource;
use App\Models\SampleFrame\FarmGroup;
use App\Models\SampleFrame\FarmGrouping;
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
        $team_id = HelperService::getSelectedTeam()->id;

        return $form
            ->schema([
                Forms\Components\Select::make('farm_grouping_id')
                                    ->options(FarmGrouping::where('owner_id', $team_id)->pluck('name', 'id'))
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
                                            ->default($team_id),
                                    ])
                                    ->createOptionUsing(function (array $data){
                                        $record = FarmGrouping::create([
                                            'name' => $data['name'],
                                            'owner_type' => $data['owner_type'],
                                            'owner_id' => $data['owner_id'],
                                        ]);
                                        return [$record->id, $record->name];
                                    }),
                Forms\Components\TextInput::make('name')
                                    ->label('Group name')
                                    ->required(),
                Forms\Components\TextInput::make('code')
                                    ->label('Enter the code that will be used to identify this group')
                                    ->required(),
                Forms\Components\Textarea::make('description')
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
