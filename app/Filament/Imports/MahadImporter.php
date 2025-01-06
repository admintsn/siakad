<?php

namespace App\Filament\Imports;

use App\Models\Mahad;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class MahadImporter extends Importer
{
    protected static ?string $model = Mahad::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('mahad')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('nsp')
                ->rules(['max:255']),
            ImportColumn::make('provinsi_id')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
            ImportColumn::make('kabupaten_id')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
            ImportColumn::make('kecamatan_id')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
            ImportColumn::make('kelurahan_id')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
            ImportColumn::make('rt')
                ->rules(['max:255']),
            ImportColumn::make('rw')
                ->rules(['max:255']),
            ImportColumn::make('alamat'),
            ImportColumn::make('kodepos')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('is_active')
                ->boolean()
                ->rules(['boolean']),
            ImportColumn::make('created_by')
                ->rules(['max:255']),
            ImportColumn::make('updated_by')
                ->rules(['max:255']),
        ];
    }

    public function resolveRecord(): ?Mahad
    {
        // return Mahad::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new Mahad();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your mahad import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
