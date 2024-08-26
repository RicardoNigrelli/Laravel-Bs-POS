<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoría extends Model
{
    use HasFactory;

    public function productos(){
        return $this->belongsToMany(Producto::class)->withTimestamps();
    }

     public function característica () {
        return $this->belongsTo(Característica::class);
    }
}
