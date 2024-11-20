<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarjeta extends Model
{
    use HasFactory;

    public function cuenta() {
        return $this->belongsTo(Cuenta::class);
    }
    public function movimientos() {
        return $this->hasMany(Movimiento::class);
    }
    public function cliente() {
        return $this->belongsToThrough(Cliente::class, Cuenta::class);
    }

}

/*
 * https://github.com/staudenmeir/belongs-to-through
 *      composer require staudenmeir/belongs-to-through:"^2.5"
 *      use \Znck\Eloquent\Traits\BelongsToThrough;
 *      se puede usar belongsToThrough
 */