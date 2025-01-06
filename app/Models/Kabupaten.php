<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Kabupaten extends Model
{
    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class);
    }

    public function kecamatans()
    {
        return $this->hasMany(Kecamatan::class);
    }

    public function allKodepos()
    {
        return $this->hasMany(Kodepos::class);
    }

    public function mahads()
    {
        return $this->hasMany(Mahad::class);
    }

    public function santris()
    {
        return $this->hasMany(Santri::class);
    }

    public function al_ak_walisantris()
    {
        return $this->hasMany(Walisantri::class, 'al_ak_kabupaten_id');
    }

    public function al_ik_walisantris()
    {
        return $this->hasMany(Walisantri::class, 'al_ik_kabupaten_id');
    }

    public function al_w_walisantris()
    {
        return $this->hasMany(Walisantri::class, 'al_w_kabupaten_id');
    }

    public function pendidikanpesantrens()
    {
        return $this->hasMany(Pendidikanpesantren::class);
    }

    use log;
}
