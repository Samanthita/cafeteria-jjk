<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('titulo', 'Café del Dominio')</title>
    <link rel="stylesheet" href="{{ asset('css/jjk.css') }}">
</head>
<body class="app-body">
    <div class="wrap">
        <header class="topbar">
            <div>
                <h2 class="brand">CAFÉ DEL DOMINIO</h2>
                <p class="brand-sub">TOKYO · CAMPUS</p>
            </div>
            <div class="user-box">
                <a href="{{ route('carrito.index') }}" class="cart-btn">
                    🛒 <span class="cart-count">{{ array_sum(session('carrito', [])) }}</span>
                </a>
                <div class="user-info">
                    <strong>Bienvenido, {{ Auth::user()->name }}</strong>
                    <span class="role">{{ strtoupper(Auth::user()->role) }}</span>
                </div>
                <form method="POST" action="{{ route('logout') }}" id="form-salir">
                    @csrf
                    <input type="hidden" name="inactividad" id="inactividad" value="">
                    <button type="submit" class="btn-out">SALIR</button>
                </form>
            </div>
        </header>

        <nav class="menu-links">
            @if (Auth::user()->role === 'admin')
                <a href="{{ route('admin.productos.index') }}">PANEL</a>
                <a href="{{ route('admin.pedidos.index') }}">PEDIDOS</a>
            @endif
            <a href="{{ route('cafeteria') }}">MENÚ</a>
            <a href="{{ route('pedidos') }}">MIS PEDIDOS</a>
        </nav>

        @if (session('ok'))
            <div class="flash">{{ session('ok') }}</div>
        @endif

        @if (session('error'))
            <div class="alert">{{ session('error') }}</div>
        @endif

        @yield('contenido')
    </div>

    <script>
        (function () {
            var LIMITE = 20 * 60 * 1000; // 20 minutos
            var timer;

            function cerrar() {
                document.getElementById('inactividad').value = '1';
                document.getElementById('form-salir').submit();
            }

            function reiniciar() {
                clearTimeout(timer);
                timer = setTimeout(cerrar, LIMITE);
            }

            ['mousemove', 'keydown', 'click', 'scroll', 'touchstart'].forEach(function (evento) {
                document.addEventListener(evento, reiniciar, { passive: true });
            });

            reiniciar();
        })();
    </script>
</body>
</html>