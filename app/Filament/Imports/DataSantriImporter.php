<?php

namespace App\Filament\Imports;

use App\Models\DataSantri;
use App\Models\KelasSantri;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class DataSantriImporter extends Importer
{
    protected static ?string $model = KelasSantri::class;

    public static function getColumns(): array
    {
        return [];
    }

    public function resolveRecord(): ?KelasSantri
    {
        // return KelasSantri::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new KelasSantri();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your data santri import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
