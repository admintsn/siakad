<?php

namespace App\Filament\Exports;

use App\Models\TahunAjaranAktif;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class TahunAjaranAktifExporter extends Exporter
{
    protected static ?string $model = TahunAjaranAktif::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('qism_id'),
            ExportColumn::make('tahun_ajaran_id'),
            ExportColumn::make('semester_id'),
            ExportColumn::make('is_active'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
            ExportColumn::make('created_by'),
            ExportColumn::make('updated_by'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your tahun ajaran aktif export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
