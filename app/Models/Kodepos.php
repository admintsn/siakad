<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Kodepos extends Model
{
    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class);
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }

    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class);
    }

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class);
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
        return $this->hasMany(Walisantri::class, 'al_ak_kodepos_id');
    }

    public function al_ik_walisantris()
    {
        return $this->hasMany(Walisantri::class, 'al_ik_kodepos_id');
    }

    public function al_w_walisantris()
    {
        return $this->hasMany(Walisantri::class, 'al_w_kodepos_id');
    }

    use log;
}
