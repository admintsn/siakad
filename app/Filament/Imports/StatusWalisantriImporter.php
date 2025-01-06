<?php

namespace App\Filament\Imports;

use App\Models\StatusWalisantri;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class StatusWalisantriImporter extends Importer
{
    protected static ?string $model = StatusWalisantri::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('status_walisantri')
                ->rules(['max:255']),
            ImportColumn::make('is_active')
                ->boolean()
                ->rules(['boolean']),
            ImportColumn::make('created_by')
                ->rules(['max:255']),
            ImportColumn::make('updated_ by')
                ->rules(['max:255']),
        ];
    }

    public function resolveRecord(): ?StatusWalisantri
    {
        // return StatusWalisantri::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new StatusWalisantri();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your status walisantri import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
