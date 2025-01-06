<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class BersediaTidak extends Model
{
    public function santris()
    {
        return $this->hasMany(
            Santri::class,
            'ps_kkh_fasilitas_gawai_medsos_menutup_id'
        );
    }

    public function santris2()
    {
        return $this->hasMany(Santri::class, 'ps_kadm_surat_subsidi_id');
    }

    public function santris3()
    {
        return $this->hasMany(Santri::class, 'ps_kadm_surat_kurang_mampu_id');
    }

    public function santris4()
    {
        return $this->hasMany(Santri::class, 'ps_kadm_atur_keuangan_id');
    }

    public function santris5()
    {
        return $this->hasMany(Santri::class, 'ps_kadm_penentuan_subsidi_id');
    }

    public function santris6()
    {
        return $this->hasMany(Santri::class, 'ps_kadm_hidup_sederhana_id');
    }

    public function santris7()
    {
        return $this->hasMany(Santri::class, 'ps_kadm_kebijakan_subsidi_id');
    }
    
    use log;
}
