@extends('layouts.jjk')
@section('titulo', 'Pedidos')

@section('contenido')
<section class="panel">
    <h3 class="panel-title">PEDIDOS RECIBIDOS ({{ $pedidos->count() }})</h3>

    @if ($errors->any())
        <div class="alert">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <div class="resumen">
        @foreach ($estados as $e)
            <div class="resumen-item estado-{{ $e }}">
                <strong>{{ $pedidos->where('estado', $e)->count() }}</strong>
                <span>{{ strtoupper($e) }}</span>
            </div>
        @endforeach
    </div>

    @forelse ($pedidos as $pedido)
        <div class="pedido">
            <div class="pedido-head">
                <strong>Pedido #{{ $pedido->id }}</strong>
                <span>{{ $pedido->user->name }} · {{ $pedido->user->email }}</span>
                <span>{{ $pedido->created_at->format('d/m/Y h:i a') }}</span>
                <strong>${{ number_format($pedido->total, 2) }} MXN</strong>
            </div>

            <ul class="pedido-items">
                @foreach ($pedido->detalles as $d)
                    <li>{{ $d->cantidad }} × {{ $d->nombre }} — ${{ number_format($d->precio * $d->cantidad, 2) }}</li>
                @endforeach
            </ul>

            <form method="POST" action="{{ route('admin.pedidos.actualizar', $pedido) }}" class="estado-form">
                @csrf
                @method('PATCH')
                <span class="estado-tag estado-{{ $pedido->estado }}">{{ strtoupper($pedido->estado) }}</span>
                <select name="estado" required>
                    @foreach ($estados as $e)
                        <option value="{{ $e }}" @selected($pedido->estado === $e)>{{ ucfirst($e) }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn-edit">CAMBIAR ESTADO</button>
            </form>
        </div>
    @empty
        <p class="vacio">Todavía no hay pedidos.</p>
    @endforelse
</section>
@endsection