<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PreReservacionRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Carbon\Carbon;

use DB;
use App\Http\Requests;
use App\Habitacion;
use App\Reservacion;
use App\Movimiento;

class ReservationController extends Controller
{
    public function reservacion(PreReservacionRequest $request, $idHotel, $idHabitacion) {
        
            try {
                $habitacion = Habitacion::where('idHabitacion', $idHabitacion)
                                        ->where('idHotel', $idHotel)
                                        ->firstOrFail();

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

            } catch(ModelNotFoundException $ex) {
                return redirect()->back()->with('error', 'La habitación buscada no existe');
            }
    }

    public function confirmar(Request $request) {
        $datos = $request->session()->all();
        $idReservacion = $this->generarCodigo();

        $reservacion = DB::select('SELECT nuevaReservacion(?, ?, ?, ?, ?)',
                        [$idReservacion, $datos['idHabitacion'], $request->user()->id, $datos['fechaLlegada'], $datos['fechaIda']]);

        if($reservacion) {
            $movimiento = DB::select('SELECT nuevoPago(?, ?)', [$idReservacion, $request->user()->id]);

            if ($movimiento) {
                return redirect(action('ReservationController@mostrar'))->with('nuevaReservacion', 'Reservación y pago realizados con éxito');
            } else {
                return redirect()->back()->with('errorConfirmacion', 'No se pudo realizar el pago');
            }
        } else {
            return redirect()->back()->with('errorConfirmacion', 'No se pudo realizar la reservación');
        }
    }

    public function mostrar(Request $request) {
        $reservaciones = Reservacion::where('idUsuario', $request->user()->id)->get();
        $fechaLimite = Carbon::now()->addDays(7)->format('Y-m-d');

        return view('misReservaciones', compact('reservaciones', 'fechaLimite'));
    }

    public function cancelar(Request $request) {
        $idUsuario = $request->user()->id;
        $idReservacion = $request->input('idReservacion');
        $fechaLimite = Carbon::now()->addDays(7)->format('Y-m-d');

        try {
            $reservacion = Reservacion::where([
                                        ['idReservacion', $idReservacion],
                                        ['diaInicio', '>', $fechaLimite]
                                    ])->firstOrFail();

            $movimiento = Movimiento::create([
                            'idReservacion' => $reservacion->idReservacion,
                            'idUsuario' => $reservacion->idUsuario,
                            'cantidad' => $reservacion->costoTotal,
                            'fecha' => Carbon::now()->format('Y-m-d'),
                            'asunto' => 'Cancelacion',
                            'descripcion' => 'Cancelacion de reservacion'
            ]);

            $reservacion->cancelacion = 1;

            $reservacion->save();
            $movimiento->save();

            return redirect()->back()->with('success', 'La cancelación se realizó con éxito');

        } catch(ModelNotFoundException $err) {
            return redirect()->back()->with('error', 'No se pudo realizar la cancelación');
        }
    }

    public function modificar(Request $request) {
        $idUsuario = $request->user()->id;
        $idReservacion = $request->input('idReservacion');
        $llegada = new Carbon($request->input('fechaLlegada'));
        $ida = new Carbon($request->input('fechaIda'));
        $fechaLimite = Carbon::now()->addDays(7)->format('Y-m-d');

        try {
            $reservacion = Reservacion::where([
                                        ['idReservacion', $idReservacion],
                                        ['diaInicio', '>', $fechaLimite]
                                    ])
                                    ->whereNull('fechaModificacion')
                                    ->firstOrFail();

            try {
                $habitacion = Habitacion::where('idHabitacion', $reservacion->idHabitacion)
                                ->where('cantidadTotal', '>', DB::table('reservaciones_activas')
                                                                ->where('idHabitacion', '=', 'habitacion.idHabitacion')
                                                                ->whereBetween('diaInicio', [$llegada, $ida])
                                                                ->orWhereBetween('diaFinal', [$llegada, $ida])
                                                                ->count() - 1)
                                ->firstOrFail();

                $costo = $habitacion->precioDia * $ida->diffInDays($llegada);

                if ($costo > $reservacion->costoTotal) {
                    $movimiento = Movimiento::create([
                                    'idReservacion' => $reservacion->idReservacion,
                                    'idUsuario' => $reservacion->idUsuario,
                                    'cantidad' => $costo - $reservacion->costoTotal,
                                    'fecha' => Carbon::now()->format('Y-m-d'),
                                    'asunto' => 'Cargo extra',
                                    'descripcion' => 'Modificacion de reservacion con cargo extra'
                    ]);
                } elseif ($costo < $reservacion->costoTotal) {
                    $movimiento = Movimiento::create([
                                    'idReservacion' => $reservacion->idReservacion,
                                    'idUsuario' => $reservacion->idUsuario,
                                    'cantidad' => $reservacion->costoTotal - $costo,
                                    'fecha' => Carbon::now()->format('Y-m-d'),
                                    'asunto' => 'Reembolso',
                                    'descripcion' => 'Modificacion de reservacion con reembolso'
                    ]);
                } else {
                    $movimiento = Movimiento::create([
                                    'idReservacion' => $reservacion->idReservacion,
                                    'idUsuario' => $reservacion->idUsuario,
                                    'cantidad' => 0,
                                    'fecha' => Carbon::now()->format('Y-m-d'),
                                    'asunto' => 'Modificacion',
                                    'descripcion' => 'Modificacion de reservacion'
                    ]);
                }

                $reservacion->diaInicio = $llegada->format('Y-m-d');
                $reservacion->diaFinal = $ida->format('Y-m-d');
                $reservacion->fechaModificacion = Carbon::now()->format('Y-m-d');
                $reservacion->costoTotal = $costo;

                $reservacion->save();
                $movimiento->save();

                return redirect()->back()->with('success', 'La modificación se realizó con éxito');

            } catch(ModelNotFoundException $e) {
                return redirect()->back()->with('error', 'No hay habitaciones disponibles en el rango de fechas ingresado');
            }

        } catch(ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'No se pudo realizar la modificación');
        }
    }

    public function generarCodigo() {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',

        // 32 bits for "time_low"
        mt_rand(0, 0xffff), mt_rand(0, 0xffff),

        // 16 bits for "time_mid"
        mt_rand(0, 0xffff),

        // 16 bits for "time_hi_and_version",
        // four most significant bits holds version number 4
        mt_rand(0, 0x0fff) | 0x4000,

        // 16 bits, 8 bits for "clk_seq_hi_res",
        // 8 bits for "clk_seq_low",
        // two most significant bits holds zero and one for variant DCE1.1
        mt_rand(0, 0x3fff) | 0x8000,

        // 48 bits for "node"
        mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
    }
}
