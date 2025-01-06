<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class MendaftarKeinginan extends Model
{
    public function santris()
    {
        return $this->hasMany(Santri::class, 'ps_mendaftar_keinginan_id');
    }

    use log;
}
