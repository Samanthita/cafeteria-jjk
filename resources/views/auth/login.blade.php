<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Rey de las Maldiciones</title>
    <link rel="stylesheet" href="{{ asset('css/jjk.css') }}">
</head>
<body class="auth-body">
    <div class="auth-card">
        <div class="auth-image" style="background-image: url('{{ asset('img/sukuna.jpg') }}')"></div>

        <div class="auth-form">
            <h1>INGRESAR AL <span>DOMINIO</span></h1>
            <p class="sub">Ingresa tus credenciales para identificarte.</p>

            @if ($errors->any())
                <div class="alert">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <label class="lbl">CORREO ELECTRÓNICO</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="usuario@jujutsutech.com" required autofocus>

                <label class="lbl">CONTRASEÑA</label>
                <input type="password" name="password" placeholder="••••••••" required>

                <div class="row">
                    <label class="check">
                        <input type="checkbox" name="remember"> Recordarme
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">¿Olvidaste tu clave?</a>
                    @endif
                </div>

                <button type="submit" class="btn-red">ENTRAR</button>
            </form>

            <p class="alt">¿No tienes cuenta? <a href="{{ route('register') }}">Regístrate</a></p>
        </div>
    </div>
</body>
</html>