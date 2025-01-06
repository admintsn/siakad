<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Peletakangelarpf extends Model
{
    public function pendidikanformals()
    {
        return $this->hasMany(Pendidikanformal::class);
    }

    use log;
}
