<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Café del Dominio</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Segoe UI', Arial, sans-serif; color: #fff; min-height: 100vh;
            background: radial-gradient(circle at 20% 20%, #1a0a0a, #050505 70%);
        }
        a { text-decoration: none; }

        .nav {
            display: flex; justify-content: space-between; align-items: center;
            padding: 24px 6%; border-bottom: 1px solid #1f1f23;
        }
        .logo { font-weight: 900; letter-spacing: .15em; font-size: 1.1rem; }
        .logo span { color: #dc2626; }
        .nav-links { display: flex; gap: 12px; }
        .nav-links a {
            padding: 10px 22px; border-radius: 10px; font-weight: 700;
            font-size: .85rem; letter-spacing: .08em; color: #fff; border: 1px solid #2a2a30;
        }
        .nav-links a.fill { background: #dc2626; border-color: #dc2626; }
        .nav-links a:hover { opacity: .85; }

        .hero {
            display: flex; align-items: center; gap: 60px;
            padding: 60px 6%; max-width: 1300px; margin: 0 auto;
        }
        .hero-text { flex: 1.2; }
        .tag {
            display: inline-block; padding: 8px 16px; border-radius: 999px;
            background: rgba(220, 38, 38, .12); border: 1px solid #7f1d1d;
            color: #f87171; font-size: .75rem; font-weight: 800; letter-spacing: .15em;
        }
        h1 { font-size: clamp(2.6rem, 6vw, 4.6rem); font-weight: 900; line-height: 1.02; margin: 26px 0 20px; }
        h1 span { color: #dc2626; display: block; text-shadow: 0 0 40px rgba(220, 38, 38, .5); }
        .desc { color: #9ca3af; font-size: 1.15rem; line-height: 1.6; max-width: 520px; }
        .btns { display: flex; gap: 14px; margin-top: 34px; flex-wrap: wrap; }
        .btn {
            padding: 16px 30px; border-radius: 10px; font-weight: 800;
            letter-spacing: .1em; font-size: .9rem; color: #fff;
        }
        .btn.red { background: #dc2626; box-shadow: 0 8px 30px rgba(220, 38, 38, .35); }
        .btn.red:hover { background: #b91c1c; }
        .btn.line { border: 1px solid #3a3a42; }
        .btn.line:hover { border-color: #dc2626; }

        .hero-img { flex: .8; text-align: center; }
        .poster {
            border-radius: 20px; overflow: hidden; border: 1px solid #2a1215;
            box-shadow: 0 0 60px rgba(220, 38, 38, .18); background: #0b0b0d;
        }
        .poster img { width: 100%; display: block; max-height: 640px; object-fit: cover; object-position: top; }
        .poster-name { padding: 18px; font-weight: 900; letter-spacing: .1em; }
        .poster-name small { display: block; color: #f87171; font-size: .7rem; margin-top: 4px; letter-spacing: .15em; }

        .footer { text-align: center; color: #52525b; padding: 30px; font-size: .8rem; letter-spacing: .1em; }

        @media (max-width: 900px) {
            .hero { flex-direction: column; padding-top: 30px; }
            .hero-img { width: 100%; max-width: 420px; }
        }
    </style>
</head>
<body>

    <header class="nav">
        <div class="logo">CAFÉ DEL <span>DOMINIO</span></div>
        <nav class="nav-links">
            @auth
                <a class="fill" href="{{ url('/dashboard') }}">ENTRAR</a>
            @else
                <a href="{{ route('login') }}">INGRESAR</a>
                <a class="fill" href="{{ route('register') }}">REGISTRARME</a>
            @endauth
        </nav>
    </header>

    <main class="hero">
        <div class="hero-text">
            <span class="tag">RESTRICCIÓN CELESTIAL // 0 ENERGÍA MALDITA</span>
            <h1>CAFÉ DEL <span>DOMINIO</span></h1>
            <p class="desc">
                Café de especialidad y postres con la esencia de Jujutsu Kaisen.
                Sin energía maldita, solo sabor puro y letal.
            </p>
            <div class="btns">
                @auth
                    <a class="btn red" href="{{ url('/dashboard') }}">VER EL MENÚ</a>
                @else
                    <a class="btn red" href="{{ route('register') }}">UNIRME AL DOMINIO</a>
                    <a class="btn line" href="{{ route('login') }}">YA TENGO CUENTA</a>
                @endauth
            </div>
        </div>

        <div class="hero-img">
            <div class="poster">
                <img src="{{ asset('img/toji.jpg') }}" alt="Toji Fushiguro">
                <div class="poster-name">TOJI FUSHIGURO <small>EL ASESINO DE CHAMANES</small></div>
            </div>
        </div>
    </main>

    <footer class="footer">CAFÉ DEL DOMINIO · TOKYO · CAMPUS</footer>

</body>
</html>