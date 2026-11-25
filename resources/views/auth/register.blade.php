<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registro | Rey de las Maldiciones</title>
    <link rel="stylesheet" href="{{ asset('css/jjk.css') }}">
</head>
<body class="auth-body">
    <div class="auth-card">
        <div class="auth-image" style="background-image: url('{{ asset('img/sukuna.jpg') }}')"></div>

        <div class="auth-form">
            <h1>UNIRSE AL <span>DOMINIO</span></h1>
            <p class="sub">Crea tu cuenta para pedir en la cafetería.</p>

            @if ($errors->any())
                <div class="alert">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <label class="lbl">NOMBRE</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Tu nombre" required autofocus maxlength="255" oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñÜü\s]/g, '')">
                <label class="lbl">CORREO ELECTRÓNICO</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="usuario@jujutsutech.com" required>

                <label class="lbl">CONTRASEÑA</label>
                <input type="password" name="password" placeholder="Mínimo 8 caracteres" required>

                <label class="lbl">CONFIRMAR CONTRASEÑA</label>
                <input type="password" name="password_confirmation" placeholder="Repite la contraseña" required>

                <button type="submit" class="btn-red" style="margin-top: 24px;">REGISTRARME</button>
            </form>

            <p class="alt">¿Ya tienes cuenta? <a href="{{ route('login') }}">Inicia sesión</a></p>
        </div>
    </div>
</body>
</html>