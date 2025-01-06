<?php

namespace App\Filament\Exports;

use App\Models\User;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class UserExporter extends Exporter
{
    protected static ?string $model = User::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('name'),
            ExportColumn::make('username'),
            ExportColumn::make('email'),
            ExportColumn::make('email_verified_at'),
            ExportColumn::make('is_active'),
            ExportColumn::make('two_factor_secret'),
            ExportColumn::make('two_factor_recovery_codes'),
            ExportColumn::make('two_factor_confirmed_at'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
            ExportColumn::make('panelrole'),
            ExportColumn::make('role'),
            ExportColumn::make('channel'),
            ExportColumn::make('mudirqism'),
            ExportColumn::make('tsnunique'),
            ExportColumn::make('is_request'),
            ExportColumn::make('panelrole_id'),
            ExportColumn::make('created_by'),
            ExportColumn::make('updated_by'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your user export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
