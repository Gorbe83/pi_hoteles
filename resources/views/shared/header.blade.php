<!--header-->
<div class="header">
    <div class="container">
        <div class="header-grids">
            <div class="logo">
                <h1><a  href="/"><span>Hoteles</span>Facilitos</a></h1>
            </div>
            <!--navbar-header-->
            <div class="header-dropdown">
                <div class="emergency-grid">
                    <ul>
                        <li>Toll Free : </li>
                        <li class="call">+1 234 567 8901</li>
                    </ul>
                </div>
                <div class="clearfix"> </div>
            </div>
            <div class="clearfix"> </div>
        </div>
        <div class="nav-top">
            <div class="dropdown-grids">
                <div id="loginContainer">
                @if (Auth::check())
                    <a href="/usuario/logout"><span>Logout</span></a>
                @else
                    <a href="#" id="loginButton"><span>Login</span></a>
                        <div id="loginBox">
                            <form id="loginForm" method="post" action="/usuario/login">

                                {!! csrf_field() !!}
                                
                                <div class="login-grids">
                                    <div class="login-grid-left">
                                        <fieldset id="body">
                                            <fieldset>
                                                <label for="email">Correo electr&oacute;nico</label>
                                                <input type="text" name="email" id="email">
                                            </fieldset>
                                            <fieldset>
                                                <label for="password">Contrase&ntilde;a</label>
                                                <input type="password" name="password" id="password">
                                            </fieldset>
                                            <input type="submit" id="login" value="Sign in">
                                            <label for="checkbox"><input type="checkbox" id="checkbox"> <i>Remember me</i></label>
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
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
<!--//header-->
