<?php

namespace App\Filament\Imports;

use App\Models\Tahunhberjalan;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class TahunhberjalanImporter extends Importer
{
    protected static ?string $model = Tahunhberjalan::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('tahunhberjalan')
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

    public function resolveRecord(): ?Tahunhberjalan
    {
        // return Tahunhberjalan::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new Tahunhberjalan();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your tahunhberjalan import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
