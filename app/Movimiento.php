<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    protected $table = "movimiento";
    public $timestamps = false;
    protected $guarded = ['idMovimiento'];

    public function reservacion() {
        return $this->belongsTo('App\Reservacion', 'idReservacion', 'idReservacion');
    }
}
