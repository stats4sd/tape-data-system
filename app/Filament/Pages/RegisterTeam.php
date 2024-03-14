<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Pages\Tenancy\RegisterTenant;
use Stats4sd\FilamentOdkLink\Models\TeamManagement\Team;

class RegisterTeam extends RegisterTenant
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function getLabel(): string
    {
        return 'Register New Team';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                ->label('Enter a name for the team'),
            ]);
    }

    protected function handleRegistration(array $data): Team
    {
        $team = Team::create($data);

        $team->members()->attach(auth()->user());

        return $team;
    }
}
