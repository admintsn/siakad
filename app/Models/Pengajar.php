<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Pengajar extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mapels()
    {
        return $this->hasMany(Mapel::class);
    }

    public function mudirQism()
    {
        return $this->hasOne(MudirQism::class);
    }

    public function statuskepegawaian()
    {
        return $this->belongsTo(Statuskepegawaian::class);
    }

    public function golongandarah()
    {
        return $this->belongsTo(Golongandarah::class);
    }

    public function jeniskelamin()
    {
        return $this->belongsTo(Jeniskelamin::class);
    }

    public function statuskepemilikanrumah()
    {
        return $this->belongsTo(Statuskepemilikanrumah::class);
    }

    public function transpp()
    {
        return $this->belongsTo(Transpp::class);
    }

    public function jarakpp()
    {
        return $this->belongsTo(Jarakpp::class);
    }

    public function waktutempuh()
    {
        return $this->belongsTo(Waktutempuh::class);
    }

    public function statusperkawinan()
    {
        return $this->belongsTo(Statusperkawinan::class);
    }

    public function pendidikanpesantrens()
    {
        return $this->hasMany(Pendidikanpesantren::class);
    }

    public function pendidikanformals()
    {
        return $this->hasMany(Pendidikanformal::class);
    }

    use log;
}
