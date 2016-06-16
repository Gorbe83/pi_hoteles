<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Habitacion extends Model
{
    protected $table = "habitacion";
    protected $primaryKey = 'idHabitacion';

    public function hotel() {
        return $this->belongsTo('App\Hotel', 'idHotel', 'idHotel');
    }

    public function regimen_alimenticio() {
        return $this->belongsTo('App\RegimenAlimenticio', 'idRegimenAlimenticio', 'idRegimenAlimenticio');
    }

    public function servicios() {
        return $this->belongsToMany('App\Servicio', 'asignacion_servicio', 'idHabitacion', 'idServicio');
    }
}
