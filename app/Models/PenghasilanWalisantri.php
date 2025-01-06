<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class PenghasilanWalisantri extends Model
{
    public function walisantris()
    {
        return $this->hasMany(Walisantri::class, 'ak_pghsln_rt_id');
    }

    public function walisantris2()
    {
        return $this->hasMany(Walisantri::class, 'ik_pghsln_rt_id');
    }

    public function walisantris3()
    {
        return $this->hasMany(Walisantri::class, 'w_pghsln_rt_id');
    }

    use log;
}
