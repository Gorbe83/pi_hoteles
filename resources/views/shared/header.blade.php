<!--header-->
<div class="header">
    <div class="container">
        <div class="header-grids">
            <div class="logo">
                <h1><a  href="/"><span>Hoteles</span>Facilitos</a></h1>
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
                                            @foreach ($errors->all() as $error)
            								   <p class="alert">{{ $error }}</p>
            							   	@endforeach
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
                                        <span><a href="#">Forgot your password?</a></span>
                                        <div class="or-grid">
                                            <p>OR</p>
                                        </div>
                                        <div class="social-sits">
                                            <div class="facebook-button">
                                                <a href="#">Connect with Facebook</a>
                                            </div>
                                            <div class="chrome-button">
                                                <a href="#">Connect with Google</a>
                                            </div>
                                            <div class="button-bottom">
                                                <p>New account? <a href="/usuario/registro">Signup</a></p>
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
