<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;

class JumlahPendaftar extends Model
{
    public function qism()
    {
        return $this->belongsTo(Qism::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    use log;
}
