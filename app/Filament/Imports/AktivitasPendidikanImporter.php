<?php

namespace App\Filament\Imports;

use App\Models\AktivitasPendidikan;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class AktivitasPendidikanImporter extends Importer
{
    protected static ?string $model = AktivitasPendidikan::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('aktivitas_pendidikan')
                ->rules(['max:255']),
            ImportColumn::make('is_active')
                ->boolean()
                ->rules(['boolean']),
            ImportColumn::make('created_by')
                ->rules(['max:255']),
            ImportColumn::make('updated_by')
                ->rules(['max:255']),
        ];
    }

    public function resolveRecord(): ?AktivitasPendidikan
    {
        // return AktivitasPendidikan::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new AktivitasPendidikan();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your aktivitas pendidikan import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
