<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Waktutempuh extends Model
{
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
