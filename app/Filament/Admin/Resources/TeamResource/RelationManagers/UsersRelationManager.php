<?php

namespace App\Filament\Admin\Resources\TeamResource\RelationManagers;

use App\Models\Team;
use App\Models\User;
use Awcodes\Shout\Components\Shout;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;

class UsersRelationManager extends RelationManager
{
    protected static string $relationship = 'users';

    public function isReadOnly(): bool
    {
        return false;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Shout::make('info')
                    ->content(fn (User $record) => new HtmlString("Edit user's role within this team<br/>$record->name ($record->email)")),
                Forms\Components\Checkbox::make('is_admin')
                    ->label(fn (User $record): string => "$record->name is a Team Admin")
                    ->helperText('Team Admins have full access to all team settings and can manage all team members. They can edit or delete data. Non-admins can only collect data and view data.'),
            ])->columns(1);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\IconColumn::make('is_admin')
                    ->label('Is a Team Admin?')
                    ->boolean(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\Action::make('invite users')
                    ->form([
                        Shout::make('info')
                            ->type('info')
                            ->content('Add the email address(es) of the user(s) you would like to invite to this team. An invitation will be sent to each address.')->columnSpanFull(),
                        Forms\Components\Repeater::make('users')
                            ->label('Email Addresses to Invite')
                            ->simple(
                                Forms\Components\TextInput::make('email')
                                    ->email()
                                    ->required()
                            )
                            ->reorderable(false)
                            ->addActionLabel('Add Another Email Address')
                    ])
                    ->action(fn (array $data, RelationManager $livewire) => $this->handleInvitation($data, $livewire->getOwnerRecord())),
                Tables\Actions\AttachAction::make()
                    ->label('Add Existing User to team'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Edit User Role'),
                Tables\Actions\DetachAction::make()->label('Remove User')
                    ->modalSubmitActionLabel('Remove User')
                    ->modalHeading('Remove User from Team'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public function handleInvitation(array $data, Team $team): void
    {
        $team->sendInvites($data['users']);
    }
}
