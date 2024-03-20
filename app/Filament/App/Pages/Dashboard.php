<?php

namespace App\Filament\App\Pages;

use Filament\Widgets\AccountWidget;
use Illuminate\Contracts\Support\Htmlable;

class Dashboard extends \Filament\Pages\Dashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static string $view = 'filament.pages.dashboard';

    public function getHeading(): string|Htmlable
    {
        return 'TAPE Data System - Dashboard';
    }

    protected function getHeaderWidgets(): array
    {
        return [
            AccountWidget::class,
        ];
    }
}
