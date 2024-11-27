<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    use HasFactory;

    public function tarjeta () {
        return $this->belongsTo(Tarjeta::class);
    }

    public function cuenta() {
        return $this->belongsToThrough(Cuenta::class, Tarjeta::class);
    }

    // Esta funcion la he creado para coger directamente al cliente que hace el movimiento
    public function Cliente() {
        return $this->cuenta->cliente()->get()->first();
    }    
}
