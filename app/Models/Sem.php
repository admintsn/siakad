<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Sem extends Model
{
    public function semesters()
    {
        return $this->hasMany(Semester::class);
    }

    public function semesters2()
    {
        return $this->hasMany(Semester::class, 'sem_s');
    }

    use log;
}
