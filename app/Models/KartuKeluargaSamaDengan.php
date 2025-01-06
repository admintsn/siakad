<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class KartuKeluargaSamaDengan extends Model
{
    public function santris()
    {
        return $this->hasMany(Santri::class, 'kartu_keluarga_sama_id');
    }

    use log;
}
