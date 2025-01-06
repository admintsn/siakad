<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Golongandarah extends Model
{
    public function pengajars()
    {
        return $this->hasMany(Pengajar::class);
    }

    use log;
}
