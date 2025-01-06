<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class KelasSantri extends Model
{
    public function walisantri()
    {
        return $this->belongsTo(Walisantri::class);
    }

    public function mahad()
    {
        return $this->belongsTo(Mahad::class);
    }

    public function qism()
    {
        return $this->belongsTo(Qism::class);
    }

    public function qism_detail()
    {
        return $this->belongsTo(QismDetail::class);
    }

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function santri()
    {
        return $this->belongsTo(Santri::class);
    }

    public function tahun_berjalan()
    {
        return $this->belongsTo(TahunBerjalan::class);
    }

    public function statusSantris()
    {
        return $this->hasMany(StatusSantri::class);
    }

    public function statussantri()
    {
        return $this->hasOne(StatusSantri::class, 'santri_id', 'santri_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'username', 'kartu_keluarga');
    }

    public function semesterBerjalan()
    {
        return $this->belongsTo(SemesterBerjalan::class);
    }

    use log;
}
