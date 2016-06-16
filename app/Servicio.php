<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    protected $table="servicio";
    protected $primaryKey = 'idServicio';

    public function habitaciones() {
        return $this->belongsToMany('App\Habitaciones', 'asignacion_servicio', 'idServicio', 'idHabitacion');
    }

}
