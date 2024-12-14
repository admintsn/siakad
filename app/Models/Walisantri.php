<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Walisantri extends Model
{
    public function santris()
    {
        return $this->hasMany(Santri::class);
    }

    public function pesanDaftars()
    {
        return $this->hasMany(PesanDaftar::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function al_ak_provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'al_ak_provinsi_id');
    }

    public function al_ak_kabupaten()
    {
        return $this->belongsTo(Kabupaten::class, 'al_ak_kabupaten_id');
    }

    public function al_ak_kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'al_ak_kecamatan_id');
    }

    public function al_ak_kelurahan()
    {
        return $this->belongsTo(Kelurahan::class, 'al_ak_kelurahan_id');
    }

    public function al_ak_kodepos()
    {
        return $this->belongsTo(Kodepos::class, 'al_ak_kodepos_id');
    }

    public function al_ik_provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'al_ik_provinsi_id');
    }

    public function al_ik_kabupaten()
    {
        return $this->belongsTo(Kabupaten::class, 'al_ik_kabupaten_id');
    }

    public function al_ik_kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'al_ik_kecamatan_id');
    }

    public function al_ik_kelurahan()
    {
        return $this->belongsTo(Kelurahan::class, 'al_ik_kelurahan_id');
    }

    public function al_ik_kodepos()
    {
        return $this->belongsTo(Kodepos::class, 'al_ik_kodepos_id');
    }

    public function al_w_provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'al_w_provinsi_id');
    }

    public function al_w_kabupaten()
    {
        return $this->belongsTo(Kabupaten::class, 'al_w_kabupaten_id');
    }

    public function al_w_kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'al_w_kecamatan_id');
    }

    public function al_w_kelurahan()
    {
        return $this->belongsTo(Kelurahan::class, 'al_w_kelurahan_id');
    }

    public function al_w_kodepos()
    {
        return $this->belongsTo(Kodepos::class, 'al_w_kodepos_id');
    }

    public function kelasSantris()
    {
        return $this->hasMany(KelasSantri::class);
    }

    public function statussantris()
    {
        return $this->hasOne(StatusSantri::class, Santri::class);
    }

    public function statusWalisantri()
    {
        return $this->belongsTo(StatusWalisantri::class);
    }

    public function kewarganegaraan()
    {
        return $this->belongsTo(Kewarganegaraan::class);
    }

    public function pendidikanTerakhirWalisantri()
    {
        return $this->belongsTo(PendidikanTerakhirWalisantri::class);
    }

    public function pekerjaanUtamaWalisantri()
    {
        return $this->belongsTo(PekerjaanUtamaWalisantri::class);
    }

    public function penghasilanWalisantri()
    {
        return $this->belongsTo(PenghasilanWalisantri::class);
    }

    public function statuskepemilikanrumah()
    {
        return $this->belongsTo(Statuskepemilikanrumah::class);
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
