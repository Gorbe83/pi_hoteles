<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Http\Requests;
use App\Hotel;
use App\Ciudad;

class HotelsController extends Controller
{
    public function busqueda(Request $request) {
        $ciudad = Ciudad::where('nombre', $request->input('ciudad'))->firstOrFail();
        $hoteles = DB::table('hotel')
            ->select(DB::raw('idHotel, nombre, estrellas, telefono, direccion, menorPrecioDisponible(idHotel, '.$request->input('fechaLlegada').', '.$request->input('fechaIda').', '.$request->input('personas').') as menorPrecio'))
            ->where('idCiudad', '=', $ciudad->idCiudad)
            ->get();

        $datosBusqueda = array(
            'ciudad' => $request->input('ciudad'),
            'fechaLlegada' => $request->input('fechaLlegada'),
            'fechaIda' => $request->input('fechaIda'),
            'personas' => $request->input('personas'),
            'cuartos' => $request->input('cuartos')
        );
        return view ('busqueda')->with('hoteles', $hoteles)->with('datosBusqueda', $datosBusqueda);
    }

    public function hotel(Request $request, $id) {
        $hotel = Hotel::where('idHotel', $id)->firstOrFail();
        $habitaciones = $hotel->habitaciones()->get();
        $datosBusqueda = array(
            'fechaLlegada' => $request->input('fechaLlegada'),
            'fechaIda' => $request->input('fechaIda'),
            'personas' => $request->input('personas'),
            'cuartos' => $request->input('cuartos'),
            'precioMenor' => $request->input('precioMenor')
        );
        return view ('hotel', compact('hotel', 'habitaciones', 'datosBusqueda'));
    }

    public function mostrar() {

    }
}
