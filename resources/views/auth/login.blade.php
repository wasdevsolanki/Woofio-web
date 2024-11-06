<title>Login</title>
<link rel="icon" type="image/png" href="/img/icons8-qr-32.png">
<x-laravel-ui-adminlte::adminlte-layout>
<style>
    .login-page {
        background-image: url('/images/bg/woofio-bg.png');
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
    }
</style>

    

    <body class="hold-transition login-page">

        <div class="login-box">
            <div class="login-logo">
                <img src="/images/woofio-logo.png" width="250">
            </div>
            <!-- /.login-logo -->

            <!-- /.login-box-body -->
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Ingresa tus datos para iniciar sesión</p>

                    <form method="post" action="{{ url('/login') }}">
                        @csrf
                        <input type="hidden" name="qr_id" id="qr_id" value="{{ Request::input('qr_id') }}">
                        
                        <div class="input-group mb-3">
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="Correo electrónico"
                                class="form-control @error('email') is-invalid @enderror">
                            <div class="input-group-append">
                                <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                            </div>
                            @error('email')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                            <input type="password" name="password" placeholder="Contraseña"
                                class="form-control @error('password') is-invalid @enderror">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                            @error('password')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror

                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="icheck-primary">
                                    <input type="checkbox" id="remember">
                                    <label for="remember">Recuérdame</label>
                                </div>
                            </div>

                            <div class="col-6">
                                <button type="submit" class="btn btn-primary btn-block">Iniciar sesión</button>
                            </div>

                        </div>
                    </form>

                    <p class="mb-1 text-right">
                        <a  href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
                    </p>

                   <!-- <p class="mb-0">
                       <a href="{{ route('register') }}" class="text-center">Register</a>
                   </p> -->

                </div>
                <!-- /.login-card-body -->
            </div>

        </div>
        <!-- /.login-box -->
    </body>
</x-laravel-ui-adminlte::adminlte-layout>
