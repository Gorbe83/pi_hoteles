@extends('master')
@section('title', 'Resultados');

@section('content')
	<!-- banner-bottom -->
	<div class="banner-bottom">
		<!-- container -->
		<div class="container">
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
							<div class="online_reservation" style="background-color:green;">
								<form action="/busqueda" method="GET">
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
														 <h5>Adultos (18+)</h5>
														 <!----------start section_room----------->
														 <div class="section_room">
															  <select id="adultos" name="adultos" onchange="change_adultos(this.value)" class="frm-field required">
																	<option value="1" @if ($datosBusqueda['adultos'] == '1') selected @endif>1</option>
																	<option value="2" @if ($datosBusqueda['adultos'] == '2') selected @endif>2</option>
																	<option value="3" @if ($datosBusqueda['adultos'] == '3') selected @endif>3</option>
																	<option value="4" @if ($datosBusqueda['adultos'] == '4') selected @endif>4</option>
																	<option value="5" @if ($datosBusqueda['adultos'] == '5') selected @endif>5</option>
																	<option value="6" @if ($datosBusqueda['adultos'] == '6') selected @endif>6</option>
															  </select>
														 </div>
													</li>
													<li class="span1_of_1 left h-child">
														 <h5>Ni&ntilde;os (0-17)</h5>
														 <!----------start section_room----------->
														 <div class="section_room">
															  <select id="ninos" name="ninos" onchange="change_ninos(this.value)" class="frm-field required">
																  <option value="0" @if ($datosBusqueda['ninos'] == '0') selected @endif>0</option>
																  <option value="1" @if ($datosBusqueda['ninos'] == '1') selected @endif>1</option>
																  <option value="2" @if ($datosBusqueda['ninos'] == '2') selected @endif>2</option>
																  <option value="3" @if ($datosBusqueda['ninos'] == '3') selected @endif>3</option>
																  <option value="4" @if ($datosBusqueda['ninos'] == '4') selected @endif>4</option>
																  <option value="5" @if ($datosBusqueda['ninos'] == '5') selected @endif>5</option>
																  <option value="6" @if ($datosBusqueda['ninos'] == '6') selected @endif>6</option>
															  </select>
														 </div>
													</li>
													<li class="span1_of_1 h-rooms">
														 <h5>Cuartos</h5>
														 <!----------start section_room----------->
														 <div class="section_room">
															  <select id="cuartos" name="cuartos" onchange="change_cuartos(this.value)" class="frm-field required">
																	<option value="1" @if ($datosBusqueda['cuartos'] == '1') selected @endif>1</option>
																	<option value="2" @if ($datosBusqueda['cuartos'] == '2') selected @endif>2</option>
																	<option value="3" @if ($datosBusqueda['cuartos'] == '3') selected @endif>3</option>
																	<option value="4" @if ($datosBusqueda['cuartos'] == '4') selected @endif>4</option>
																	<option value="5" @if ($datosBusqueda['cuartos'] == '5') selected @endif>5</option>
																	<option value="6" @if ($datosBusqueda['cuartos'] == '6') selected @endif>6</option>
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
								</form>
							</div>
							<div class="h-class">
							<h5>Estrellas</h5>
							<div class="hotel-price">
								<label class="check">
									<input type="checkbox">
									<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
									<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
									<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
									<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
									<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
									<span class="starTextLabel">5 Stars (18)</span>
								</label>
							</div>
							<div class="hotel-price">
								<label class="check">
									<input type="checkbox" checked="checked" data-track="HOT:SR:StarRating:5Star">
									<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
									<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
									<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
									<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
									<span class="starTextLabel">4 Stars (30)</span>
								</label>
							</div>
							<div class="hotel-price">
								<label class="check">
									<input type="checkbox">
									<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
									<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
									<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
									<span class="starTextLabel">3 Stars (106)</span>
								</label>
							</div>
							<div class="hotel-price">
								<label class="check">
									<input type="checkbox">
									<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
									<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
									<span class="starTextLabel">2 Stars (78)</span>
								</label>
							</div>
							<div class="hotel-price">
								<label class="check">
									<input type="checkbox">
									<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
									<span class="starTextLabel">1 Stars (10)</span>
								</label>
							</div>
						</div>
						<div class="h-class p-day">
							<h5>Precio por dia</h5>
							<div class="hotel-price">
								<label class="check">
									<input type="checkbox" checked="checked" data-track="HOT:SR:StarRating:5Star">
									<span class="p-day-grid">Less than $100 (76)</span>
								</label>
							</div>
							<div class="hotel-price">
								<label class="check">
									<input type="checkbox">
									<span class="p-day-grid">$100 to $200 (132)</span>
								</label>
							</div>
							<div class="hotel-price">
								<label class="check">
									<input type="checkbox">
									<span class="p-day-grid">$300 to $300 (223)</span>
								</label>
							</div>
							<div class="hotel-price">
								<label class="check">
									<input type="checkbox">
									<span class="p-day-grid">$300 to $400 (84)</span>
								</label>
							</div>
							<div class="hotel-price">
								<label class="check">
									<input type="checkbox">
									<span class="p-day-grid">$500 to $600 (23)</span>
								</label>
							</div>
						</div>
						<div class="h-class">
							<h5>Area</h5>
							<div class="hotel-price">
								<label class="check">
									<input type="radio" name="hideRegionId" checked="checked" data-track="HOT:SR:Area">
									<span class="p-day-grid">London</span>
								</label>
							</div>
							<div class="hotel-price">
								<label class="check">
									<input type="radio" name="hideRegionId"  data-track="HOT:SR:Area">
									<span class="p-day-grid">Newyork</span>
								</label>
							</div>
							<div class="hotel-price">
								<label class="check">
									<input type="radio" name="hideRegionId"  data-track="HOT:SR:Area">
									<span class="p-day-grid">New Zealand</span>
								</label>
							</div>
							<div class="hotel-price">
								<label class="check">
									<input type="radio" name="hideRegionId"  data-track="HOT:SR:Area">
									<span class="p-day-grid">Los Angeles</span>
								</label>
							</div>
							<div class="hotel-price">
								<label class="check">
									<input type="radio" name="hideRegionId"  data-track="HOT:SR:Area">
									<span class="p-day-grid">Sydney</span>
								</label>
							</div>
							<div class="hotel-price">
								<label class="check">
									<input type="radio" name="hideRegionId"  data-track="HOT:SR:Area">
									<span class="p-day-grid">Agra</span>
								</label>
							</div>
							<div class="hotel-price">
								<label class="check">
									<input type="radio" name="hideRegionId"  data-track="HOT:SR:Area">
									<span class="p-day-grid">Greece</span>
								</label>
							</div>
							<div class="hotel-price">
								<label class="check">
									<input type="radio" name="hideRegionId"  data-track="HOT:SR:Area">
									<span class="p-day-grid">Singapore</span>
								</label>
							</div>
							<div class="hotel-price">
								<label class="check">
									<input type="radio" name="hideRegionId"  data-track="HOT:SR:Area">
									<span class="p-day-grid">Paris</span>
								</label>
							</div>
						</div>
						<div class="h-class p-day">
							<h5>Accommodation Type</h5>
							<div class="hotel-price">
								<label class="check">
									<input type="checkbox" checked="checked" data-track="HOT:SR:StarRating:5Star">
									<span class="p-day-grid">Hotel resort (67)</span>
								</label>
							</div>
							<div class="hotel-price">
								<label class="check">
									<input type="checkbox">
									<span class="p-day-grid">Hotel (84)</span>
								</label>
							</div>
							<div class="hotel-price">
								<label class="check">
									<input type="checkbox">
									<span class="p-day-grid">Guest house (24)</span>
								</label>
							</div>
							<div class="hotel-price">
								<label class="check">
									<input type="checkbox">
									<span class="p-day-grid">Apartment (34)</span>
								</label>
							</div>
							<div class="hotel-price">
								<label class="check">
									<input type="checkbox">
									<span class="p-day-grid">Country House (32)</span>
								</label>
							</div>
						</div>
					</div>

					<!-- RESULTADOS HOTELES -->
					<div class="col-md-9 product-right">
						@if ($hoteles->isEmpty())
							<p>No se encontraron hoteles</p>
						@else
							@foreach ($hoteles as $hotel)
								<div class="product-right-grids">
									<div class="product-right-top">
										<div class="p-left">
											<div class="p-right-img">
												<a href="/hotel/{!! $hotel->idHotel !!}?fechaLlegada={!! $datosBusqueda['fechaLlegada'] !!}&fechaIda={!! $datosBusqueda['fechaIda'] !!}&adultos={!! $datosBusqueda['adultos'] !!}&ninos={!! $datosBusqueda['ninos'] !!}"> </a>
											</div>
										</div>
										<div class="p-right">
											<div class="col-md-6 p-right-left">
												<a href="/hotel/{!! $hotel->idHotel !!}?fechaLlegada={!! $datosBusqueda['fechaLlegada'] !!}&fechaIda={!! $datosBusqueda['fechaIda'] !!}&adultos={!! $datosBusqueda['adultos'] !!}&ninos={!! $datosBusqueda['ninos'] !!}">{!! $hotel->nombre !!}</a>
												<div class="p-right-price">
													@for ($i = 0; $i < $hotel->estrellas; $i++)
														<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
													@endfor
												</div>
												<p>{!! $hotel->direccion !!}</p>
												<p class="p-call">{!! $hotel->telefono !!}</p>
											</div>
											<div class="col-md-6 p-right-right">
												<p>Habitaci&oacute;n por noche</p>
												<span class="p-offer">$4252</span>
											</div>
											<div class="clearfix"> </div>
										</div>
										<div class="clearfix"> </div>
									</div>
								</div>
							@endforeach
						@endif
					</div>
					<!-- FIN RESULTADOS HOTELES -->

					<div class="clearfix"> </div>
				</div>
			</div>
		</div>
		<!-- //container -->
	</div>
	<!-- //banner-bottom -->
@endsection
