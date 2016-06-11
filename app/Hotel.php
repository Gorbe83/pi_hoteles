<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $table = "hotel";

    public function habitaciones() {
        return $this->hasMany('App\Habitacion', 'idHotel', 'idHotel');
    }
}
