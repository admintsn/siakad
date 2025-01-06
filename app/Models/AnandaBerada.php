<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class AnandaBerada extends Model
{
    public function santris()
    {
        return $this->hasMany(Santri::class, 'ps_kkh_keberadaan_id');
    }

    use log;
}
