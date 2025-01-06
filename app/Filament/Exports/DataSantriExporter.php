<?php

namespace App\Filament\Exports;

use App\Models\DataSantri;
use App\Models\KelasSantri;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class DataSantriExporter extends Exporter
{
    protected static ?string $model = KelasSantri::class;

    public static function getColumns(): array
    {
        return [

            ExportColumn::make('walisantri.ak_no_kk')
                ->label('KK'),

            ExportColumn::make('walisantri.ak_nama_lengkap')
                ->label('Nama Ayah Kandung'),

            ExportColumn::make('walisantri.ak_status.status_walisantri')
                ->label('Status Ayah Kandung'),

            ExportColumn::make('walisantri.ak_nik')
                ->label('NIK Ayah Kandung'),

            ExportColumn::make('walisantri.ak_tempat_lahir')
                ->label('Tempat Lahir Ayah Kandung'),

            ExportColumn::make('walisantri.ak_tanggal_lahir')
                ->label('Tanggal Lahir Ayah Kandung'),

            ExportColumn::make('walisantri.ak_pend_terakhir.pendidikan_terakhir_walisantri')
                ->label('Pendidikan Terakhir Ayah Kandung'),

            ExportColumn::make('walisantri.ak_pekerjaan_utama.pekerjaan_utama_walisantri')
                ->label('Pekerjaan Utama Ayah Kandung'),

            ExportColumn::make('walisantri.ak_pghsln_rt.penghasilan_walisantri')
                ->label('Penghasilan Rata-rata Ayah Kandung'),

            ExportColumn::make('walisantri.ak_ustadz_kajian')
                ->label('Ustadz Kajian Ayah Kandung'),

            ExportColumn::make('walisantri.ak_tempat_kajian')
                ->label('Tempat Kajian Ayah Kandung'),

            ExportColumn::make('walisantri.ak_nomor_handphone')
                ->label('Handphone Ayah Kandung'),

            ExportColumn::make('walisantri.ik_nama_lengkap')
                ->label('Nama Ibu Kandung'),

            ExportColumn::make('walisantri.ik_status.status_walisantri')
                ->label('Status Ibu Kandung'),

            ExportColumn::make('walisantri.ik_nik')
                ->label('NIK Ibu Kandung'),

            ExportColumn::make('walisantri.ik_tempat_lahir')
                ->label('Tempat Lahir Ibu Kandung'),

            ExportColumn::make('walisantri.ik_tanggal_lahir')
                ->label('Tanggal Lahir Ibu Kandung'),

            ExportColumn::make('walisantri.ik_pend_terakhir.pendidikan_terakhir_walisantri')
                ->label('Pendidikan Terakhir Ibu Kandung'),

            ExportColumn::make('walisantri.ik_pekerjaan_utama.pekerjaan_utama_walisantri')
                ->label('Pekerjaan Utama Ibu Kandung'),

            ExportColumn::make('walisantri.ik_pghsln_rt.penghasilan_walisantri')
                ->label('Penghasilan Rata-rata Ibu Kandung'),

            ExportColumn::make('walisantri.ik_ustadz_kajian')
                ->label('Ustadz Kajian Ibu Kandung'),

            ExportColumn::make('walisantri.ik_tempat_kajian')
                ->label('Tempat Kajian Ibu Kandung'),

            ExportColumn::make('walisantri.ik_nomor_handphone')
                ->label('Handphone Ibu Kandung'),

            ExportColumn::make('walisantri.w_hubungan.hubungan.wali')
                ->label('Hubungan Wali'),

            ExportColumn::make('walisantri.w_nama_lengkap')
                ->label('Nama Wali'),

            ExportColumn::make('walisantri.w_status.status_wali')
                ->label('Status Wali'),

            ExportColumn::make('walisantri.w_nik')
                ->label('NIK Wali'),

            ExportColumn::make('walisantri.w_tempat_lahir')
                ->label('Tempat Lahir Wali'),

            ExportColumn::make('walisantri.w_tanggal_lahir')
                ->label('Tanggal Lahir Wali'),

            ExportColumn::make('walisantri.w_pend_terakhir.pendidikan_terakhir_walisantri')
                ->label('Pendidikan Terakhir Wali'),

            ExportColumn::make('walisantri.w_pekerjaan_utama.pekerjaan_utama_walisantri')
                ->label('Pekerjaan Utama Wali'),

            ExportColumn::make('walisantri.w_pghsln_rt.penghasilan_walisantri')
                ->label('Penghasilan Rata-rata Wali'),

            ExportColumn::make('walisantri.w_ustadz_kajian')
                ->label('Ustadz Kajian Wali'),

            ExportColumn::make('walisantri.w_tempat_kajian')
                ->label('Tempat Kajian Wali'),

            ExportColumn::make('walisantri.w_nomor_handphone')
                ->label('Handphone Wali'),

            ExportColumn::make('walisantri.al_ak_provinsi.provinsi')
                ->label('Provinsi'),

            ExportColumn::make('walisantri.al_ak_kabupaten.kabupaten')
                ->label('Kabupaten'),

            ExportColumn::make('walisantri.al_ak_kecamatan.kecamatan')
                ->label('Kecamatan'),

            ExportColumn::make('walisantri.al_ak_kelurahan.kelurahan')
                ->label('Kelurahan'),

            ExportColumn::make('walisantri.al_ak_rt')
                ->label('RT'),

            ExportColumn::make('walisantri.al_ak_rw')
                ->label('RW'),

            ExportColumn::make('walisantri.al_ak_alamat')
                ->label('Alamat'),

            ExportColumn::make('walisantri.al_ak_kodepos')
                ->label('Kodepos'),

            ExportColumn::make('statussantri.statSantri.stat_santri')
                ->label('Status'),

            ExportColumn::make('statussantri.ket_status')
                ->label('Ket Status'),

            ExportColumn::make('santri.nama_lengkap')
                ->label('Nama'),

            ExportColumn::make('santri.nism')
                ->label('NISM'),

            ExportColumn::make('santri.nama_panggilan')
                ->label('Panggilan'),

            ExportColumn::make('santri.nik')
                ->label('NIK'),

            ExportColumn::make('santri.jeniskelamin.jeniskelamin')
                ->label('Jenis Kelamin'),

            ExportColumn::make('santri.tempat_lahir')
                ->label('Tempat Lahir'),

            ExportColumn::make('santri.tanggal_lahir')
                ->label('Tanggal Lahir'),

            ExportColumn::make('santri.umur')
                ->label('Umur'),

            ExportColumn::make('santri.cita_cita.cita')
                ->label('Cita-cita'),

            ExportColumn::make('santri.cita_cita_lainnya')
                ->label('Cita-cita Lainnya'),

            ExportColumn::make('santri.hobi.hobi')
                ->label('Hobi'),

            ExportColumn::make('santri.hobi_lainnya')
                ->label('Hobi Lainnya'),

            ExportColumn::make('santri.anak_ke')
                ->label('Anak Ke'),

            ExportColumn::make('santri.jumlah_saudara')
                ->label('Jumlah Saudara'),

            ExportColumn::make('santri.nomor_handphone')
                ->label('Handphone'),

            ExportColumn::make('santri.email')
                ->label('Email'),

            ExportColumn::make('santri.bya_sklh.membiayai_sekolah')
                ->label('Biaya Sekolah'),

            ExportColumn::make('santri.bya_sklh_lainnya')
                ->label('Biaya Sekolah Lainnya'),

            ExportColumn::make('santri.keb_khus.kebutuhan_khusus')
                ->label('Kebutuhan Khusus'),

            ExportColumn::make('santri.keb_khus_lainnya')
                ->label('Kebutuhan Khusus Lainnya'),

            ExportColumn::make('santri.keb_dis.kebutuhan_disabilitas')
                ->label('Kebutuhan Disabilitas'),

            ExportColumn::make('santri.keb_dis_lainnya')
                ->label('Kebutuhan Disabilitas Lainnya'),

            ExportColumn::make('santri.kartu_keluarga')
                ->label('Kartu Keluarga'),

            ExportColumn::make('santri.nama_kpl_kel')
                ->label('Nama Kepala Keluarga'),

            ExportColumn::make('santri.al_s_jarak.jarak_kepp')
                ->label('Jarak'),

            ExportColumn::make('santri.al_s_transportasi.transportasi_kepp')
                ->label('Transportasi'),

            ExportColumn::make('santri.al_s_waktu_tempuh.waktu_tempuh')
                ->label('Waktu Tempuh'),

            ExportColumn::make('qism.kode_qism')
                ->label('Kode Qism'),

            ExportColumn::make('qism_detail.kode_qism_detail')
                ->label('Kode Qism Detail'),

            ExportColumn::make('kelas.id')
                ->label('Kode Kelas'),

            ExportColumn::make('qism_detail.abbr_qism_detail')
                ->label('Qism'),

            ExportColumn::make('kelas.kelas')
                ->label('Kelas'),

            ExportColumn::make('kelas_internal')
                ->label('Kelas Internal'),

            ExportColumn::make('kelas_internal_barab')
                ->label('Kelas Internal Bahasa Arab'),

            ExportColumn::make('kelas_internal_matematika')
                ->label('Kelas Internal Matematika'),

            ExportColumn::make('halaqoh')
                ->label('Halaqoh'),

            ExportColumn::make('walisantri.ws_emis4')
                ->label('Status Data Walisantri')
                ->default('Belum Lengkap')
                ->formatStateUsing(function ($state) {
                    // $wsemis4 = Walisantri::where('id', $record->walisantri_id)->first();
                    // // dd($pendaftar->ps_kadm_status);
                    // // dd($wsemis4);
                    // if ($wsemis4->ws_emis4 === null) {
                    //     return ('Belum lengkap');
                    // } elseif ($wsemis4->ws_emis4 !== null) {
                    //     return ('Lengkap');
                    // }

                    if ($state !== '1') {
                        return ('Belum lengkap');
                    } elseif ($state === '1') {
                        return ('Lengkap');
                    }
                }),

            ExportColumn::make('santri.s_emis4')
                ->label('Status Data Santri')
                ->default('Belum Lengkap')
                ->formatStateUsing(function ($state) {
                    // $semis4 = ModelsSantri::where('id', $record->santri_id)->first();
                    // // dd($pendaftar->ps_kadm_status);
                    // if ($semis4->s_emis4 === null) {
                    //     return ('Belum lengkap');
                    // } elseif ($semis4->s_emis4 !== null) {
                    //     return ('Lengkap');
                    // }
                    if ($state !== '1') {
                        return ('Belum lengkap');
                    } elseif ($state === '1') {
                        return ('Lengkap');
                    }
                }),

            ExportColumn::make('santri.nama_lengkap')
                ->label('Nama'),

            ExportColumn::make('kelas.kelas')
                ->label('Kelas'),

            ExportColumn::make('santri.nism')
                ->label('NISM'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your data santri export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
