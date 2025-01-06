<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Qism extends Model
{
    public function kelasSantris()
    {
        return $this->hasMany(KelasSantri::class);
    }

    public function mudirQism()
    {
        return $this->hasOne(MudirQism::class);
    }

    public function tahunAjaranAktifs()
    {
        return $this->hasMany(TahunAjaranAktif::class);
    }

    public function semesters()
    {
        return $this->hasMany(Semester::class);
    }

    public function nomorSurats()
    {
        return $this->hasMany(NomorSurat::class);
    }

    public function qismDetailHasKelas_s()
    {
        return $this->hasMany(QismDetailHasKelas::class, 'id', 'qism_s');
    }

    public function mapelQisms()
    {
        return $this->hasMany(MapelQism::class);
    }

    use log;
}
