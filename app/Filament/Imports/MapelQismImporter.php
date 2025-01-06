<?php

namespace App\Filament\Imports;

use App\Models\MapelQism;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class MapelQismImporter extends Importer
{
    protected static ?string $model = MapelQism::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('qism_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('mapel_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('jenis_soal_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('kategori_soal_id')
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

    public function resolveRecord(): ?MapelQism
    {
        // return MapelQism::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new MapelQism();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your mapel qism import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
