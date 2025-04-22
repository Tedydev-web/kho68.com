<?php

    namespace App\Providers\Filament;

    use App\Filament\Resources\DashboardResource\Widgets\OrderCountChart;
    use App\Filament\Resources\DashboardResource\Widgets\OrderStats;
    use App\Filament\Resources\DashboardResource\Widgets\ProductStats;
    use App\Filament\Resources\DashboardResource\Widgets\RecentDeposits;
    use App\Filament\Resources\DashboardResource\Widgets\RecentOrders;
    use App\Filament\Resources\DashboardResource\Widgets\SalesChart;
    use App\Http\Middleware\AdminRoleMiddleware;
    use Filament\Http\Middleware\Authenticate;
    use Filament\Http\Middleware\DisableBladeIconComponents;
    use Filament\Http\Middleware\DispatchServingFilamentEvent;
    use Filament\Pages;
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
    use Njxqlus\FilamentProgressbar\FilamentProgressbarPlugin;

    class AdminPanelProvider extends PanelProvider
    {

        public function panel(Panel $panel): Panel
        {
            return $panel
                ->default()
                ->id('admin')
                ->path('k68-admin')
                ->login()
                ->colors([
                    'primary' => Color::Amber,
                ])
                ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
                ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
                ->pages([
                    Pages\Dashboard::class,
                ])
                ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
                ->widgets([
                    ProductStats::class,
                    OrderStats::class,
                    OrderCountChart::class,
                    SalesChart::class,
                    RecentOrders::class,
                    RecentDeposits::class,

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
                ->sidebarCollapsibleOnDesktop()
                ->authMiddleware([
                    Authenticate::class,
                    AdminRoleMiddleware::class, // Add middleware kiểm tra role admin
                ])
                ->plugins(plugins: [
                    \BezhanSalleh\FilamentShield\FilamentShieldPlugin::make(),
                    \Awcodes\Curator\CuratorPlugin::make()
                        ->label('Media')
                        ->pluralLabel('Media')
                        ->navigationIcon('heroicon-o-photo')
                        ->navigationGroup('Content')
                        ->navigationSort(3)
                        ->navigationCountBadge()
                        ->registerNavigation(true)
                        ->defaultListView('grid' || 'list'),
//                    \TomatoPHP\FilamentSettingsHub\FilamentSettingsHubPlugin::make()
//                        ->allowLocationSettings()
//                        ->allowSiteSettings()
//                        ->allowSocialMenuSettings(),
                    FilamentProgressbarPlugin::make()->color('#9c0404'),
//                    \TomatoPHP\FilamentDeveloperGate\FilamentDeveloperGatePlugin::make(),
//                    \TomatoPHP\FilamentArtisan\FilamentArtisanPlugin::make()
                ])->viteTheme('resources/css/filament/admin/theme.css');

        }
        protected function getResources(): array
{
    return [
        \App\Filament\Resources\BannerResource::class, // Đảm bảo resource đã được khai báo ở đây
    ];
}

    }
