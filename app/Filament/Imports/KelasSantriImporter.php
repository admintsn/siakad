<?php

namespace App\Filament\Imports;

use App\Models\KelasSantri;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class KelasSantriImporter extends Importer
{
    protected static ?string $model = KelasSantri::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('mahad_id')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
            ImportColumn::make('qism_id')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
            ImportColumn::make('tahun_berjalan_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('tahun_ajaran_id')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
            ImportColumn::make('semester_id')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
            ImportColumn::make('kelas_id')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
            ImportColumn::make('qism_detail_id')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
            ImportColumn::make('kelas_internal')
                ->rules(['max:255']),
            ImportColumn::make('kelas_internal_barab')
                ->rules(['max:255']),
            ImportColumn::make('kelas_internal_matematika')
                ->rules(['max:255']),
            ImportColumn::make('halaqoh')
                ->rules(['max:255']),
            ImportColumn::make('santri_id')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
            ImportColumn::make('walisantri_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('kartu_keluarga')
                ->rules(['max:16']),
            ImportColumn::make('tanggalupdate')
                ->rules(['date']),
            ImportColumn::make('is_mustamiah')
                ->boolean()
                ->rules(['boolean']),
            ImportColumn::make('is_active')
                ->requiredMapping()
                ->boolean()
                ->rules(['required', 'boolean']),
            ImportColumn::make('created_by')
                ->rules(['max:255']),
            ImportColumn::make('updated_by')
                ->rules(['max:255']),
        ];
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
        $body = 'Your kelas santri import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
