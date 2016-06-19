@extends('master')
@section('title', 'Resultados')

@section('content')
	<!-- banner-bottom -->
	<div class="banner-bottom">
		<!-- container -->
		<div class="container">
			@if ($errors->has('ciudad') || $errors->has('fechaLlegada') || $errors->has('fechaIda') || $errors->has('personas'))
				@foreach ($errors->all() as $error)
					<div class="alert alert-danger alert-dismissible fade in" role="alert">
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					  </button>
					  {{ $error }}
					</div>
	            @endforeach
			@endif
			<form action="/hotel/busqueda" method="GET">
			<div class="faqs-top-grids">
				<div class="product-grids">
					<div class="col-md-3 product-left">
							<link rel="stylesheet" href="/css/jquery-ui.css" />
								<!---strat-date-piker---->
								<script>
									$(function() {
										$( "#datepicker,#datepicker1" ).datepicker();
									});
								</script>
							<div class="online_reservation" style="background-color: #339933;">
									<div class="b_room">
										<div class="booking_room">
											<legend style="text-align:center; color:white;">Hoteles</legend>
											<div class="reservation">
												<ul>
													<li class="span1_of_1 left">
														 <h5>Destino</h5>
														 <div class="book_date">
															<span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>
															<input type="text" name="ciudad" placeholder="Ciudad" class="typeahead1 input-md form-control tt-input" value="{{ $datosBusqueda['ciudad'] }}" required>
														</div>
													 </li>
												</ul>
											</div>
											<div class="reservation">
												<ul>
													 <li class="span1_of_1 left">
														 <h5>Llegada</h5>
														 <div class="book_date">
															<span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
															<input type="date" name="fechaLlegada" value="{{ $datosBusqueda['fechaLlegada'] }}" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Select date';}" required>
														 </div>
													 </li>
													 <li class="span1_of_1 left">
														 <h5>Salida</h5>
														 <div class="book_date">
															<span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
															<input type="date" name="fechaIda" value="{{ $datosBusqueda['fechaIda'] }}" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Select date';}" required>
														</div>
													 </li>
													 <li class="span1_of_1 left adult">
														 <h5>Personas</h5>
														 <!----------start section_room----------->
														 <div class="section_room">
															  <select id="personas" name="personas" onchange="change_adultos(this.value)" class="frm-field required">
																	<option value="1" @if ($datosBusqueda['personas'] == '1') selected @endif>1</option>
																	<option value="2" @if ($datosBusqueda['personas'] == '2') selected @endif>2</option>
																	<option value="3" @if ($datosBusqueda['personas'] == '3') selected @endif>3</option>
																	<option value="4" @if ($datosBusqueda['personas'] == '4') selected @endif>4</option>
																	<option value="5" @if ($datosBusqueda['personas'] == '5') selected @endif>5</option>
																	<option value="6" @if ($datosBusqueda['personas'] == '6') selected @endif>6</option>
															  </select>
														 </div>
													</li>
													 <div class="clearfix"></div>
												</ul>
											</div>
											<div class="reservation">
												<ul>
													 <li class="span1_of_1 left">
														<div class="date_btn">
															<button type="submit" class="btn btn-primary btn-block">Buscar</button>
														</div>
													 </li>
													 <div class="clearfix"></div>
												</ul>
											</div>
											<div class="reservation">
												<ul>
													<div class="clearfix"></div>
												</ul>
											</div>
										</div>
										<div class="clearfix"></div>
									</div>
							</div>
							<br>
							<div class="h-class">
							<h5>Estrellas</h5>
							<div class="hotel-price">
								<label class="check">
									<input type="checkbox" name="estrellas[]" id="5" value=5>
									<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
									<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
									<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
									<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
									<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
									<span class="starTextLabel">5 Estrellas</span>
								</label>
							</div>
							<div class="hotel-price">
								<label class="check">
									<input type="checkbox" name="estrellas[]" id="4" value=4>
									<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
									<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
									<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
									<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
									<span class="starTextLabel">4 Estrellas</span>
								</label>
							</div>
							<div class="hotel-price">
								<label class="check">
									<input type="checkbox" name="estrellas[]" id="3" value=3>
									<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
									<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
									<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
									<span class="starTextLabel">3 Estrellas</span>
								</label>
							</div>
							<div class="hotel-price">
								<label class="check">
									<input type="checkbox" name="estrellas[]" id="2" value=2>
									<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
									<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
									<span class="starTextLabel">2 Estrellas</span>
								</label>
							</div>
							<div class="hotel-price">
								<label class="check">
									<input type="checkbox" name="estrellas[]" id="1" value=1>
									<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
									<span class="starTextLabel">1 Estrella</span>
								</label>
							</div>
						</div>
						<div class="h-class p-day">
							<h5>Precio por dia</h5>
							<div class="form-inline">
								<div class="form-group">
									<label for="precioMinimo">Mínimo:</label>
									<input type="text" class="form-control" name="precioMinimo">
								</div>
								<div class="form-group">
									<label for="precioMaximo">Máximo:</label>
									<input type="text" class="form-control" name="precioMaximo">
								</div>
							</div>
						</div>
						<div class="h-class">
							<h5>Servicios</h5>
							@foreach ($servicios as $servicio)
								<div class="hotel-price">
									<label class="check">
										<input type="checkbox" name="servicios[]" value="{{ $servicio->idServicio }}">
										<span class="p-day-grid">{{ $servicio->nombre }}</span>
									</label>
								</div>
							@endforeach
							</div>
						</div>
					</div>

					<!-- RESULTADOS HOTELES -->
					<div class="col-md-9 product-right">
						@if (empty($hoteles))
							<p>No se encontraron hoteles</p>
						@else
							<div class="row">
								<div class="product-right-top" style="align: right;">
									<select name="orden" class="form-control">
										<option value="asc" default>De menor a mayor precio</option>
										<option value="desc">De mayor a menor precio</option>
									</select>
								</div>
							</div>
							<br><br>
							@foreach ($hoteles as $hotel)
								@if ($hotel->menorPrecio)
									<div class="product-right-grids">
										<div class="product-right-top">
											<div class="p-left">
												<div class="p-right-img">
													<a href="/hotel/busqueda/{{ $hotel->idHotel }}?fechaLlegada={{ $datosBusqueda['fechaLlegada'] }}&fechaIda={{ $datosBusqueda['fechaIda'] }}&personas={{ $datosBusqueda['personas'] }}&precioMenor={{ $hotel->menorPrecio }}"> </a>
												</div>
											</div>
											<div class="p-right">
												<div class="col-md-6 p-right-left">
													<a href="/hotel/busqueda/{{ $hotel->idHotel }}?fechaLlegada={{ $datosBusqueda['fechaLlegada'] }}&fechaIda={{ $datosBusqueda['fechaIda'] }}&personas={{ $datosBusqueda['personas'] }}&precioMenor={{ $hotel->menorPrecio }}">{{ $hotel->nombre }}</a>
													<div class="p-right-price">
														@for ($i = 0; $i < $hotel->estrellas; $i++)
															<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
														@endfor
													</div>
													<p>{{ $hotel->direccion }}</p>
													<p class="p-call">{{ $hotel->telefono }}</p>
												</div>
												<div class="col-md-6 p-right-right">
													<p>Habitaci&oacute;n por noche</p>
													<span class="p-offer">${{ $hotel->menorPrecio }}</span>
												</div>
												<div class="clearfix"> </div>
											</div>
											<div class="clearfix"> </div>
										</div>
									</div>
								@endif
							@endforeach
						@endif
					</div>
					<!-- FIN RESULTADOS HOTELES -->

					<div class="clearfix"> </div>
				</div>
			</div>
			</form>
		</div>
		<!-- //container -->
	</div>
	<!-- //banner-bottom -->
@endsection
