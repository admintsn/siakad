<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class JumlahSantri extends Model
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
