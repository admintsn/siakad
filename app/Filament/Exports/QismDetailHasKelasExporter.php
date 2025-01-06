<?php

namespace App\Filament\Exports;

use App\Models\QismDetailHasKelas;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class QismDetailHasKelasExporter extends Exporter
{
    protected static ?string $model = QismDetailHasKelas::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('qism_id'),
            ExportColumn::make('qism_detail_id'),
            ExportColumn::make('kelas_id'),
            ExportColumn::make('kelas'),
            ExportColumn::make('qism_s'),
            ExportColumn::make('qism_detail_s'),
            ExportColumn::make('kelas_s'),
            ExportColumn::make('terakhir'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
            ExportColumn::make('is_active'),
            ExportColumn::make('created_by'),
            ExportColumn::make('updated_by'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your qism detail has kelas export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
