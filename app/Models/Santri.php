<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Santri extends Model
{
    protected $casts = [
        'ps_kkh_medsos_sering_id' => 'array',
    ];

    public function walisantri()
    {
        return $this->belongsTo(Walisantri::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function ws()
    {
        return $this->hasOne(Walisantri::class);
    }

    public function kelasSantris()
    {
        return $this->hasMany(KelasSantri::class);
    }

    public function kelassantri()
    {
        return $this->hasOne(KelasSantri::class);
    }

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class);
    }

    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class);
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }

    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class);
    }

    public function kodepos()
    {
        return $this->belongsTo(Kodepos::class);
    }

    public function statusSantris()
    {
        return $this->hasMany(StatusSantri::class);
    }

    public function statussantri()
    {
        return $this->hasOne(StatusSantri::class);
    }

    public function pendaftar()
    {
        return $this->hasOne(Pendaftar::class);
    }

    public function pendaftars()
    {
        return $this->hasMany(Pendaftar::class);
    }

    public function qism_detail()
    {
        return $this->belongsTo(QismDetail::class);
    }

    public function qism()
    {
        return $this->belongsTo(Qism::class);
    }

    public function kss()
    {
        return $this->belongsTo(KeteranganStatusSantri::class);
    }

    public function kartuKeluargaSamaDengan()
    {
        return $this->belongsTo(KartuKeluargaSamaDengan::class);
    }

    public function cita()
    {
        return $this->belongsTo(Cita::class);
    }

    public function kebutuhanKhusus()
    {
        return $this->belongsTo(KebutuhanKhusus::class);
    }

    public function kebutuhanDisabilitas()
    {
        return $this->belongsTo(KebutuhanDisabilitas::class);
    }

    public function membiayaiSekolah()
    {
        return $this->belongsTo(MembiayaiSekolah::class);
    }

    public function mendaftarKeinginan()
    {
        return $this->belongsTo(MendaftarKeinginan::class);
    }

    public function statusTempatTinggal()
    {
        return $this->belongsTo(StatusTempatTinggal::class);
    }

    public function anandaBerada()
    {
        return $this->belongsTo(AnandaBerada::class);
    }

    public function medsosAnanda()
    {
        return $this->belongsTo(MedsosAnanda::class);
    }

    public function transpp()
    {
        return $this->belongsTo(Transpp::class);
    }

    public function jarakpp()
    {
        return $this->belongsTo(Jarakpp::class);
    }

    public function waktutempuh()
    {
        return $this->belongsTo(Waktutempuh::class);
    }

    public function hafalan()
    {
        return $this->belongsTo(Hafalan::class);
    }

    public function nomorSurats()
    {
        return $this->hasMany(NomorSurat::class);
    }

    public function jenisPendaftar()
    {
        return $this->belongsTo(JenisPendaftar::class);
    }

    public function tahapPendaftaran()
    {
        return $this->belongsTo(TahapPendaftaran::class);
    }

    public function statusPendaftaran()
    {
        return $this->belongsTo(StatusPendaftaran::class);
    }

    public function al_s_status_mukim()
    {
        return $this->belongsTo(MukimTidak::class, 'al_s_status_mukim_id');
    }

    public function ps_kkh_fasilitas_gawai()
    {
        return $this->belongsTo(YaTidak::class, 'ps_kkh_fasilitas_gawai_id');
    }

    public function ps_kkh_fasilitas_gawai_medsos_menutup()
    {
        return $this->belongsTo(
            BersediaTidak::class,
            'ps_kkh_fasilitas_gawai_medsos_menutup_id'
        );
    }

    public function ps_kkh_medsos_group()
    {
        return $this->belongsTo(YaTidak::class, 'ps_kkh_medsos_group_id');
    }

    public function ps_kkes_sakit_serius()
    {
        return $this->belongsTo(YaTidak::class, 'ps_kkes_sakit_serius_id');
    }

    public function ps_kkes_terapi()
    {
        return $this->belongsTo(YaTidak::class, 'ps_kkes_terapi_id');
    }

    public function ps_kkes_kambuh()
    {
        return $this->belongsTo(YaTidak::class, 'ps_kkes_kambuh_id');
    }

    public function ps_kkes_alergi()
    {
        return $this->belongsTo(YaTidak::class, 'ps_kkes_alergi_id');
    }

    public function ps_kkes_pantangan()
    {
        return $this->belongsTo(YaTidak::class, 'ps_kkes_pantangan_id');
    }

    public function ps_kkes_psikologis()
    {
        return $this->belongsTo(YaTidak::class, 'ps_kkes_psikologis_id');
    }

    public function ps_kkes_gangguan()
    {
        return $this->belongsTo(YaTidak::class, 'ps_kkes_gangguan_id');
    }

    public function ps_kkm_bak()
    {
        return $this->belongsTo(YaTidak::class, 'ps_kkm_bak_id');
    }

    public function ps_kkm_bab()
    {
        return $this->belongsTo(YaTidak::class, 'ps_kkm_bab_id');
    }

    public function ps_kkm_cebok()
    {
        return $this->belongsTo(YaTidak::class, 'ps_kkm_cebok_id');
    }

    public function ps_kkm_ngompol()
    {
        return $this->belongsTo(YaTidak::class, 'ps_kkm_ngompol_id');
    }

    public function ps_kkm_disuapin()
    {
        return $this->belongsTo(YaTidak::class, 'ps_kkm_disuapin_id');
    }

    public function ps_kadm_status()
    {
        return $this->belongsTo(StatusAdmPendaftar::class, 'ps_kadm_status_id');
    }

    public function ps_kadm_surat_subsidi()
    {
        return $this->belongsTo(
            BersediaTidak::class,
            'ps_kadm_surat_subsidi_id'
        );
    }

    public function ps_kadm_surat_kurang_mampu()
    {
        return $this->belongsTo(
            BersediaTidak::class,
            'ps_kadm_surat_kurang_mampu_id'
        );
    }

    public function ps_kadm_atur_keuangan()
    {
        return $this->belongsTo(
            BersediaTidak::class,
            'ps_kadm_atur_keuangan_id'
        );
    }

    public function ps_kadm_penentuan_subsidi()
    {
        return $this->belongsTo(
            BersediaTidak::class,
            'ps_kadm_penentuan_subsidi_id'
        );
    }

    public function ps_kadm_hidup_sederhana()
    {
        return $this->belongsTo(
            BersediaTidak::class,
            'ps_kadm_hidup_sederhana_id'
        );
    }

    public function ps_kadm_kebijakan_subsidi()
    {
        return $this->belongsTo(
            BersediaTidak::class,
            'ps_kadm_kebijakan_subsidi_id'
        );
    }

    public function nomor_kip_memiliki()
    {
        return $this->belongsTo(YaTidak::class, 'nomor_kip_memiliki_id');
    }

    public function tdk_hp()
    {
        return $this->belongsTo(YaTidak::class, 'tdk_hp_id');
    }

    public function belum_nisn()
    {
        return $this->belongsTo(YaTidak::class, 'belum_nisn_id');
    }

    public function kartu_keluarga_sama()
    {
        return $this->belongsTo(
            KartuKeluargaSamaDengan::class,
            'kartu_keluarga_sama_id'
        );
    }

    public function kewarganegaraan()
    {
        return $this->belongsTo(Kewarganegaraan::class);
    }

    public function cita_cita()
    {
        return $this->belongsTo(Cita::class, 'cita_cita_id');
    }

    public function hobi()
    {
        return $this->belongsTo(Hobi::class);
    }

    public function keb_khus()
    {
        return $this->belongsTo(KebutuhanKhusus::class, 'keb_khus_id');
    }

    public function keb_dis()
    {
        return $this->belongsTo(KebutuhanDisabilitas::class, 'keb_dis_id');
    }

    public function bya_sklh()
    {
        return $this->belongsTo(MembiayaiSekolah::class, 'bya_sklh_id');
    }

    public function al_s_stts_tptgl()
    {
        return $this->belongsTo(
            StatusTempatTinggal::class,
            'al_s_stts_tptgl_id'
        );
    }

    public function al_s_jarak()
    {
        return $this->belongsTo(Jarakpp::class, 'al_s_jarak_id');
    }

    public function al_s_transportasi()
    {
        return $this->belongsTo(Transpp::class, 'al_s_transportasi_id');
    }

    public function al_s_waktu_tempuh()
    {
        return $this->belongsTo(Waktutempuh::class, 'al_s_waktu_tempuh_id');
    }

    public function jeniskelamin()
    {
        return $this->belongsTo(Jeniskelamin::class);
    }

    public function ps_kkh_keberadaan()
    {
        return $this->belongsTo(AnandaBerada::class, 'ps_kkh_keberadaan_id');
    }

    public function ps_kkh_medsos_sering()
    {
        return $this->belongsTo(MedsosAnanda::class, 'ps_kkh_medsos_sering_id');
    }

    public function ps_mendaftar_keinginan()
    {
        return $this->belongsTo(
            MendaftarKeinginan::class,
            'ps_mendaftar_keinginan_id'
        );
    }

    public function aktivitaspend()
    {
        return $this->belongsTo(AktivitasPendidikan::class, 'aktivitaspend_id');
    }

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class);
    }

    use log;
}
