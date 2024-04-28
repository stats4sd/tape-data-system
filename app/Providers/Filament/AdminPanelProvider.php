<?php

namespace App\Providers\Filament;

use App\Filament\Admin\Resources\CaetScaleResource;
use App\Filament\Admin\Resources\DatasetResource;
use App\Http\Middleware\CheckIfAdmin;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationBuilder;
use Filament\Navigation\NavigationItem;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use App\Filament\Admin\Resources\TeamResource;
use Stats4sd\FilamentOdkLink\Filament\Resources\XlsformTemplateResource;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('admin')
            ->path('admin')
            ->viteTheme('resources/css/filament/app/theme.css')
            ->darkMode(false)
            ->colors([
                'primary' => Color::Amber,
                'grey' => Color::Gray,
            ])
            ->discoverResources(in: app_path('Filament/Admin/Resources'), for: 'App\\Filament\\Admin\\Resources')
            ->resources([
                // Bring in ODK Link Resources
                TeamResource::class,
                XlsformTemplateResource::class,
            ])
            ->discoverPages(in: app_path('Filament/Admin/Pages'), for: 'App\\Filament\\Admin\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Admin/Widgets'), for: 'App\\Filament\\Admin\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
                CheckIfAdmin::class,
            ])
            ->navigation(function (NavigationBuilder $builder): NavigationBuilder {
                return $builder->items([
                    NavigationItem::make('Return to Front-end')
                        ->url(url('/app'))
                        ->icon('heroicon-o-arrow-left'),
                    ... XlsformTemplateResource::getNavigationItems(),
                    ... TeamResource::getNavigationItems(),
                    ... DatasetResource::getNavigationItems(),
                    ... CaetScaleResource::getNavigationItems(),
                ]);
            });
    }
}
