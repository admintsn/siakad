<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class TahunAjaran extends Model
{
    public function kelasSantris()
    {
        return $this->hasMany(KelasSantri::class);
    }

    public function tahunAjaranAktifs()
    {
        return $this->hasMany(TahunAjaranAktif::class);
    }

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class);
    }

    public function tahunAjarans()
    {
        return $this->hasMany(TahunAjaran::class);
    }

    public function santris()
    {
        return $this->hasMany(Santri::class);
    }

    use log;
}
