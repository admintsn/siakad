<?php

namespace App\Filament\Exports;

use App\Models\KelasSantri;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class KelasSantriExporter extends Exporter
{
    protected static ?string $model = KelasSantri::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('mahad_id'),
            ExportColumn::make('qism_id'),
            ExportColumn::make('tahun_berjalan_id'),
            ExportColumn::make('tahun_ajaran_id'),
            ExportColumn::make('semester_id'),
            ExportColumn::make('kelas_id'),
            ExportColumn::make('qism_detail_id'),
            ExportColumn::make('kelas_internal'),
            ExportColumn::make('kelas_internal_barab'),
            ExportColumn::make('kelas_internal_matematika'),
            ExportColumn::make('halaqoh'),
            ExportColumn::make('santri_id'),
            ExportColumn::make('walisantri_id'),
            ExportColumn::make('kartu_keluarga'),
            ExportColumn::make('tanggalupdate'),
            ExportColumn::make('is_mustamiah'),
            ExportColumn::make('is_active'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
            ExportColumn::make('created_by'),
            ExportColumn::make('updated_by'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your kelas santri export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
