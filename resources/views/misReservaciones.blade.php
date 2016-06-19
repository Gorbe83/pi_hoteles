@extends('master')
@section('title', 'Mis Reservaciones')

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @foreach($reservaciones as $reservacion)
            <br>
            <p>{{ $reservacion->idReservacion }}</p>
            <p>{{ $reservacion->habitacion->nombre }}</p>
            <p>{{ $reservacion->diaInicio }}</p>
            <p>{{ $reservacion->diaFinal }}</p>
            <p>{{ $reservacion->costoTotal }}</p>
            <p>{{ $reservacion->fechaCreacion }}</p>
            @if ($reservacion->cancelacion == 0)
                @if ($reservacion->diaInicio > $fechaLimite)
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cancelacion{{ $reservacion->idReservacion }}">
                      Cancelar reservaci&oacute;n
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="cancelacion{{ $reservacion->idReservacion }}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                      <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Cancelaci&oacute;n</h4>
                                </div>
                                <div class="modal-body">
                                  ¿Est&aacute; seguro de cancelar esta reservaci&oacute;n?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary" data-dismiss="modal" data-toggle="modal" data-target="#confirmacionCancelacion{{ $reservacion->idReservacion }}">Cancelar reservaci&oacute;n</button>
                                </div>
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal fade" id="confirmacionCancelacion{{ $reservacion->idReservacion }}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                      <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-content">
                                <form method="post" action="/usuario/reservaciones/cancelar">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Datos de reembolso</h4>
                                    </div>
                                    <div class="modal-body">
                                          Ingrese los datos para el reembolso
                                          {{ csrf_field() }}
                                          <input type="hidden" name="idReservacion" value="{{ $reservacion->idReservacion }}">
                                          <div class="form-group">
              									<p>Número de tarjeta</p>
              									<input type="text" name="tarjeta" required>
          								    </div>
                                           <div class="form-group">
           									    <p>Titular de la tarjeta</p>
           									    <input type="text" name="titular" required>
           								    </div>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-primary">Cancelar reservaci&oacute;n</button>
                                      </div>
                                </form>
                            </div>
                        </div>
                      </div>
                    </div>
                    @if (!$reservacion->fechaModificacion)
                        <br>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modificar{{ $reservacion->idReservacion }}">
                          Modificar reservaci&oacute;n
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="modificar{{ $reservacion->idReservacion }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                              <form method="post" action="/usuario/reservaciones/modificar">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Modificaci&oacute;n</h4>
                                  </div>
                                  <div class="modal-body">
                                       {{ csrf_field() }}
                                       <input type="hidden" name="idReservacion" value="{{ $reservacion->idReservacion }}">
                                       <div class="form-group">
           									<p>Fecha de Llegada</p>
           									<input type="date" name="fechaLlegada" required>
       								    </div>
                                        <div class="form-group">
        									<p>Fecha de Ida</p>
        									<input type="date" name="fechaIda" required>
        								</div>
                                        <div class="form-group">
                                              <p>Número de tarjeta</p>
                                              <input type="text" name="tarjeta" required>
                                          </div>
                                         <div class="form-group">
                                              <p>Titular de la tarjeta</p>
                                              <input type="text" name="titular" required>
                                          </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                  </div>
                              </form>
                            </div>
                          </div>
                        </div>
                    @endif
                @endif
            @endif
        @endforeach
    </div>
@endsection
