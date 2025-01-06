<?php

namespace App\Filament\Imports;

use App\Models\NilaiImtihan;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class NilaiImtihanImporter extends Importer
{
    protected static ?string $model = NilaiImtihan::class;

    public static function getColumns(): array
    {
        return [
            //
        ];
    }

    public function resolveRecord(): ?NilaiImtihan
    {
        // return NilaiImtihan::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new NilaiImtihan();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your nilai imtihan import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
