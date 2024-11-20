<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model
{
    use HasFactory;

    public function tarjetas () {
        return $this->hasMany(Tarjeta::class);
    }
    public function cliente() {
        return $this->belongsTo(Cliente::class);
    }
}    

