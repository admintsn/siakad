<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class MudirQism extends Model
{
    public function pengajar()
    {
        return $this->belongsTo(Pengajar::class);
    }

    public function qism()
    {
        return $this->belongsTo(Qism::class);
    }

    use log;
}
