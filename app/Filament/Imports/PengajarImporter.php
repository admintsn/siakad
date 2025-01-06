<?php

namespace App\Filament\Imports;

use App\Models\Pengajar;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class PengajarImporter extends Importer
{
    protected static ?string $model = Pengajar::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('nama')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('user_id')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
            ImportColumn::make('gelar_depan')
                ->rules(['max:255']),
            ImportColumn::make('nama_lengkap')
                ->rules(['max:255']),
            ImportColumn::make('gelar_belakang')
                ->rules(['max:255']),
            ImportColumn::make('status_kepegawaian')
                ->rules(['max:255']),
            ImportColumn::make('nik')
                ->rules(['max:16']),
            ImportColumn::make('npk')
                ->rules(['max:255']),
            ImportColumn::make('nuptk')
                ->rules(['max:255']),
            ImportColumn::make('tmt_pegawai')
                ->rules(['max:50']),
            ImportColumn::make('tmt_ustadz')
                ->rules(['max:50']),
            ImportColumn::make('hp')
                ->rules(['max:255']),
            ImportColumn::make('email')
                ->rules(['email', 'max:255']),
            ImportColumn::make('npwp')
                ->rules(['max:255']),
            ImportColumn::make('jenis_kelamin')
                ->rules(['max:255']),
            ImportColumn::make('tempat_lahir')
                ->rules(['max:255']),
            ImportColumn::make('tanggal_lahir')
                ->rules(['max:255']),
            ImportColumn::make('agama')
                ->rules(['max:255']),
            ImportColumn::make('golongan_darah')
                ->rules(['max:255']),
            ImportColumn::make('pendidikan_terakhir')
                ->rules(['max:255']),
            ImportColumn::make('prodi_terakhir')
                ->rules(['max:255']),
            ImportColumn::make('tanggal_ijazah')
                ->rules(['max:255']),
            ImportColumn::make('status_tempat_tinggal')
                ->rules(['max:255']),
            ImportColumn::make('provinsi_id')
                ->rules(['max:255']),
            ImportColumn::make('kabupaten_id')
                ->rules(['max:255']),
            ImportColumn::make('kecamatan_id')
                ->rules(['max:255']),
            ImportColumn::make('kelurahan_id')
                ->rules(['max:255']),
            ImportColumn::make('rt')
                ->rules(['max:255']),
            ImportColumn::make('rw')
                ->rules(['max:255']),
            ImportColumn::make('alamat'),
            ImportColumn::make('kodepos')
                ->rules(['max:255']),
            ImportColumn::make('transportasi')
                ->rules(['max:255']),
            ImportColumn::make('jarak')
                ->rules(['max:255']),
            ImportColumn::make('waktu_tempuh')
                ->rules(['max:255']),
            ImportColumn::make('nama_ibu_kandung')
                ->rules(['max:255']),
            ImportColumn::make('status_perkawinan')
                ->rules(['max:255']),
            ImportColumn::make('nomor_kk')
                ->rules(['max:16']),
            ImportColumn::make('no_rekening')
                ->rules(['max:255']),
            ImportColumn::make('nama_rekening')
                ->rules(['max:255']),
            ImportColumn::make('nama_bank')
                ->rules(['max:255']),
            ImportColumn::make('cabang_bank')
                ->rules(['max:255']),
            ImportColumn::make('tugas_utama')
                ->rules(['max:255']),
            ImportColumn::make('tugas_tambahan')
                ->rules(['max:255']),
            ImportColumn::make('is_lengkap')
                ->rules(['max:10']),
            ImportColumn::make('is_active')
                ->rules(['max:10']),
            ImportColumn::make('is_emis')
                ->rules(['max:10']),
            ImportColumn::make('statuskepegawaian_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('golongandarah_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('jeniskelamin_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('statuskepemilikanrumah_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('transpp_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('jarakpp_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('waktutempuh_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('statusperkawinan_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('created_by')
                ->rules(['max:255']),
            ImportColumn::make('updated_by')
                ->rules(['max:255']),
        ];
    }

    public function resolveRecord(): ?Pengajar
    {
        // return Pengajar::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new Pengajar();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your pengajar import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
