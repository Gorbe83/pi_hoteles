@extends('master')
@section('title', 'Registro')

@section('content')
	<!-- banner-bottom -->
	<div class="banner-bottom">
		<!-- container -->
		<div class="container">
			<div class="faqs-top-grids">
				<div class="book-grids">
					<div class="col-md-6 book-left">
						<form method="post">
							<div class="book-left-info">
								<h3>Crea una nueva cuenta</h3>
							</div>
							<div class="book-left-form">

								@foreach ($errors->all() as $error)
								   <p class="alert">{{ $error }}</p>
							   	@endforeach

								{!! csrf_field() !!}

								<p>Nombre</p>
								<input type="text" name="nombre" value="{{ old('nombre') }}">
								<p>Apellidos</p>
								<input type="text" name="apellidos" value="{{ old('apellidos') }}">
								<p>Tel&eacute;fono</p>
								<input type="text" name="telefono" value="{{ old('telefono') }}">
								<p>Fecha de Nacimiento</p>
								<input type="text" name="fechaNacimiento" value="{{ old('fechaNacimiento') }}">
								<p>Sexo</p>
								<select class="form-control" name="sexo">
									<option value="M">Masculino</option>
									<option value="F">Femenino</option>
								</select>
								<p>Correo electr&oacute;nico</p>
								<input type="text" name="email" value="{{ old('email') }}">
								<p>Contrase&ntilde;a</p>
								<input type="password" name="password" id="password">
								<p>Confirmar contrase&ntilde;a</p>
								<input type="password" name="password_confirmation" id="confirm_password">
								<label for="checkbox"><input type="checkbox" id="checkbox"> <i>Remember me</i></label>
								<input type="submit" id="login" value="Register">
							</div>
						</form>
					</div>
					<div class="col-md-6 book-left book-right">
						<div class="book-left-info">
							<h3>Recommended</h3>
						</div>
						<div class="book-left-bottom">
							<div class="book-left-facebook">
								<a href="#">Connect with Facebook</a>
							</div>
							<div class="book-left-chrome">
								<a href="#">Connect with Google</a>
							</div>
						</div>
						<ul>
							<li>Access booking history with upcoming trips</li>
							<li>Print tickets and invoices</li>
							<li>Make checkouts simpler</li>
							<li>Enter your contact details only once</li>
							<li>Get alerts for low fares</li>
						</ul>
					</div>
					<div class="clearfix"> </div>
				</div>
			</div>
		</div>
		<!-- //container -->
	</div>
	<!-- //banner-bottom -->
@endsection
