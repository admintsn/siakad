<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class StatusWalisantri extends Model
{
    public function walisantris()
    {
        return $this->hasMany(Walisantri::class, 'ak_status_id');
    }

    public function walisantris2()
    {
        return $this->hasMany(Walisantri::class, 'ik_status_id');
    }

    use log;
}
