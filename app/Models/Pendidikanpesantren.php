<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Pendidikanpesantren extends Model
{
    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_lulus' => 'date',
        'is_active' => 'boolean',
    ];

    public function statuspp()
    {
        return $this->belongsTo(Statuspp::class);
    }

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class);
    }

    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class);
    }

    public function mahad()
    {
        return $this->belongsTo(Mahad::class);
    }

    public function konsentrasipp()
    {
        return $this->belongsTo(Konsentrasipp::class);
    }

    public function pengajar()
    {
        return $this->belongsTo(Pengajar::class);
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