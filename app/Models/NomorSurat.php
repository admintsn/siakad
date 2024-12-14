<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class NomorSurat extends Model
{
    public function mahad()
    {
        return $this->belongsTo(Mahad::class);
    }

    public function qism()
    {
        return $this->belongsTo(Qism::class);
    }

    public function tujuanSurat()
    {
        return $this->belongsTo(TujuanSurat::class);
    }

    public function jenisSurat()
    {
        return $this->belongsTo(JenisSurat::class);
    }

    public function tahunhberjalan()
    {
        return $this->belongsTo(Tahunhberjalan::class);
    }

    public function tahunmberjalan()
    {
        return $this->belongsTo(Tahunmberjalan::class);
    }

    public function santri()
    {
        return $this->belongsTo(Santri::class);
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
