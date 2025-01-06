<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class StatusAdmPendaftar extends Model
{
    public function santris2()
    {
        return $this->hasMany(Santri::class, 'ps_kadm_status_id');
    }

    use log;
}
