<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;

class MenginapTidak extends Model
{
    public function walisantris()
    {
        return $this->hasMany(Walisantri::class);
    }

    use log;
}
