<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class KeteranganStatusSantri extends Model
{
    public function statusSantris()
    {
        return $this->hasMany(StatusSantri::class);
    }

    public function statussantri()
    {
        return $this->hasOne(StatusSantri::class);
    }

    use log;
}
