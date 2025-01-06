<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class TahunBerjalan extends Model
{
    public function kelasSantris()
    {
        return $this->hasMany(KelasSantri::class);
    }

    public function pesandaftar()
    {
        return $this->belongsTo(PesanDaftar::class);
    }

    use log;
}
