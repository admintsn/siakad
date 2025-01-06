<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class MembiayaiSekolah extends Model
{
    public function santris()
    {
        return $this->hasMany(Santri::class, 'bya_sklh_id');
    }

    use log;
}
