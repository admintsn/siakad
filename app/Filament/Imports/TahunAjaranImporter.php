<?php

namespace App\Filament\Imports;

use App\Models\TahunAjaran;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class TahunAjaranImporter extends Importer
{
    protected static ?string $model = TahunAjaran::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('ta')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('abbr_ta')
                ->rules(['max:50']),
            ImportColumn::make('ta_s')
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

    public function resolveRecord(): ?TahunAjaran
    {
        // return TahunAjaran::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new TahunAjaran();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your tahun ajaran import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
