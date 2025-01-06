<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class MedsosAnanda extends Model
{
    public function santris()
    {
        return $this->hasMany(Santri::class, 'ps_kkh_medsos_sering_id');
    }

    use log;
}
