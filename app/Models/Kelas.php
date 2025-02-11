<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Kelas extends Model
{
    public function kelasSantris()
    {
        return $this->hasMany(KelasSantri::class);
    }

    public function jumlahPendaftars()
    {
        return $this->hasMany(JumlahPendaftar::class);
    }

    use log;

}
