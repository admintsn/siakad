<?php

namespace App\Filament\Imports;

use App\Models\NomorSurat;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class NomorSuratImporter extends Importer
{
    protected static ?string $model = NomorSurat::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('tanggal_surat')
                ->rules(['date']),
            ImportColumn::make('nomor')
                ->rules(['max:255']),
            ImportColumn::make('mahad_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('qism_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('santri_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('tujuan_surat_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('jenis_surat_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('tahunhberjalan_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('tahunmberjalan_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('nomor_surat')
                ->rules(['max:255']),
            ImportColumn::make('perihal_surat')
                ->rules(['max:255']),
            ImportColumn::make('file_raw'),
            ImportColumn::make('file_signed'),
            ImportColumn::make('is_confirned')
                ->boolean()
                ->rules(['boolean']),
            ImportColumn::make('is_printed')
                ->boolean()
                ->rules(['boolean']),
            ImportColumn::make('is_signed')
                ->boolean()
                ->rules(['boolean']),
            ImportColumn::make('is_scanned')
                ->boolean()
                ->rules(['boolean']),
            ImportColumn::make('is_sent')
                ->boolean()
                ->rules(['boolean']),
            ImportColumn::make('is_needrevise')
                ->boolean()
                ->rules(['boolean']),
            ImportColumn::make('is_revised')
                ->boolean()
                ->rules(['boolean']),
            ImportColumn::make('is_active')
                ->boolean()
                ->rules(['boolean']),
            ImportColumn::make('created_by')
                ->rules(['max:255']),
            ImportColumn::make('updated_by')
                ->rules(['max:255']),
        ];
    }

    public function resolveRecord(): ?NomorSurat
    {
        // return NomorSurat::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new NomorSurat();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your nomor surat import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
