<?php

namespace App\Filament\Exports;

use App\Models\Semester;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class SemesterExporter extends Exporter
{
    protected static ?string $model = Semester::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('qism_id'),
            ExportColumn::make('semester'),
            ExportColumn::make('abbr_semester'),
            ExportColumn::make('sem_s'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
            ExportColumn::make('sem_id'),
            ExportColumn::make('sem_sel'),
            ExportColumn::make('is_active'),
            ExportColumn::make('created_by'),
            ExportColumn::make('updated_by'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your semester export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
