<?php

namespace App\Filament\App\Pages\AccountSettingsComponents;

use App\Services\OdkCentralUser;
use Filament\Facades\Filament;

class UpdatePassword extends \Jeffgreco13\FilamentBreezy\Livewire\UpdatePassword
{
    protected string $view = 'components.account-settings-components.update-password';

    public function submit(): void
    {
        $data = collect($this->form->getState())->all();

        $this->user->update([
            'password' => Hash::make($data['new_password']),
        ]);


        // Update ODK Central
        (new OdkCentralUser)->update($user->email, $data['current_password'], $data['new_password']);

        session()->forget('password_hash_' . Filament::getCurrentPanel()->getAuthGuard());
        Filament::auth()->login($this->user);
        $this->reset(['data']);
        Notification::make()
            ->success()
            ->title(__('filament-breezy::default.profile.password.notify'))
            ->send();
    }
}
