<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Mapel extends Model
{
    public function pengajar()
    {
        return $this->belongsTo(Pengajar::class);
    }

    public function jenisSoal()
    {
        return $this->belongsTo(JenisSoal::class);
    }

    public function kategoriSoal()
    {
        return $this->belongsTo(KategoriSoal::class);
    }

    public function qismDetails()
    {
        return $this->belongsToMany(QismDetail::class);
    }

    use log;
}
