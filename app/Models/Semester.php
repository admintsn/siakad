<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Semester extends Model
{
    public function qism()
    {
        return $this->belongsTo(Qism::class);
    }

    public function kelasSantris()
    {
        return $this->hasMany(KelasSantri::class);
    }

    public function tahunAjaranAktifs()
    {
        return $this->hasMany(TahunAjaranAktif::class);
    }

    public function sem()
    {
        return $this->belongsTo(Sem::class);
    }

    public function sem_sels()
    {
        return $this->belongsTo(Sem::class, 'sem_sel');
    }

    use log;
}
