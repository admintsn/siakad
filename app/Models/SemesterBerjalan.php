<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class SemesterBerjalan extends Model
{
    public function nilais()
    {
        return $this->hasMany(Nilai::class);
    }

    public function kelasSantris()
    {
        return $this->hasMany(KelasSantri::class);
    }

    use log;
}
