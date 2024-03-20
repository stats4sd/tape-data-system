<?php

namespace App\Filament\App\Pages\AccountSettingsComponents;

use Filament\Facades\Filament;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Concerns\InteractsWithInfolists;
use Filament\Infolists\Contracts\HasInfolists;
use Filament\Infolists\Infolist;
use Illuminate\Contracts\Auth\Authenticatable;
use Jeffgreco13\FilamentBreezy\Livewire\MyProfileComponent;

class RoleAndTeam extends MyProfileComponent implements HasInfolists
{
    use InteractsWithInfolists;

    protected string $view = 'components.account-settings-components.role-and-team';

    public ?array $data = [];

    public ?Authenticatable $user;

    public static $sort = 30;

    public function mount(): void
    {
        $this->user = Filament::getCurrentPanel()?->auth()->user();

    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->record($this->user)
            ->schema([
                TextEntry::make('roles.name')
                    ->label('Site-wide User Role(s)')
                    ->inlineLabel(),
                TextEntry::make('teams.name')
                    ->label('Member of Teams:')
                    ->inlineLabel(),
            ]);
    }
}
