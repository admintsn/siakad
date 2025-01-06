<?php

namespace App\Filament\Exports;

use App\Models\Mahad;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class MahadExporter extends Exporter
{
    protected static ?string $model = Mahad::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('mahad'),
            ExportColumn::make('nsp'),
            ExportColumn::make('provinsi_id'),
            ExportColumn::make('kabupaten_id'),
            ExportColumn::make('kecamatan_id'),
            ExportColumn::make('kelurahan_id'),
            ExportColumn::make('rt'),
            ExportColumn::make('rw'),
            ExportColumn::make('alamat'),
            ExportColumn::make('kodepos'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
            ExportColumn::make('is_active'),
            ExportColumn::make('created_by'),
            ExportColumn::make('updated_by'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your mahad export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
