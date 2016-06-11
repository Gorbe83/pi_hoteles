<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Hotel;

class HotelsController extends Controller
{
    public function busqueda(Request $request) {
        $hoteles = Hotel::where('ciudad', $request->input('ciudad'))->get(); //cambiar por la verdadera consulta SQL
        $datosBusqueda = array(
            'ciudad' => $request->input('ciudad'),
            'fechaLlegada' => $request->input('fechaLlegada'),
            'fechaIda' => $request->input('fechaIda'),
            'adultos' => $request->input('adultos'),
            'ninos' => $request->input('ninos'),
            'cuartos' => $request->input('cuartos')
        );
        return view ('busqueda')->with('hoteles', $hoteles)->with('datosBusqueda', $datosBusqueda);
    }

    public function hotel($id) {
        $hotel = Hotel::where('idHotel', $id)->firstOrFail();
        $habitaciones = $hotel->habitaciones()->get();
        return view ('hotel', compact('hotel', 'habitaciones'));
    }

    public function mostrar() {

    }
}
