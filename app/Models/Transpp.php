<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Transpp extends Model
{
    public function pengajars()
    {
        return $this->hasMany(Pengajar::class);
    }

    public function santris()
    {
        return $this->hasMany(Santri::class, 'al_s_transportasi_id');
    }

    use log;
}
