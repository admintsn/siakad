<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Statuskepemilikanrumah extends Model
{
    public function walisantris()
    {
        return $this->hasMany(Walisantri::class, 'al_ak_stts_rmh_id');
    }

    public function walisantris2()
    {
        return $this->hasMany(Walisantri::class, 'al_ik_stts_rmh_id');
    }

    public function walisantris3()
    {
        return $this->hasMany(Walisantri::class, 'al_w_stts_rmh_id');
    }

    public function pengajars()
    {
        return $this->hasMany(Pengajar::class);
    }

    use log;
}
