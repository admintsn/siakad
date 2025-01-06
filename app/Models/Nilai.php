<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Nilai extends Model
{

    public function mahad()
    {
        return $this->belongsTo(Mahad::class);
    }

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

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class);
    }

    public function tahunBerjalan()
    {
        return $this->belongsTo(TahunBerjalan::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class);
    }

    public function pengajar()
    {
        return $this->belongsTo(Pengajar::class);
    }

    public function staffAdmin()
    {
        return $this->belongsTo(StaffAdmin::class);
    }

    public function jenisSoal()
    {
        return $this->belongsTo(JenisSoal::class);
    }

    public function kategoriSoal()
    {
        return $this->belongsTo(KategoriSoal::class);
    }

    public function semesterBerjalan()
    {
        return $this->belongsTo(SemesterBerjalan::class);
    }

    use log;
}
