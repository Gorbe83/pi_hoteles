<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    protected $table = "ciudad";

    public function hoteles() {
        return $this->hasMany('App\Hotel', 'idCiudad', 'idCiudad');
    }
}
