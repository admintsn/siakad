<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class StatusTempatTinggal extends Model
{
    public function walisantris()
    {
        return $this->hasMany(Walisantri::class);
    }

    public function santris()
    {
        return $this->hasMany(Santri::class, 'al_s_stts_tptgl_id');
    }

    use log;
}
