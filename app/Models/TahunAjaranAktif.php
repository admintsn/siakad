<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class TahunAjaranAktif extends Model
{
    public function qism()
    {
        return $this->belongsTo(Qism::class);
    }

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function sem()
    {
        return $this->belongsTo(Sem::class,'semester_id');
    }

    use log;
}
