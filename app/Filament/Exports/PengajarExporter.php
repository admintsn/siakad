<?php

namespace App\Filament\Exports;

use App\Models\Pengajar;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class PengajarExporter extends Exporter
{
    protected static ?string $model = Pengajar::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('nama'),
            ExportColumn::make('user_id'),
            ExportColumn::make('gelar_depan'),
            ExportColumn::make('nama_lengkap'),
            ExportColumn::make('gelar_belakang'),
            ExportColumn::make('status_kepegawaian'),
            ExportColumn::make('nik'),
            ExportColumn::make('npk'),
            ExportColumn::make('nuptk'),
            ExportColumn::make('tmt_pegawai'),
            ExportColumn::make('tmt_ustadz'),
            ExportColumn::make('hp'),
            ExportColumn::make('email'),
            ExportColumn::make('npwp'),
            ExportColumn::make('jenis_kelamin'),
            ExportColumn::make('tempat_lahir'),
            ExportColumn::make('tanggal_lahir'),
            ExportColumn::make('agama'),
            ExportColumn::make('golongan_darah'),
            ExportColumn::make('pendidikan_terakhir'),
            ExportColumn::make('prodi_terakhir'),
            ExportColumn::make('tanggal_ijazah'),
            ExportColumn::make('status_tempat_tinggal'),
            ExportColumn::make('provinsi_id'),
            ExportColumn::make('kabupaten_id'),
            ExportColumn::make('kecamatan_id'),
            ExportColumn::make('kelurahan_id'),
            ExportColumn::make('rt'),
            ExportColumn::make('rw'),
            ExportColumn::make('alamat'),
            ExportColumn::make('kodepos'),
            ExportColumn::make('transportasi'),
            ExportColumn::make('jarak'),
            ExportColumn::make('waktu_tempuh'),
            ExportColumn::make('nama_ibu_kandung'),
            ExportColumn::make('status_perkawinan'),
            ExportColumn::make('nomor_kk'),
            ExportColumn::make('no_rekening'),
            ExportColumn::make('nama_rekening'),
            ExportColumn::make('nama_bank'),
            ExportColumn::make('cabang_bank'),
            ExportColumn::make('tugas_utama'),
            ExportColumn::make('tugas_tambahan'),
            ExportColumn::make('is_lengkap'),
            ExportColumn::make('is_active'),
            ExportColumn::make('is_emis'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
            ExportColumn::make('statuskepegawaian_id'),
            ExportColumn::make('golongandarah_id'),
            ExportColumn::make('jeniskelamin_id'),
            ExportColumn::make('statuskepemilikanrumah_id'),
            ExportColumn::make('transpp_id'),
            ExportColumn::make('jarakpp_id'),
            ExportColumn::make('waktutempuh_id'),
            ExportColumn::make('statusperkawinan_id'),
            ExportColumn::make('created_by'),
            ExportColumn::make('updated_by'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your pengajar export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
