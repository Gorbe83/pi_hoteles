<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Habitacion extends Model
{
    protected $table = "habitacion";

    public function hotel() {
        return $this->belongsTo('App\Hotel', 'idHotel', 'idHotel');
    }
}
