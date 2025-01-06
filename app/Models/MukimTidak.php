<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;

class MukimTidak extends Model
{
    public function santris()
    {
        return $this->hasMany(Santri::class, 'al_s_status_mukim_id');
    }

    use log;
}
