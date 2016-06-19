<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservacion extends Model
{
    protected $table = "reservacion";
    public $timestamps = false;
    protected $guarded = ['idReservacion'];
    protected $primaryKey = "idReservacion";
    public $incrementing = false;

    public function habitacion() {
        return $this->belongsTo('App\Habitacion', 'idHabitacion', 'idHabitacion');
    }

    public function movimientos() {
        return $this->hasMany('App\Movimiento', 'idReservacion', 'idReservacion');
    }
}
