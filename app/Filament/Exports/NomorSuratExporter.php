<?php

namespace App\Filament\Exports;

use App\Models\NomorSurat;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class NomorSuratExporter extends Exporter
{
    protected static ?string $model = NomorSurat::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('tanggal_surat'),
            ExportColumn::make('nomor'),
            ExportColumn::make('lembaga_surat_id'),
            ExportColumn::make('qism_id'),
            ExportColumn::make('santri_id'),
            ExportColumn::make('tujuan_surat_id'),
            ExportColumn::make('jenis_surat_id'),
            ExportColumn::make('tahunhberjalan_id'),
            ExportColumn::make('tahunmberjalan_id'),
            ExportColumn::make('nomor_surat'),
            ExportColumn::make('perihal_surat'),
            ExportColumn::make('file_raw'),
            ExportColumn::make('file_signed'),
            ExportColumn::make('is_confirned'),
            ExportColumn::make('is_printed'),
            ExportColumn::make('is_signed'),
            ExportColumn::make('is_scanned'),
            ExportColumn::make('is_sent'),
            ExportColumn::make('is_needrevise'),
            ExportColumn::make('is_revised'),
            ExportColumn::make('is_active'),
            ExportColumn::make('created_by'),
            ExportColumn::make('updated_by'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your nomor surat export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
