<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;

class HubunganWali extends Model
{
    public function walisantris()
    {
        return $this->hasMany(Walisantri::class, 'w_hubungan_id');
    }

    use log;
}
