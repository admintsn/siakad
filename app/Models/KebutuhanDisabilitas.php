<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class KebutuhanDisabilitas extends Model
{
    public function santris()
    {
        return $this->hasMany(Santri::class, 'keb_dis_id');
    }

    use log;
}
