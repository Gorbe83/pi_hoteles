@extends('master')
@section('title', 'Hoteles')

@section('content')
	<!-- banner-bottom -->
	<div class="explorer">
		<div class="container">
			<a href="/hotel/busqueda?ciudad={{ $hotel->ciudad->nombre }}&fechaLlegada={{ $datosBusqueda['fechaLlegada'] }}&fechaIda={{ $datosBusqueda['fechaIda'] }}&personas={{ $datosBusqueda['personas'] }}"><h6>« Volver</h6></a>
		</div>
	</div>
	<div class="banner-bottom">
		<!-- container -->
		<div class="container">
			<div class="faqs-top-grids">
				<!--single-page-->
				<div class="single-page">
						<div class="col-md-8 single-gd-lt">
							<div class="single-pg-hdr">
								<h2>{{ $hotel->nombre }}</h2>
								@for ($i = 0; $i < $hotel->estrellas; $i++)
									<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
								@endfor
								<p>{{ $hotel->ciudad->nombre }} | Tel. {{ $hotel->telefono }}</p>
								<p>Ir a: <a href="#galeria">Galería</a>|<a href="#habitaciones">Habitaciones</a>|<a href="#">Informaci&oacute;n del Hotel</a></p>
								<div id="galeria" class="flexslider" style="padding:0px 10px;">
									<ul class="slides">
										<li>
											<div class="slider-info">
												<img src="/images/p1.jpg" alt=""/>
											</div>
										</li>
										<li>
											<div class="slider-info">
												<img src="/images/p2.jpg" alt=""/>
											</div>
										</li>
										<li>
											<div class="slider-info">
												<img src="/images/p3.jpg" alt=""/>
											</div>
										</li>
										<li>
											<div class="slider-info">
												<img src="/images/p4.jpg" alt=""/>
											</div>
										</li>
									</ul>
								</div>
								<p>{{ $hotel->detalles }}</p>
							</div>
						</div>
						<div class="col-md-4 single-gd-rt">

						</div>
						<div class="col-md-4 single-gd-rt">
							<div class="spl-btn">
								<div class="spl-btn-bor">
									<a href="#">
										<span class="glyphicon glyphicon-tag" aria-hidden="true"></span>
									</a>
									<p>Mejor oferta</p>
									<script>
										$(document).ready(function(){
										$('[data-toggle="tooltip"]').tooltip();
										});
									</script>
								</div>
								<div class="sp-bor-btn">
									<h4 style="text-align: center;">MXN ${{ $datosBusqueda['precioMenor'] }}</h4>
									<p class="best-pri" style="text-align: center;">Precio por noche</p>
									<div style="text-align: center;">
										<a class="best-btn" href="#habitaciones">Ver habitaciones</a>
									</div>
								</div>
							</div>
							<div class="map-gd">
								<iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBvqUJlFKK-APySgavAsCJuE2snjw0Hr50&q={{ $hotel->ciudad->nombre }},{{ $hotel->nombre }}"></iframe>
							</div>
						</div>
						<div class="clearfix"></div>
				</div>
				<!--//single-page-->
			</div>
			<div class="c-rooms" id="habitaciones">
				@if ($habitaciones->isEmpty())
					<p>No se encontraron habitaciones con estos par&aacute;metros de b&uacute;squeda</p>
				@else
					@foreach ($habitaciones as $habitacion)
						<div class="p-table">
							<div class="p-table-grids">
								<div class="col-md-3 p-table-grid">
									<div class="p-table-grad-heading">
										<h6>Tipo de cuarto</h6>
									</div>
									<div class="p-table-grid-info">
										<a href="#"><img src="/images/p2.jpg" alt=""></a>
										<div class="room-basic-info">
											<h5>{{ $habitacion->nombre }}</h5>
											<h6>1 king bed or  2 single beds</h6>
											<p>Vestibulum ullamcorper(condimentum luctus)</p>
										</div>
									</div>
								</div>
								<div class="col-md-2 p-table-grid">
									<div class="p-table-grad-heading">
										<h6>R&eacute;gimen de comida</h6>
									</div>
									<div class="rate-features">
										<div class="book-button-column">
											<p>{{ $habitacion->regimen_alimenticio->nombre }}</p>
										</div>
									</div>
								</div>
								<div class="col-md-3 p-table-grid">
									<div class="p-table-grad-heading">
										<h6>Servicios</h6>
									</div>
									<div class="rate-features">
										<ul>
											@foreach ($habitacion->servicios as $servicio)
												<li>{{ $servicio->nombre }}</li>
											@endforeach
										</ul>
									</div>
								</div>
								<div class="col-md-2 p-table-grid">
									<div class="p-table-grad-heading">
										<h6>Precio por noche</h6>
									</div>
									<div class="avg-rate">
										<h5>El precio actual es: </h5>
										<span class="p-offer">${{ $habitacion->precioDia }}</span>
									</div>
								</div>
								<div class="col-md-2 p-table-grid">
									<div class="p-table-grad-heading">
										<h6><br></h6>
									</div>
									<div class="book-button-column">
										<form method="post" action="/hotel/{{ $habitacion->hotel->idHotel }}/habitacion/{{ $habitacion->idHabitacion }}/reservacion">
											{{ csrf_field() }}
											<input type="hidden" name="fechaLlegada" value="{{ $datosBusqueda['fechaLlegada'] }}">
											<input type="hidden" name="fechaIda" value="{{ $datosBusqueda['fechaIda'] }}">
											<input type="hidden" name="personas" value="{{ $datosBusqueda['personas'] }}">
											<button type="submit" class="btn btn-primary btn-lg">Reservar</button>
										</form>
									</div>
								</div>
								<div class="clearfix"> </div>
							</div>
						</div>
					@endforeach
				@endif
			</div>
		</div>
		<!-- //container -->
	</div>
	<!-- //banner-bottom -->
@endsection
