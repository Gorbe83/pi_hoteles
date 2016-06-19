<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BuscarHotelRequest;
use App\Http\Requests\VerHotelRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use DB;
use App\Http\Requests;
use App\Hotel;
use App\Habitacion;
use App\Ciudad;
use App\Servicio;

class HotelsController extends Controller
{

    public function busqueda(BuscarHotelRequest $request) {
        $ciudad = Ciudad::where('nombre', $request->input('ciudad'))->firstOrFail();
        $servicios = Servicio::all();

        ///////--------------BUSQUEDA GENERAL------------------//////////////
        $hoteles = Hotel::select(
                            DB::raw("idHotel,
                                idCiudad,
                                nombre,
                                estrellas,
                                telefono,
                                direccion,
                                menorPrecioDisponible(idHotel, ?, ?, ?) as menorPrecio"
                            )
                        )
                        ->with(['habitaciones' => function ($query) {
                                $query->with('regimen_alimenticio', 'servicios');
                            }
                        ])
                        ->where('idCiudad', '?')
                        ->setBindings([
                            $request->input('fechaLlegada'),
                            $request->input('fechaIda'),
                            $request->input('personas'),
                            $ciudad->idCiudad
                        ])
                        ->get();

        ///////--------------BUSQUEDA POR ESTRELLAS------------------//////////////
        $estrellas = array();
        if ($request->input('estrellas')) {
            foreach($request->input('estrellas') as $estrella) {
                $estrellas[] = (int)$estrella;
            }
            $hoteles = $hoteles->whereIn('estrellas', $estrellas);
        }


        ///////--------------BUSQUEDA POR SERVICIOS------------------//////////////
        $serviciosDisponibles = array();
        if ($request->input('servicios')) {
            foreach($request->input('servicios') as $servicio) {
                $serviciosDisponibles[] = (int)$servicio;
            }
            foreach ($hoteles as $hotel) {
                foreach ($hotel->habitaciones as $habitacion) {
                    foreach ($habitacion->servicios as $servicio) {
                        $servicio = $servicio->whereIn('idServicio', $serviciosDisponibles);
                    }
                }
            }
        }


        ///////--------------BUSQUEDA POR RANGO DE PRECIOS------------------//////////////
        if ($request->input('precioMinimo')) {
            $precioMinimo = floatval($request->input('precioMinimo'));
            if ($request->input('precioMaximo')) {
                $precioMaximo = floatval($request->input('precioMaximo'));
                $hoteles = collect($hoteles)->filter(function ($item) use ($precioMinimo){
                    return $item->menorPrecio >= $precioMinimo;
                })
                ->filter(function ($item) use ($precioMaximo) {
                    return $item->menorPrecio <= $precioMaximo;
                });
            } else {
                $hoteles = collect($hoteles)->filter(function ($item) use($precioMinimo) {
                    return $item->menorPrecio >= $precioMinimo;
                });
            }
        } elseif ($request->input('precioMaximo')) {
            $precioMaximo = floatval($request->input('precioMaximo'));
            if ($request->input('precioMinimo')) {
                $precioMinimo = floatval($request->input('precioMinimo'));
                $hoteles = collect($hoteles)->filter(function ($item) use ($precioMinimo){
                    return $item->menorPrecio >= $precioMinimo;
                })
                ->filter(function ($item) use ($precioMaximo) {
                    return $item->menorPrecio <= $precioMaximo;
                });
            } else {
                $hoteles = collect($hoteles)->filter(function ($item) use($precioMaximo) {
                    return $item->menorPrecio <= $precioMaximo;
                });
            }
        }

        ///////--------------BUSQUEDA ORDENADA------------------//////////////
        if ($request->input('orden') == "desc")
            $hoteles = collect($hoteles)->sortByDesc('menorPrecio')->values()->all();


        ///////--------------RETORNO DE JSON------------------//////////////
        if ($request->wantsJson()) {
            foreach($hoteles as $hotel) {
                $hotel->url = 'http://mexigo.app/hotel/'.$hotel->idCiudad.'?fechaLlegada='.$request->input('fechaLlegada').'&fechaIda='.$request->input('fechaIda').'&personas='.$request->input('personas').'&precioMenor='.$hotel->menorPrecio;
            }
            return response()->json(['hoteles' => $hoteles]);
        }

        ///////--------------IMPRESION A VISTA------------------//////////////
        $datosBusqueda = array(
            'ciudad' => $request->input('ciudad'),
            'fechaLlegada' => $request->input('fechaLlegada'),
            'fechaIda' => $request->input('fechaIda'),
            'personas' => $request->input('personas'),
            'cuartos' => $request->input('cuartos')
        );
        return view ('busqueda')->with('hoteles', $hoteles)->with('servicios', $servicios)->with('datosBusqueda', $datosBusqueda);
    }

    public function hotel(VerHotelRequest $request, $id) {
        try {
            $hotel = Hotel::where('idHotel', $id)->firstOrFail();
            $habitaciones = Habitacion::where('idHotel', '=', $hotel->idHotel)
                            ->where('cantidadTotal', '>', DB::table('reservaciones_activas')
                                                            ->where('idHabitacion', '=', 'habitacion.idHabitacion')
                                                            ->whereBetween('diaInicio', [$request->input('fechaLlegada'), $request->input('fechaIda')])
                                                            ->orWhereBetween('diaFinal', [$request->input('fechaLlegada'), $request->input('fechaIda')])
                                                            ->count())
                            ->get();

            if ($request->wantsJson()) {
                    return response()->json(['hotel' => $hotel, 'habitaciones' => $habitaciones]);
            }

            $datosBusqueda = array(
                'fechaLlegada' => $request->input('fechaLlegada'),
                'fechaIda' => $request->input('fechaIda'),
                'personas' => $request->input('personas'),
                'cuartos' => $request->input('cuartos'),
                'precioMenor' => $request->input('precioMenor')
            );
            return view ('hotel', compact('hotel', 'habitaciones', 'datosBusqueda'));

        } catch(ModelNotFoundException $err) {
            return redirect()->back()->with('error', 'El hotel al que se quiere acceder no existe');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $hoteles = Hotel::all();

        return view('crud.index', compact('hoteles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $ciudades = Ciudad::lists('nombre', 'idCiudad');;
        return view ('crud.create')->with('ciudades', $ciudades);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}
