@extends('layouts.jjk')
@section('titulo', 'Mi carrito')

@section('contenido')
<section class="panel">
    <h3 class="panel-title">MI CARRITO</h3>

    @if ($errors->any())
        <div class="alert">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    @if (count($items) === 0)
        <p class="vacio">Tu carrito está vacío. <a href="{{ route('cafeteria') }}">Ir al menú</a></p>
    @else
        <div class="table-wrap">
            <table class="tabla">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td>{{ $item['producto']->nombre }}</td>
                            <td>${{ number_format($item['producto']->precio, 2) }}</td>
                            <td>
                                <form method="POST" action="{{ route('carrito.actualizar', $item['producto']) }}" class="qty-form">
                                    @csrf
                                    @method('PATCH')
                                    <input type="number" name="cantidad" value="{{ $item['cantidad'] }}" min="1" max="10" required>
                                    <button type="submit" class="btn-edit">ACTUALIZAR</button>
                                </form>
                            </td>
                            <td>${{ number_format($item['subtotal'], 2) }}</td>
                            <td>
                                <form method="POST" action="{{ route('carrito.quitar', $item['producto']) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-del">QUITAR</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="total-box">
            <span>TOTAL</span>
            <strong>${{ number_format($total, 2) }} MXN</strong>
        </div>

        <div class="cart-actions">
            <form method="POST" action="{{ route('carrito.vaciar') }}" onsubmit="return confirm('¿Vaciar todo el carrito?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-cancel btn-reset">VACIAR CARRITO</button>
            </form>
            <form method="POST" action="{{ route('carrito.confirmar') }}">
                @csrf
                <button type="submit" class="btn-red btn-auto">CONFIRMAR PEDIDO</button>
            </form>
        </div>
    @endif
</section>
@endsection