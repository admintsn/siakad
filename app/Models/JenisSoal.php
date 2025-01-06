<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class JenisSoal extends Model
{

    public function nilais()
    {
        return $this->hasMany(Nilai::class);
    }

    public function mapels()
    {
        return $this->hasMany(Mapel::class);
    }

    public function mapelQisms()
    {
        return $this->hasMany(MapelQism::class);
    }

    use log;
}
