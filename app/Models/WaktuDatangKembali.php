<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class WaktuDatangKembali extends Model
{
    public function pesanDaftars()
    {
        return $this->hasMany(PesanDaftar::class, 'waktu_datang');
    }

    public function pesanDaftars2()
    {
        return $this->hasMany(PesanDaftar::class, 'waktu_kembali');
    }

    public function walisantris()
    {
        return $this->hasMany(Walisantri::class, 'waktu_datang');
    }

    public function walisantris2()
    {
        return $this->hasMany(Walisantri::class, 'waktu_kembali');
    }

    use log;
}
