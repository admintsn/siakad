<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class PendidikanTerakhirWalisantri extends Model
{
    public function pendidikanformals()
    {
        return $this->hasMany(Pendidikanformal::class);
    }

    public function walisantris()
    {
        return $this->hasMany(Walisantri::class, 'ak_pend_terakhir_id');
    }

    public function walisantris2()
    {
        return $this->hasMany(Walisantri::class, 'ik_pend_terakhir_id');
    }

    public function walisantris3()
    {
        return $this->hasMany(Walisantri::class, 'w_pend_terakhir_id');
    }

    use log;
}
