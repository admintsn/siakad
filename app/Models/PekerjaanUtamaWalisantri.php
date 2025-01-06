<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class PekerjaanUtamaWalisantri extends Model
{
    public function walisantris()
    {
        return $this->hasMany(Walisantri::class, 'ak_pekerjaan_utama_id');
    }

    public function walisantris2()
    {
        return $this->hasMany(Walisantri::class, 'ik_pekerjaan_utama_id');
    }

    public function walisantris3()
    {
        return $this->hasMany(Walisantri::class, 'w_pekerjaan_utama_id');
    }

    use log;
}
