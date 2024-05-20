<?php

namespace App\Filament\App\Pages;

use App\Filament\App\Pages\AccountSettingsComponents\RoleAndTeam;
use App\Filament\App\Pages\AccountSettingsComponents\UpdatePassword;
use Jeffgreco13\FilamentBreezy\Pages\MyProfilePage;

class AccountSettingsPage extends MyProfilePage
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public function getRegisteredMyProfileComponents(): array
    {
        $standardComponents = parent::getRegisteredMyProfileComponents();

        $profileUpdateComponent = UpdatePassword::class;

        return array_merge(
            ['role_and_team' => RoleAndTeam::class],
            $standardComponents,
            ['update_password' => $profileUpdateComponent],
        );
    }
}
