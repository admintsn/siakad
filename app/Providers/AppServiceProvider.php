<?php

namespace App\Providers;

use App\Filament\MyLogoutResponse;
use Illuminate\Support\ServiceProvider;
use App\Http\Responses\LogoutResponse;
use Filament\Http\Responses\Auth\Contracts\LogoutResponse as LogoutResponseContract;
use Illuminate\Database\Eloquent\Model;
use BezhanSalleh\PanelSwitch\PanelSwitch;
use Carbon\Carbon;
use Filament\Pages\SubNavigationPosition;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\HeaderActionsPosition;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Table;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void {}

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(LogoutResponseContract::class, MyLogoutResponse::class);

        Model::unguard();

        PanelSwitch::configureUsing(function (PanelSwitch $panelSwitch) {
            $panelSwitch
                ->simple()
                ->labels([
                    'admin' => 'Admin',
                    'tsn' => 'TSN',
                    'walisantri' => 'Walisantri'
                ])
                ->visible(fn(): bool => auth()->user()->id == 1);
        });

        date_default_timezone_set('Asia/Jakarta');

        Table::configureUsing(function (Table $table): void {
            $table
                ->headerActions([], position: HeaderActionsPosition::Bottom)
                ->actions([], position: ActionsPosition::BeforeCells)
                ->filters([], layout: FiltersLayout::AboveContentCollapsible)
                ->deferFilters()
                ->filtersTriggerAction(
                    fn(Action $action) => $action
                        ->button()
                        ->label('Filter'),
                )
                ->emptyStateHeading('Belum ada data')
                ->emptyStateDescription('.')
                ->deferLoading()
                ->extremePaginationLinks();
        });

        // config(['app.locale' => 'id']);
        // Carbon::setLocale('id');
    }
}
