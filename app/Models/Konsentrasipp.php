<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Konsentrasipp extends Model
{
    public function pendidikanpesantrens()
    {
        return $this->hasMany(Pendidikanpesantren::class);
    }

    use log;
}
