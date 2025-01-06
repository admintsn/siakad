<?php

namespace App\Filament\Imports;

use App\Models\QismDetail;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class QismDetailImporter extends Importer
{
    protected static ?string $model = QismDetail::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('qism_id')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
            ImportColumn::make('abbr_qism_detail')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('qism_detail')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('jeniskelamin')
                ->rules(['max:50']),
            ImportColumn::make('kode_qism_detail')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('qism_detail_s')
                ->rules(['max:50']),
            ImportColumn::make('jeniskelamin_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('qism_detail_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('is_active')
                ->boolean()
                ->rules(['boolean']),
            ImportColumn::make('created_by')
                ->rules(['max:255']),
            ImportColumn::make('updated_by')
                ->rules(['max:255']),
        ];
    }

    public function resolveRecord(): ?QismDetail
    {
        // return QismDetail::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new QismDetail();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your qism detail import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
