<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Walisantri extends Model
{
    public function waktu_datang()
    {
        return $this->belongsTo(WaktuDatangKembali::class, 'waktu_datang_id');
    }

    public function waktu_kembali()
    {
        return $this->belongsTo(WaktuDatangKembali::class, 'waktu_kembali_id');
    }

    public function ak_nama_lengkap_sama()
    {
        return $this->belongsTo(YaTidak::class, 'ak_nama_lengkap_sama_id');
    }

    public function ak_tdk_hp()
    {
        return $this->belongsTo(YaTidak::class, 'ak_tdk_hp_id');
    }

    public function ak_nomor_handphone_sama()
    {
        return $this->belongsTo(YaTidak::class, 'ak_nomor_handphone_sama_id');
    }

    public function ak_kk_sama_pendaftar()
    {
        return $this->belongsTo(YaTidak::class, 'ak_kk_sama_pendaftar_id');
    }

    public function al_ak_tgldi_ln()
    {
        return $this->belongsTo(YaTidak::class, 'al_ak_tgldi_ln_id');
    }

    public function ik_nama_lengkap_sama()
    {
        return $this->belongsTo(YaTidak::class, 'ik_nama_lengkap_sama_id');
    }

    public function ik_tdk_hp()
    {
        return $this->belongsTo(YaTidak::class, 'ik_tdk_hp_id');
    }

    public function ik_nomor_handphone_sama()
    {
        return $this->belongsTo(YaTidak::class, 'ik_nomor_handphone_sama_id');
    }

    public function ik_kk_sama_ak()
    {
        return $this->belongsTo(YaTidak::class, 'ik_kk_sama_ak_id');
    }

    public function al_ik_sama_ak()
    {
        return $this->belongsTo(YaTidak::class, 'al_ik_sama_ak_id');
    }

    public function ik_kk_sama_pendaftar()
    {
        return $this->belongsTo(YaTidak::class, 'ik_kk_sama_pendaftar_id');
    }

    public function al_ik_tgldi_ln()
    {
        return $this->belongsTo(YaTidak::class, 'al_ik_tgldi_ln_id');
    }

    public function w_nama_lengkap_sama()
    {
        return $this->belongsTo(YaTidak::class, 'w_nama_lengkap_sama_id');
    }

    public function w_tdk_hp()
    {
        return $this->belongsTo(YaTidak::class, 'w_tdk_hp_id');
    }

    public function w_nomor_handphone_sama()
    {
        return $this->belongsTo(YaTidak::class, 'w_nomor_handphone_sama_id');
    }

    public function w_kk_sama_pendaftar()
    {
        return $this->belongsTo(YaTidak::class, 'w_kk_sama_pendaftar_id');
    }

    public function al_w_tgldi_ln()
    {
        return $this->belongsTo(YaTidak::class, 'al_w_tgldi_ln_id');
    }

    public function ak_status()
    {
        return $this->belongsTo(StatusWalisantri::class, 'ak_status_id');
    }

    public function ak_kewarganegaraan()
    {
        return $this->belongsTo(
            Kewarganegaraan::class,
            'ak_kewarganegaraan_id'
        );
    }

    public function ak_pend_terakhir()
    {
        return $this->belongsTo(
            PendidikanTerakhirWalisantri::class,
            'ak_pend_terakhir_id'
        );
    }

    public function ak_pekerjaan_utama()
    {
        return $this->belongsTo(
            PekerjaanUtamaWalisantri::class,
            'ak_pekerjaan_utama_id'
        );
    }

    public function ak_pghsln_rt()
    {
        return $this->belongsTo(
            PenghasilanWalisantri::class,
            'ak_pghsln_rt_id'
        );
    }

    public function al_ak_stts_rmh()
    {
        return $this->belongsTo(
            Statuskepemilikanrumah::class,
            'al_ak_stts_rmh_id'
        );
    }

    public function ik_status()
    {
        return $this->belongsTo(StatusWalisantri::class, 'ik_status_id');
    }

    public function ik_kewarganegaraan()
    {
        return $this->belongsTo(
            Kewarganegaraan::class,
            'ik_kewarganegaraan_id'
        );
    }

    public function ik_pend_terakhir()
    {
        return $this->belongsTo(
            PendidikanTerakhirWalisantri::class,
            'ik_pend_terakhir_id'
        );
    }

    public function ik_pekerjaan_utama()
    {
        return $this->belongsTo(
            PekerjaanUtamaWalisantri::class,
            'ik_pekerjaan_utama_id'
        );
    }

    public function ik_pghsln_rt()
    {
        return $this->belongsTo(
            PenghasilanWalisantri::class,
            'ik_pghsln_rt_id'
        );
    }

    public function al_ik_stts_rmh()
    {
        return $this->belongsTo(
            Statuskepemilikanrumah::class,
            'al_ik_stts_rmh_id'
        );
    }

    public function w_status()
    {
        return $this->belongsTo(StatusWali::class, 'w_status_id');
    }

    public function w_hubungan()
    {
        return $this->belongsTo(HubunganWali::class, 'w_hubungan_id');
    }

    public function w_kewarganegaraan()
    {
        return $this->belongsTo(Kewarganegaraan::class, 'w_kewarganegaraan_id');
    }

    public function w_pend_terakhir()
    {
        return $this->belongsTo(
            PendidikanTerakhirWalisantri::class,
            'w_pend_terakhir_id'
        );
    }

    public function w_pekerjaan_utama()
    {
        return $this->belongsTo(
            PekerjaanUtamaWalisantri::class,
            'w_pekerjaan_utama_id'
        );
    }

    public function w_pghsln_rt()
    {
        return $this->belongsTo(PenghasilanWalisantri::class, 'w_pghsln_rt_id');
    }

    public function al_w_stts_rmh()
    {
        return $this->belongsTo(
            Statuskepemilikanrumah::class,
            'al_w_stts_rmh_id'
        );
    }
    
    public function santris()
    {
        return $this->hasMany(Santri::class);
    }

    public function pesanDaftars()
    {
        return $this->hasMany(PesanDaftar::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function al_ak_provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'al_ak_provinsi_id');
    }

    public function al_ak_kabupaten()
    {
        return $this->belongsTo(Kabupaten::class, 'al_ak_kabupaten_id');
    }

    public function al_ak_kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'al_ak_kecamatan_id');
    }

    public function al_ak_kelurahan()
    {
        return $this->belongsTo(Kelurahan::class, 'al_ak_kelurahan_id');
    }

    public function al_ak_kodepos()
    {
        return $this->belongsTo(Kodepos::class, 'al_ak_kodepos_id');
    }

    public function al_ik_provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'al_ik_provinsi_id');
    }

    public function al_ik_kabupaten()
    {
        return $this->belongsTo(Kabupaten::class, 'al_ik_kabupaten_id');
    }

    public function al_ik_kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'al_ik_kecamatan_id');
    }

    public function al_ik_kelurahan()
    {
        return $this->belongsTo(Kelurahan::class, 'al_ik_kelurahan_id');
    }

    public function al_ik_kodepos()
    {
        return $this->belongsTo(Kodepos::class, 'al_ik_kodepos_id');
    }

    public function al_w_provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'al_w_provinsi_id');
    }

    public function al_w_kabupaten()
    {
        return $this->belongsTo(Kabupaten::class, 'al_w_kabupaten_id');
    }

    public function al_w_kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'al_w_kecamatan_id');
    }

    public function al_w_kelurahan()
    {
        return $this->belongsTo(Kelurahan::class, 'al_w_kelurahan_id');
    }

    public function al_w_kodepos()
    {
        return $this->belongsTo(Kodepos::class, 'al_w_kodepos_id');
    }

    public function kelasSantris()
    {
        return $this->hasMany(KelasSantri::class);
    }

    public function statussantris()
    {
        return $this->hasOne(StatusSantri::class, Santri::class);
    }

    public function ak_statusWalisantri()
    {
        return $this->belongsTo(StatusWalisantri::class, 'status_ak_id');
    }

    public function ik_statusWalisantri()
    {
        return $this->belongsTo(StatusWalisantri::class, 'status_ik_id');
    }

    public function w_statusWalisantri()
    {
        return $this->belongsTo(StatusWalisantri::class, 'status_w_id');
    }

    public function kewarganegaraan()
    {
        return $this->belongsTo(Kewarganegaraan::class);
    }

    public function pendidikanTerakhirWalisantri()
    {
        return $this->belongsTo(PendidikanTerakhirWalisantri::class);
    }

    public function ak_pendidikanTerakhirWalisantri()
    {
        return $this->belongsTo(PendidikanTerakhirWalisantri::class, 'pend_ak_id');
    }

    public function ik_pendidikanTerakhirWalisantri()
    {
        return $this->belongsTo(PendidikanTerakhirWalisantri::class, 'pend_ik_id');
    }

    public function w_pendidikanTerakhirWalisantri()
    {
        return $this->belongsTo(PendidikanTerakhirWalisantri::class, 'pend_w_id');
    }

    public function pekerjaanUtamaWalisantri()
    {
        return $this->belongsTo(PekerjaanUtamaWalisantri::class);
    }

    public function ak_pekerjaanUtamaWalisantri()
    {
        return $this->belongsTo(PekerjaanUtamaWalisantri::class, 'pekerjaan_ak_id');
    }

    public function ik_pekerjaanUtamaWalisantri()
    {
        return $this->belongsTo(PekerjaanUtamaWalisantri::class, 'pekerjaan_ik_id');
    }

    public function w_pekerjaanUtamaWalisantri()
    {
        return $this->belongsTo(PekerjaanUtamaWalisantri::class, 'pekerjaan_w_id');
    }

    public function penghasilanWalisantri()
    {
        return $this->belongsTo(PenghasilanWalisantri::class);
    }

    public function ak_penghasilanWalisantri()
    {
        return $this->belongsTo(PenghasilanWalisantri::class, 'penghasilan_ak_id');
    }

    public function ik_penghasilanWalisantri()
    {
        return $this->belongsTo(PenghasilanWalisantri::class, 'penghasilan_ik_id');
    }

    public function w_penghasilanWalisantri()
    {
        return $this->belongsTo(PenghasilanWalisantri::class, 'penghasilan_w_id');
    }

    public function statuskepemilikanrumah()
    {
        return $this->belongsTo(Statuskepemilikanrumah::class);
    }

    public function ak_statuskepemilikanrumah()
    {
        return $this->belongsTo(Statuskepemilikanrumah::class, 'statuskepemilikan_ak_id');
    }

    public function ik_statuskepemilikanrumah()
    {
        return $this->belongsTo(Statuskepemilikanrumah::class, 'statuskepemilikan_ik_id');
    }

    public function w_statuskepemilikanrumah()
    {
        return $this->belongsTo(Statuskepemilikanrumah::class, 'statuskepemilikan_w_id');
    }

    public function w_statusWali()
    {
        return $this->belongsTo(StatusWali::class, 'status_wali_id');
    }

    public function w_hubunganWali()
    {
        return $this->belongsTo(HubunganWali::class, 'hubungan_wali_id');
    }

    public function ik_kajian_sama_ak()
    {
        return $this->belongsTo(YaTidak::class, 'ik_kajian_sama_ak_id');
    }

    public function menginapTidak()
    {
        return $this->belongsTo(MenginapTidak::class);
    }

    public function is_kk_baru()
    {
        return $this->belongsTo(YaTidak::class, 'is_kk_baru_id');
    }

    use log;
}
