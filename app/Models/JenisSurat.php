<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class JenisSurat extends Model
{
    public function nomorSurats()
    {
        return $this->hasMany(NomorSurat::class);
    }

    use log;
}
