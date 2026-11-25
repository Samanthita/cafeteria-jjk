@extends('layouts.jjk')
@section('titulo', 'Editar producto')

@section('contenido')
<section class="panel">
    <h3 class="panel-title">EDITAR PRODUCTO</h3>

    @if ($errors->any())
        <div class="alert">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('admin.productos.update', $producto) }}" class="prod-form" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="text" name="nombre" value="{{ old('nombre', $producto->nombre) }}" placeholder="Nombre (solo letras)" required maxlength="60" oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñÜü\s]/g, '')">
        <input type="number" name="precio" value="{{ old('precio', $producto->precio) }}" placeholder="Precio ($ MXN)" required min="1" max="9999" step="0.01">
        <select name="categoria" required>
            @foreach (['Bebidas', 'Postres', 'Especiales'] as $cat)
                <option value="{{ $cat }}" @selected(old('categoria', $producto->categoria) === $cat)>{{ $cat }}</option>
            @endforeach
        </select>
        <input type="text" name="descripcion" value="{{ old('descripcion', $producto->descripcion) }}" placeholder="Descripción breve" maxlength="255">

        <div class="actual-img">
            @if ($producto->imagen)
                <img class="thumb" src="{{ asset($producto->imagen) }}" alt="{{ $producto->nombre }}">
                <span>Imagen actual</span>
            @else
                <div class="thumb thumb-vacio">呪</div>
                <span>Sin imagen</span>
            @endif
        </div>

        <label class="file-label">
            <span>Cambiar imagen (opcional, JPG, PNG o WEBP, máx. 2 MB)</span>
            <input type="file" name="imagen" accept=".jpg,.jpeg,.png,.webp">
        </label>

        <button type="submit" class="btn-red btn-auto">GUARDAR CAMBIOS</button>
        <a href="{{ route('admin.productos.index') }}" class="btn-cancel">CANCELAR</a>
    </form>
</section>
@endsection
