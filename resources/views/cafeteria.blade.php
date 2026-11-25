@extends('layouts.jjk')
@section('titulo', 'Cafetería')

@section('contenido')
@if ($errors->any())
    <div class="alert">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<section class="hero-menu">
    <p class="eyebrow">— MENÚ DE TEMPORADA</p>
    <h1>Sabores con <span>energía maldita.</span></h1>
    <p class="hero-desc">Café de especialidad y postres inspirados en el universo de Jujutsu. Preparados para expandir tus sentidos.</p>
</section>

<div class="filtros">
    <button type="button" class="chip active" data-cat="Todos">Todos</button>
    <button type="button" class="chip" data-cat="Bebidas">Bebidas</button>
    <button type="button" class="chip" data-cat="Postres">Postres</button>
    <button type="button" class="chip" data-cat="Especiales">Especiales</button>
</div>

<div class="grid">
    @forelse ($productos as $p)
        <article class="card" data-cat="{{ $p->categoria }}">
            <span class="badge">{{ strtoupper($p->categoria) }}</span>
            @if ($p->imagen)
                <img class="card-img" src="{{ asset($p->imagen) }}" alt="{{ $p->nombre }}">
            @else
                <div class="card-img placeholder">呪</div>
            @endif
            <h3>{{ $p->nombre }}</h3>
            <p>{{ $p->descripcion }}</p>

            <div class="card-foot">
                <span class="price">${{ number_format($p->precio, 2) }} MXN</span>
                <form method="POST" action="{{ route('carrito.agregar', $p) }}" class="add-form">
                    @csrf
                    <input type="number" name="cantidad" value="1" min="1" max="10" required>
                    <button type="submit" class="btn-add">AGREGAR</button>
                </form>
            </div>
        </article>
    @empty
        <p class="vacio">El menú todavía está vacío. Vuelve pronto.</p>
    @endforelse
</div>

<script>
    document.querySelectorAll('.chip').forEach(function (chip) {
        chip.addEventListener('click', function () {
            document.querySelectorAll('.chip').forEach(function (c) { c.classList.remove('active'); });
            chip.classList.add('active');
            var cat = chip.dataset.cat;
            document.querySelectorAll('.card').forEach(function (card) {
                card.style.display = (cat === 'Todos' || card.dataset.cat === cat) ? '' : 'none';
            });
        });
    });
</script>
@endsection