<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;

class StatusWali extends Model
{
    public function walisantris()
    {
        return $this->hasMany(Walisantri::class, 'w_status_id');
    }

    use log;
}
