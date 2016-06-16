<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservacion extends Model
{
    protected $table = "reservacion";
    public $timestamps = false;
    protected $guarded = ['idReservacion'];
}
