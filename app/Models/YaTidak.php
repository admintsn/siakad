<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;

class YaTidak extends Model
{
    public function santris()
    {
        return $this->hasMany(Santri::class, 'tdk_hp_id');
    }

    public function santris2()
    {
        return $this->hasMany(Santri::class, 'belum_nisn_id');
    }

    public function santris3()
    {
        return $this->hasMany(Santri::class, 'ps_kkh_fasilitas_gawai_id');
    }

    public function santris4()
    {
        return $this->hasMany(Santri::class, 'ps_kkh_medsos_group_id');
    }

    public function santris5()
    {
        return $this->hasMany(Santri::class, 'ps_kkes_sakit_serius_id');
    }

    public function santris6()
    {
        return $this->hasMany(Santri::class, 'ps_kkes_terapi_id');
    }

    public function santris7()
    {
        return $this->hasMany(Santri::class, 'ps_kkes_kambuh_id');
    }

    public function santris8()
    {
        return $this->hasMany(Santri::class, 'ps_kkes_alergi_id');
    }

    public function santris9()
    {
        return $this->hasMany(Santri::class, 'ps_kkes_pantangan_id');
    }

    public function santris10()
    {
        return $this->hasMany(Santri::class, 'ps_kkes_psikologis_id');
    }

    public function santris11()
    {
        return $this->hasMany(Santri::class, 'ps_kkes_gangguan_id');
    }

    public function santris12()
    {
        return $this->hasMany(Santri::class, 'ps_kkm_bak_id');
    }

    public function santris13()
    {
        return $this->hasMany(Santri::class, 'ps_kkm_bab_id');
    }

    public function santris14()
    {
        return $this->hasMany(Santri::class, 'ps_kkm_cebok_id');
    }

    public function santris15()
    {
        return $this->hasMany(Santri::class, 'ps_kkm_ngompol_id');
    }

    public function santris16()
    {
        return $this->hasMany(Santri::class, 'ps_kkm_disuapin_id');
    }

    public function santris17()
    {
        return $this->hasMany(Santri::class, 'nomor_kip_memiliki_id');
    }

    public function walisantris()
    {
        return $this->hasMany(Walisantri::class, 'ak_nama_lengkap_sama_id');
    }

    public function walisantris2()
    {
        return $this->hasMany(Walisantri::class, 'ak_tdk_hp_id');
    }

    public function walisantris3()
    {
        return $this->hasMany(Walisantri::class, 'ak_nomor_handphone_sama_id');
    }

    public function walisantris4()
    {
        return $this->hasMany(Walisantri::class, 'ak_kk_sama_pendaftar_id');
    }

    public function walisantris5()
    {
        return $this->hasMany(Walisantri::class, 'al_ak_tgldi_ln_id');
    }

    public function walisantris6()
    {
        return $this->hasMany(Walisantri::class, 'ik_nama_lengkap_sama_id');
    }

    public function walisantris7()
    {
        return $this->hasMany(Walisantri::class, 'ik_tdk_hp_id');
    }

    public function walisantris8()
    {
        return $this->hasMany(Walisantri::class, 'ik_nomor_handphone_sama_id');
    }

    public function walisantris9()
    {
        return $this->hasMany(Walisantri::class, 'ik_kk_sama_ak_id');
    }

    public function walisantris10()
    {
        return $this->hasMany(Walisantri::class, 'al_ik_sama_ak_id');
    }

    public function walisantris11()
    {
        return $this->hasMany(Walisantri::class, 'ik_kk_sama_pendaftar_id');
    }

    public function walisantris12()
    {
        return $this->hasMany(Walisantri::class, 'al_ik_tgldi_ln_id');
    }

    public function walisantris13()
    {
        return $this->hasMany(Walisantri::class, 'w_nama_lengkap_sama_id');
    }

    public function walisantris14()
    {
        return $this->hasMany(Walisantri::class, 'w_tdk_hp_id');
    }

    public function walisantris15()
    {
        return $this->hasMany(Walisantri::class, 'w_nomor_handphone_sama_id');
    }

    public function walisantris16()
    {
        return $this->hasMany(Walisantri::class, 'w_kk_sama_pendaftar_id');
    }

    public function walisantris17()
    {
        return $this->hasMany(Walisantri::class, 'al_w_tgldi_ln_id');
    }

    public function walisantris18()
    {
        return $this->hasMany(Walisantri::class, 'ik_kajian_sama_ak_id');
    }

    public function walisantris19()
    {
        return $this->hasMany(Walisantri::class, 'is_kk_baru_id');
    }

    use log;
}
