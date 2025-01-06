<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Panelrole extends Model
{
    public function users()
    {
        return $this->hasMany(User::class);
    }

    use log;
}
