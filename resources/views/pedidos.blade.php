@extends('layouts.jjk')
@section('titulo', 'Mis pedidos')

@section('contenido')
<section class="panel">
    <h3 class="panel-title">MIS PEDIDOS</h3>

    @forelse ($pedidos as $pedido)
        <div class="pedido">
            <div class="pedido-head">
                <strong>Pedido #{{ $pedido->id }}</strong>
                <span>{{ $pedido->created_at->format('d/m/Y h:i a') }}</span>
                <span class="estado-tag estado-{{ $pedido->estado }}">{{ strtoupper($pedido->estado) }}</span>                
                <strong>${{ number_format($pedido->total, 2) }} MXN</strong>
            </div>
            <ul class="pedido-items">
                @foreach ($pedido->detalles as $d)
                    <li>{{ $d->cantidad }} × {{ $d->nombre }} — ${{ number_format($d->precio * $d->cantidad, 2) }}</li>
                @endforeach
            </ul>
        </div>
    @empty
        <p class="vacio">Aún no has hecho pedidos. <a href="{{ route('cafeteria') }}">Ver el menú</a></p>
    @endforelse
</section>
@endsection