<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Kecamatan extends Model
{
    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class);
    }

    public function kelurahans()
    {
        return $this->hasMany(Kelurahan::class);
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
        return $this->hasMany(Walisantri::class, 'al_ak_kecamatan_id');
    }

    public function al_ik_walisantris()
    {
        return $this->hasMany(Walisantri::class, 'al_ik_kecamatan_id');
    }

    public function al_w_walisantris()
    {
        return $this->hasMany(Walisantri::class, 'al_w_kecamatan_id');
    }

    use log;
}
