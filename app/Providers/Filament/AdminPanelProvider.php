<?php

namespace App\Providers\Filament;

use CmsMulti\FilamentClearCache\FilamentClearCachePlugin;
use Filament\Enums\ThemeMode;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Notifications\Livewire\Notifications;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\Alignment;
use Filament\Support\Enums\VerticalAlignment;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use pxlrbt\FilamentSpotlight\SpotlightPlugin;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            // ->login()
            ->colors([
                'danger' => "#9e5d4b",
                'gray' => Color::Gray,
                'info' => Color::Blue,
                'primary' => "#d3c281",
                'success' => "#274043",
                'warning' => Color::Orange,
            ])
            ->font('SF Pro')
            ->brandLogo(asset('SiakadTSN V1 Logo.png'))
            ->brandLogoHeight('5rem')
            ->favicon(asset('favicon-32x32.png'))
            ->discoverResources(in: app_path('Filament/Admin/Resources'), for: 'App\\Filament\\Admin\\Resources')
            ->discoverPages(in: app_path('Filament/Admin/Pages'), for: 'App\\Filament\\Admin\\Pages')
            ->discoverClusters(in: app_path('Filament/Admin/Clusters'), for: 'App\\Filament\\Admin\\Clusters')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Admin/Widgets'), for: 'App\\Filament\\Admin\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
            ])
            ->navigationGroups([

                NavigationGroup::make()
                    ->label('PSB')
                    ->icon('heroicon-o-user-plus')
                    ->collapsed(),

                NavigationGroup::make()
                    ->label('Data Santri')
                    ->icon('heroicon-o-user-group')
                    ->collapsed(),

                NavigationGroup::make()
                    ->label('Imtihan')
                    ->icon('heroicon-o-academic-cap')
                    ->collapsed(),

                NavigationGroup::make()
                    ->label('Report')
                    ->icon('heroicon-o-document-text')
                    ->collapsed(),

                NavigationGroup::make()
                    ->label('Nomor Surat')
                    ->icon('heroicon-o-envelope')
                    ->collapsed(),

                NavigationGroup::make()
                    ->label('Lembaga')
                    ->icon('heroicon-o-building-library')
                    ->collapsed(),

                NavigationGroup::make()
                    ->label('Config')
                    ->icon('heroicon-o-adjustments-horizontal')
                    ->collapsed(),

                NavigationGroup::make()
                    ->label('Configs')
                    // ->icon('heroicon-o-adjustments-horizontal')
                    ->collapsed(),

                NavigationGroup::make()
                    ->label('Users')
                    ->icon('heroicon-o-user-circle')
                    ->collapsed(),

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
            ])
            ->bootUsing(function () {
                Notifications::alignment(Alignment::Right);
                Notifications::verticalAlignment(VerticalAlignment::End);
            })
            ->unsavedChangesAlerts()
            ->defaultThemeMode(ThemeMode::Light)
            ->topNavigation()
            ->maxContentWidth('full')
            ->databaseNotifications()
            ->databaseNotificationsPolling('5s')
            ->plugins([
                SpotlightPlugin::make(),
                // FilamentClearCachePlugin::make(),
            ])
            ->viteTheme('resources/css/filament/admin/theme.css');
        // ->registerRenderHook(
        //     // This line tells us where to render it
        //     PanelsRenderHook::FOOTER,
        //     // This is the view that will be rendered
        //     fn (): View => view('panel-footer'),
        // )
        // ->renderHook(
        //     'panels::body.end',
        //     fn (): string => Blade::render('@livewire(\'panel-footer\')'),
        // );
    }
}
