<?php

namespace App\Filament\Imports;

use App\Models\JumlahSantri;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class JumlahSantriImporter extends Importer
{
    protected static ?string $model = JumlahSantri::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('qism_id')
                ->rules(['max:10']),
            ImportColumn::make('kelas_id')
                ->rules(['max:10']),
            ImportColumn::make('putra')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('putri')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('total')
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

    public function resolveRecord(): ?JumlahSantri
    {
        // return JumlahSantri::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new JumlahSantri();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your jumlah santri import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
