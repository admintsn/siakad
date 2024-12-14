<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Pendidikanformal extends Model
{
    protected $casts = [
        'tahun_masuk_pf' => 'date',
        'tahun_lulus_pf' => 'date',
        'tanggal_ijazah_pf' => 'date',
        'is_active' => 'boolean',
    ];

    public function pengajar()
    {
        return $this->belongsTo(Pengajar::class);
    }

    public function pendidikanTerakhirWalisantri()
    {
        return $this->belongsTo(PendidikanTerakhirWalisantri::class);
    }

    public function statuspf()
    {
        return $this->belongsTo(Statuspf::class);
    }

    public function jenispf()
    {
        return $this->belongsTo(Jenispf::class);
    }

    public function jurusanpf()
    {
        return $this->belongsTo(Jurusanpf::class);
    }

    public function peletakangelarpf()
    {
        return $this->belongsTo(Peletakangelarpf::class);
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
