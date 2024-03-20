<?php

namespace App\Providers\Filament;

use App\Filament\App\Pages\RegisterTeam;
use App\Filament\App\Pages\TeamDashboard;
use App\Filament\App\Resources\SiteResource;
use App\Models\Team;
use BetterFuturesStudio\FilamentLocalLogins\LocalLogins;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationBuilder;
use Filament\Navigation\NavigationItem;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Jeffgreco13\FilamentBreezy\BreezyCore;

class AppPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('app')
            ->path('app')
            ->viteTheme('resources/css/filament/app/theme.css')
            ->tenant(Team::class)
            ->tenantRegistration(RegisterTeam::class)
            ->login()
            ->passwordReset()
            ->profile() // TODO: Implement more full-featured profile page
            ->darkMode(false)
            ->colors([
                'primary' => Color::Blue,
                'grey' => Color::Gray,
            ])
            ->discoverResources(in: app_path('Filament/App/Resources'), for: 'App\\Filament\\App\\Resources')
            ->discoverPages(in: app_path('Filament/App/Pages'), for: 'App\\Filament\\App\\Pages')
            ->pages([
            ])
            ->discoverWidgets(in: app_path('Filament/App/Widgets/'), for: 'App\\Filament\\App\\Widgets')
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
            ])
            ->plugins([
                // new LocalLogins(), hide until it works in Laravel 11
                BreezyCore::make()
                ->myProfile(
                    shouldRegisterNavigation: true,
                    hasAvatars: true,
                )
            ])
            ->navigation(function(NavigationBuilder $builder): NavigationBuilder {
                return $builder->items([

                    // Top pages and dashboard
                    ...TeamDashboard::getNavigationItems(),
                    NavigationItem::make('Admin Panel')
                        ->url('/admin')
                        ->icon('heroicon-o-adjustments-horizontal')
                        ->visible(fn() => auth()->user()?->can('access admin panel')),
                    ... SiteResource::getNavigationItems(),
                ]);
            });
    }
}
