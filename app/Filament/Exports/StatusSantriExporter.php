<?php

namespace App\Filament\Exports;

use App\Models\StatusSantri;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class StatusSantriExporter extends Exporter
{
    protected static ?string $model = StatusSantri::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('santri_id'),
            ExportColumn::make('status'),
            ExportColumn::make('ket_status'),
            ExportColumn::make('keterangan_status_santri_id'),
            ExportColumn::make('naikqism'),
            ExportColumn::make('tanggalupdate'),
            ExportColumn::make('is_active'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
            ExportColumn::make('created_by'),
            ExportColumn::make('updated_by'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your status santri export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
