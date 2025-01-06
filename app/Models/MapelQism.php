<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class MapelQism extends Model
{
    public function qism()
    {
        return $this->belongsTo(Qism::class);
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class);
    }

    public function jenisSoal()
    {
        return $this->belongsTo(JenisSoal::class);
    }

    public function kategoriSoal()
    {
        return $this->belongsTo(KategoriSoal::class);
    }

    use log;
}
