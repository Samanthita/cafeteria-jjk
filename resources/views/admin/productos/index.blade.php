@extends('layouts.jjk')
@section('titulo', 'Panel de control')

@section('contenido')
<section class="panel">
    <h3 class="panel-title">PANEL DE CONTROL - NUEVO PRODUCTO</h3>

    @if ($errors->any())
        <div class="alert">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('admin.productos.store') }}" class="prod-form" enctype="multipart/form-data">
        @csrf
        <input type="text" name="nombre" value="{{ old('nombre') }}" placeholder="Nombre (solo letras)" required maxlength="60" oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñÜü\s]/g, '')">
        <input type="number" name="precio" value="{{ old('precio') }}" placeholder="Precio ($ MXN)" required min="1" max="9999" step="0.01">
        <select name="categoria" required>
            <option value="">Categoría</option>
            @foreach (['Bebidas', 'Postres', 'Especiales'] as $cat)
                <option value="{{ $cat }}" @selected(old('categoria') === $cat)>{{ $cat }}</option>
            @endforeach
        </select>
        <input type="text" name="descripcion" value="{{ old('descripcion') }}" placeholder="Descripción breve" maxlength="255">

        <label class="file-label">
            <span>Imagen del producto (JPG, PNG o WEBP, máx. 2 MB)</span>
            <input type="file" name="imagen" accept=".jpg,.jpeg,.png,.webp">
        </label>

        <button type="submit" class="btn-red btn-auto">+ GUARDAR EN EL MENÚ</button>
    </form>
</section>

<section class="panel">
    <h3 class="panel-title">PRODUCTOS DEL MENÚ ({{ $productos->count() }})</h3>

    <div class="table-wrap">
        <table class="tabla">
            <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th>Precio</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($productos as $p)
                    <tr>
                        <td>
                            @if ($p->imagen)
                                <img class="thumb" src="{{ asset($p->imagen) }}" alt="{{ $p->nombre }}">
                            @else
                                <div class="thumb thumb-vacio">呪</div>
                            @endif
                        </td>
                        <td>{{ $p->nombre }}</td>
                        <td>{{ $p->categoria }}</td>
                        <td>${{ number_format($p->precio, 2) }} MXN</td>
                        <td>{{ $p->descripcion ?? '—' }}</td>
                        <td class="acciones">
                            <a href="{{ route('admin.productos.edit', $p) }}" class="btn-edit">EDITAR</a>
                            <form method="POST" action="{{ route('admin.productos.destroy', $p) }}" onsubmit="return confirm('¿Seguro que quieres eliminar este producto?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-del">ELIMINAR</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="vacio">Aún no hay productos. Agrega el primero arriba.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>
@endsection
