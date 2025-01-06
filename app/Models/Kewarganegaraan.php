<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Kewarganegaraan extends Model
{
    public function walisantris()
    {
        return $this->hasMany(Walisantri::class, 'ak_kewarganegaraan_id');
    }

    public function walisantris2()
    {
        return $this->hasMany(Walisantri::class, 'ik_kewarganegaraan_id');
    }

    public function walisantris3()
    {
        return $this->hasMany(Walisantri::class, 'w_kewarganegaraan_id');
    }

    public function santris4()
    {
        return $this->hasMany(Santri::class, 'kewarganegaraan_id');
    }

    use log;
}
