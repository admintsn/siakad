<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;

class AktivitasPendidikan extends Model
{
    public function santris()
    {
        return $this->hasMany(Santri::class, 'aktivitaspend_id');
    }

    use log;
}
