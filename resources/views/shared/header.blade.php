<!--header-->
<div class="header">
    <div class="container">
        <div class="header-grids">
            <div class="logo">
                <a  href="/"><img src="/images/logo_prueba.jpg"></a>
            </div>

        <div class="nav-top">
            <div class="dropdown-grids">
                <div id="loginContainer">
                @if (Auth::check())
                    <a href="#" id="loginButton"><span>{!! Auth::user()->nombre !!} {!! Auth::user()->apellidos !!}</span></a>
                        <div id="loginBox">
                            <div id="loginForm">
                                <div class="login-grids">
                                    <div class="login-grid-left">
                                        <fieldset id="body">
                                            <fieldset>
                                                <h4>Hola de nuevo</h4>
                                                <a href="/usuario/reservaciones/mostrar">Mis reservaciones</a>
                                                <a href="/usuario/logout">Cerrar sesi&oacute;n</a>
                                            </fieldset>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                        </div>
                @else
                    <a href="#" id="loginButton"><span>Login</span></a>
                        <div id="loginBox">
                            <form id="loginForm" method="post" action="/usuario/login">

                                {!! csrf_field() !!}

                                <div class="login-grids">
                                    <div class="login-grid-left">
                                        <fieldset id="body">
                                            @if ($errors->has('email') || $errors->has('password'))
                                                @foreach ($errors->all() as $error)
                								   <p class="alert">{{ $error }}</p>
                							   	@endforeach
                                            @endif
                                            <fieldset>
                                                <label for="email">Correo electr&oacute;nico</label>
                                                <input type="text" name="email" id="email">
                                            </fieldset>
                                            <fieldset>
                                                <label for="password">Contrase&ntilde;a</label>
                                                <input type="password" name="password" id="password">
                                            </fieldset>
                                            <input type="submit" id="login" value="Iniciar sesi&oacute;n">
                                            <label for="checkbox"><input type="checkbox" id="checkbox" name="remember"> <i>Recordar</i></label>
                                        </fieldset>
                                        <span><a href="#">¿Olvidaste tu contrase&ntilde;a?</a></span>
                                        <div class="or-grid">
                                            <p>O</p>
                                        </div>
                                        <div class="social-sits">
                                            <div class="facebook-button">
                                                <a href="#">Conectate con Facebook</a>
                                            </div>
                                            <div class="chrome-button">
                                                <a href="#">Conectate con Google</a>
                                            </div>
                                            <div class="button-bottom">
                                                <p>¿No tienes una cuenta? <a href="/usuario/registro">Registrate</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                @endif
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
<!--//header-->
