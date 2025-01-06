<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;

class StatSantri extends Model
{
    public function statusSantris()
    {
        return $this->hasMany(StatusSantri::class);
    }

    use log;
}
