<?php

namespace App\Filament\Imports;

use App\Models\Semester;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class SemesterImporter extends Importer
{
    protected static ?string $model = Semester::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('qism_id')
                ->rules(['max:50']),
            ImportColumn::make('semester')
                ->rules(['max:255']),
            ImportColumn::make('abbr_semester')
                ->rules(['max:50']),
            ImportColumn::make('sem_s')
                ->rules(['max:50']),
            ImportColumn::make('sem_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('sem_sel')
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

    public function resolveRecord(): ?Semester
    {
        // return Semester::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new Semester();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your semester import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
