<?php

namespace App\Filament\Imports;

use App\Models\QismDetailHasKelas;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class QismDetailHasKelasImporter extends Importer
{
    protected static ?string $model = QismDetailHasKelas::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('qism_id')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
            ImportColumn::make('qism_detail_id')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
            ImportColumn::make('kelas_id')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
            ImportColumn::make('kelas')
                ->rules(['max:50']),
            ImportColumn::make('qism_s')
                ->rules(['max:50']),
            ImportColumn::make('qism_detail_s')
                ->rules(['max:50']),
            ImportColumn::make('kelas_s')
                ->rules(['max:50']),
            ImportColumn::make('terakhir')
                ->rules(['max:50']),
            ImportColumn::make('is_active')
                ->boolean()
                ->rules(['boolean']),
            ImportColumn::make('created_by')
                ->rules(['max:255']),
            ImportColumn::make('updated_by')
                ->rules(['max:255']),
        ];
    }

    public function resolveRecord(): ?QismDetailHasKelas
    {
        // return QismDetailHasKelas::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new QismDetailHasKelas();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your qism detail has kelas import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
