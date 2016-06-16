<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Http\Requests;
use App\Habitacion;
use App\Reservacion;

class ReservationController extends Controller
{
    public function reservacion(Request $request, $id) {
        $habitacion = Habitacion::where('idHabitacion', $id)->firstOrFail();
        $hotel = $habitacion->hotel()->first();

        $llegada = new Carbon($request->input('fechaLlegada'));
        $ida = new Carbon($request->input('fechaIda'));

        $request->session()->put('key', $request->input('_token'));
        $request->session()->put('fechaLlegada', $request->input('fechaLlegada'));
        $request->session()->put('fechaIda', $request->input('fechaIda'));
        $request->session()->put('personas', $request->input('personas'));
        $request->session()->put('noches', $ida->diffInDays($llegada));
        $request->session()->put('idHabitacion', $habitacion->idHabitacion);
        $datos = $request->session()->all();

        return view ('reservacion', compact('datos', 'habitacion', 'hotel'));
    }

    public function confirmar(Request $request) {
        $datos = $request->session()->all();
        $fechaActual = Carbon::now()->toDateString();

        $reservacion = new Reservacion(array(
            'idHabitacion' => $datos['idHabitacion'],
            'idUsuario' => $request->user()->id,
            'diaInicio' => $datos['fechaLlegada'],
            'diaFinal' => $datos['fechaIda'],
            'costoTotal' => 400.00,
            'fechaCreacion' => $fechaActual
        ));

        $reservacion->save();

        return redirect('/')->with('status', 'Reservacion creada');
    }
}
