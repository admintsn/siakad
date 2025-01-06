<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Pendaftar extends Model
{
    protected $casts = [
        'ps_kkh_medsos_sering' => 'array',
    ];

    public function santri()
    {
        return $this->belongsTo(Santri::class);
    }

    use log;
}
