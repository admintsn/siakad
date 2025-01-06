<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class QismDetailHasKelas extends Model
{
    public function qism()
    {
        return $this->belongsTo(Qism::class);
    }

    public function qismDetail()
    {
        return $this->belongsTo(QismDetail::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function qism_ss()
    {
        return $this->belongsTo(Qism::class, 'qism_s');
    }

    public function qismDetail_ss()
    {
        return $this->belongsTo(QismDetail::class, 'qism_detail_s');
    }

    public function kelas_ss()
    {
        return $this->belongsTo(Kelas::class, 'kelas_s');
    }

    use log;
}
