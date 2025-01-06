<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Jeniskelamin extends Model
{
    public function qismDetails()
    {
        return $this->hasMany(QismDetail::class);
    }

    public function pengajars()
    {
        return $this->hasMany(Pengajar::class);
    }

    public function santris()
    {
        return $this->hasMany(Santri::class);
    }

    use log;
}
