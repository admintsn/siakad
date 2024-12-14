<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class QismDetail extends Model
{
    public function kelasSantris()
    {
        return $this->hasMany(KelasSantri::class);
    }

    public function qism()
    {
        return $this->belongsTo(Qism::class);
    }

    public function nilais()
    {
        return $this->hasMany(Nilai::class);
    }

    public function jeniskelamin()
    {
        return $this->belongsTo(Jeniskelamin::class);
    }

    public function qismDetail()
    {
        return $this->belongsTo(QismDetail::class);
    }

    public function qismDetails()
    {
        return $this->hasMany(QismDetail::class);
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
