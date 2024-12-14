<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Santri extends Model
{
    public function walisantri()
    {
        return $this->belongsTo(Walisantri::class);
    }

    public function ws()
    {
        return $this->hasOne(Walisantri::class);
    }

    public function kelasSantris()
    {
        return $this->hasMany(KelasSantri::class);
    }

    public function kelassantri()
    {
        return $this->hasOne(KelasSantri::class);
    }

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class);
    }

    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class);
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }

    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class);
    }

    public function kodepos()
    {
        return $this->belongsTo(Kodepos::class);
    }

    public function statusSantris()
    {
        return $this->hasMany(StatusSantri::class);
    }

    public function statussantri()
    {
        return $this->hasOne(StatusSantri::class);
    }

    public function pendaftar()
    {
        return $this->hasOne(Pendaftar::class);
    }

    public function pendaftars()
    {
        return $this->hasMany(Pendaftar::class);
    }

    public function qism_detail()
    {
        return $this->belongsTo(QismDetail::class);
    }

    public function kss()
    {
        return $this->belongsTo(KeteranganStatusSantri::class);
    }

    public function kartuKeluargaSamaDengan()
    {
        return $this->belongsTo(KartuKeluargaSamaDengan::class);
    }

    public function cita()
    {
        return $this->belongsTo(Cita::class);
    }

    public function hobi()
    {
        return $this->belongsTo(Hobi::class);
    }

    public function kebutuhanKhusus()
    {
        return $this->belongsTo(KebutuhanKhusus::class);
    }

    public function kebutuhanDisabilitas()
    {
        return $this->belongsTo(KebutuhanDisabilitas::class);
    }

    public function membiayaiSekolah()
    {
        return $this->belongsTo(MembiayaiSekolah::class);
    }

    public function mendaftarKeinginan()
    {
        return $this->belongsTo(MendaftarKeinginan::class);
    }

    public function hafalan()
    {
        return $this->belongsTo(Hafalan::class);
    }

    public function statusTempatTinggal()
    {
        return $this->belongsTo(StatusTempatTinggal::class);
    }

    public function anandaBerada()
    {
        return $this->belongsTo(AnandaBerada::class);
    }

    public function medsosAnanda()
    {
        return $this->belongsTo(MedsosAnanda::class);
    }

    public function jeniskelamin()
    {
        return $this->belongsTo(Jeniskelamin::class);
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

    public function nomorSurats()
    {
        return $this->hasMany(NomorSurat::class);
    }

    public static function boot()
    {
        parent::boot();
        $user = Auth::user();

        if ($user === null) {
            return;
        } else {

            static::creating(function ($model) {
                $user = Auth::user();
                $model->created_by = $user->username;
                $model->updated_by = $user->username;
            });
            static::updating(function ($model) {
                $user = Auth::user();
                $model->updated_by = $user->username;
            });
        }
    }
}
