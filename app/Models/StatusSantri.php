<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class StatusSantri extends Model
{
    public function kss()
    {
        return $this->belongsTo(KeteranganStatusSantri::class);
    }

    public function santri()
    {
        return $this->belongsTo(Santri::class);
    }

    public function statSantri()
    {
        return $this->belongsTo(StatSantri::class);
    }

    use log;
}
