<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Kelurahan extends Model
{
    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
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
        return $this->hasMany(Walisantri::class, 'al_ak_kelurahan_id');
    }

    public function al_ik_walisantris()
    {
        return $this->hasMany(Walisantri::class, 'al_ik_kelurahan_id');
    }

    public function al_w_walisantris()
    {
        return $this->hasMany(Walisantri::class, 'al_w_kelurahan_id');
    }

    use log;
}
