<?php

namespace App\Filament\Exports;

use App\Models\Nilai;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class NilaiExporter extends Exporter
{
    protected static ?string $model = Nilai::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('jenis_soal_id'),
            ExportColumn::make('jenisSoal.jenis_soal'),
            ExportColumn::make('qism_id'),
            ExportColumn::make('qism.abbr_qism'),
            ExportColumn::make('qism_detail_id'),
            ExportColumn::make('qismDetail.abbr_qism_detail'),
            ExportColumn::make('tahun_ajaran_id'),
            ExportColumn::make('tahunAjaran.abbr_ta'),
            ExportColumn::make('tahun_berjalan_id'),
            ExportColumn::make('tahunBerjalan.tb'),
            ExportColumn::make('semester_berjalan_id'),
            ExportColumn::make('semesterBerjalan.semester_berjalan'),
            ExportColumn::make('semester_id'),
            ExportColumn::make('sem.abbr_semester'),
            ExportColumn::make('kelas_id'),
            ExportColumn::make('kelas.kelas'),
            ExportColumn::make('kelas_internal'),
            ExportColumn::make('mapel_id'),
            ExportColumn::make('mapel.mapel'),
            ExportColumn::make('kategori_soal_id'),
            ExportColumn::make('kategoriSoal.kategori'),
            ExportColumn::make('pengajar_id'),
            ExportColumn::make('pengajar.nama'),
            ExportColumn::make('staff_admin_id'),
            ExportColumn::make('staffAdmin.nama_staff'),
            ExportColumn::make('kode_soal'),
            ExportColumn::make('jumlah_print'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your nilai export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
