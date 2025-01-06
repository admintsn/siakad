<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class StaffAdmin extends Model
{
    public function nilais()
    {
        return $this->hasMany(Nilai::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    use log;
}
