<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presentacione extends Model
{
    use HasFactory;

    public function productos(){
        return $this->hasMany(Producto::class);
    }

     public function característica () {
        return $this->belongsTo(Característica::class);
    }
}
