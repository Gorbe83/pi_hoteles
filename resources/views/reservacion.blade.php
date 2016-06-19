@extends('master')
@section('title', 'Reservar')

@section('content')
    <div class="explorer">
        <div class="container">
            <a href="/hotel/{{ $hotel->idHotel }}?fechaLlegada={{ $datos['fechaLlegada'] }}&fechaIda={{ $datos['fechaIda'] }}&personas={{ $datos['personas'] }}"><h6>« Volver</h6></a>
        </div>
    </div>
    <div class="banner-bottom">
        <div class="container">
            <div class="banner-bottom-info">
				<h3>&Uacute;ltimo paso: ¡Reserve su habitaci&oacute;n ahora!</h3>
			</div>
            <div class="faqs-top-grids">
                <div class="single-page">
                    <form method="post" action="/reservacion/confirmar">
                        <div class="col-md-8 single-gd-lt">
                            <div class="single-pg-hdr">
                                <div class="banner-bottom-info" style="padding-bottom: 5px; border-bottom: 1px solid #DDD">
                    				<h4>Titular de habitaci&oacute;n</h4>
                    			</div>
                                <br>
                                <div class="form-group">
                                    <label for="nombre">Nombre/s:</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del titular" value="{{ Auth::user()->nombre }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="apellidos">Apellidos:</label>
                                    <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Apellidos del titular" value="{{ Auth::user()->apellidos }}" required>
                                </div>
                                <div class="banner-bottom-info" style="padding-bottom: 5px; border-bottom: 1px solid #DDD">
                    				<h4>Informaci&oacute;n de pago</h4>
                    			</div>
                                <br>
                                <div class="form-horizontal">
                                    <div class="form-group">
                                        <label for="tarjeta" class="col-sm-3 control-label">Tarjeta:</label>
                                        <div class="col-sm-6">
                                            <select class="form-control" id="tarjeta" name="tarjeta" required>
                                              <option value="1">MasterCard</option>
                                              <option value="2">Visa</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="numTarjeta" class="col-sm-3 control-label">N&uacute;mero de tarjeta:</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="numTarjeta" name="numTarjeta" required>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                            <label for="mesVencimiento" class="col-sm-3 control-label">Vencimiento:</label>
                                            <div class="col-sm-3">
                                                <select class="form-control" id="mesVencimiento" name="mesVencimiento" required>
                                                  <option value="1">1</option>
                                                  <option value="2">2</option>
                                                  <option value="3">3</option>
                                                  <option value="4">4</option>
                                                  <option value="5">5</option>
                                                  <option value="6">6</option>
                                                  <option value="7">7</option>
                                                  <option value="8">8</option>
                                                  <option value="9">9</option>
                                                  <option value="10">10</option>
                                                  <option value="11">11</option>
                                                  <option value="12">12</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-3">
                                                <select class="form-control" id="anioVencimiento" name="anioVencimiento" required>
                                                  <option value="2016">2016</option>
                                                  <option value="2017">2017</option>
                                                  <option value="2018">2018</option>
                                                  <option value="2019">2019</option>
                                                  <option value="2020">2020</option>
                                                  <option value="2021">2021</option>
                                                  <option value="2022">2022</option>
                                                  <option value="2023">2023</option>
                                                  <option value="2024">2024</option>
                                                  <option value="2025">2025</option>
                                                  <option value="2026">2026</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="codigoSeguridad" class="col-sm-3 control-label">C&oacute;digo de seguridad:</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" id="codigoSeguridad" name="codigoSeguridad" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="titulat" class="col-sm-3 control-label">Titular de la tarjeta:</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="titular" name="titular" placeholder="Como figura en la tarjeta" required>
                                            </div>
                                        </div>
                                    </div>
                                    {{ csrf_field() }}
                                    <br>
                                    <button type="submit" class="btn btn-danger btn-lg">Comprar</button> Por favor, antes de finalizar revise los datos ingresados.

                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 single-gd-rt">
                            <div class="single-pg-hdr">
                                <div class="banner-bottom-info" style="padding-bottom: 5px; border-bottom: 1px solid #DDD">
                    				<h4>Detalles del pago</h4>
                    			</div>
                                <br>
                                <div class="p-right-right">
                                    <p>Habitaci&oacute;n por noche</p>
                                    <h5>MXN ${{ number_format($habitacion->precioDia,2) }}</h5>
                                </div>
                                <br>
                                <div class="p-left">
                                    <p>{{ $datos['noches'] }} noches</p>
                                </div>
                                <div class="p-right-right">
                                    <p>MXN ${{ number_format($habitacion->precioDia,2) }}</p>
                                </div>
                                <div class="p-right-right">
                                    <h4>Total MXN ${{ number_format(($habitacion->precioDia)*($datos['noches']),2) }}</h4>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="col-md-4 single-gd-rt">
                            <div class="single-pg-hdr">
                                <div class="banner-bottom-info" style="padding-bottom: 5px; border-bottom: 1px solid #DDD">
                                    <h4>Informaci&oacute;n de alojamiento</h4>
                                </div>
                                <br>
                                <div class="p-right-left">
                                    <h4>{{ $hotel->nombre }}</h4>
                                    @for ($i = 0; $i < $hotel->estrellas; $i++)
    									<span style="background: #F4F7F9;" class="glyphicon glyphicon-star" aria-hidden="true"></span>
    								@endfor
                                    <p>{{ $hotel->direccion }}</p>
                                </div>
                                <br>
                                <div class="p-left">
                                    <h4>Entrada</h4>
                                </div>
                                <div class="p-right-right">
                                    <h4>Salida</h4>
                                </div>
                                <div class="p-left">
                                    <h4>{{ date_format(date_create($datos['fechaLlegada']),'d/m/y') }}</h4>
                                </div>
                                <div class="p-right-right">
                                    <h4>{{ date_format(date_create($datos['fechaIda']),'d/m/y') }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
