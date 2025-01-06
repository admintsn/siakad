<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class NomorSurat extends Model
{
    protected $casts = [
        'is_confirned' => 'boolean',
        'is_printed' => 'boolean',
        'is_signed' => 'boolean',
        'is_scanned' => 'boolean',
        'is_sent' => 'boolean',
        'is_needrevise' => 'boolean',
        'is_revised' => 'boolean',
    ];

    public function mahad()
    {
        return $this->belongsTo(Mahad::class);
    }

    public function qism()
    {
        return $this->belongsTo(Qism::class);
    }

    public function tujuanSurat()
    {
        return $this->belongsTo(TujuanSurat::class);
    }

    public function jenisSurat()
    {
        return $this->belongsTo(JenisSurat::class);
    }

    public function tahunhberjalan()
    {
        return $this->belongsTo(Tahunhberjalan::class);
    }

    public function tahunmberjalan()
    {
        return $this->belongsTo(Tahunmberjalan::class);
    }

    public function santri()
    {
        return $this->belongsTo(Santri::class);
    }

    public function lembagaSurat()
    {
        return $this->belongsTo(LembagaSurat::class);
    }

    use log;
}
