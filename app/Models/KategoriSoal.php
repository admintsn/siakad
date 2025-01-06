<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class KategoriSoal extends Model
{
    public function qism()
    {
        return $this->belongsTo(Qism::class);
    }

    public function mahad()
    {
        return $this->belongsTo(Mahad::class);
    }

    public function qismDetail()
    {
        return $this->belongsTo(QismDetail::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function nilais()
    {
        return $this->hasMany(Nilai::class);
    }

    public function mapels()
    {
        return $this->hasMany(Mapel::class);
    }

    public function mapelQisms()
    {
        return $this->hasMany(MapelQism::class);
    }

    use log;
}
