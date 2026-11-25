<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductoController extends Controller
{
    private function reglas(): array
    {
        return [
            'nombre' => ['required', 'string', 'min:2', 'max:60', 'regex:/^[\pL\s]+$/u'],
            'precio' => ['required', 'numeric', 'min:1', 'max:9999'],
            'categoria' => ['required', 'in:Bebidas,Postres,Especiales'],
            'descripcion' => ['nullable', 'string', 'max:255'],
            'imagen' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }

    private function mensajes(): array
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.min' => 'El nombre debe tener al menos 2 letras.',
            'nombre.regex' => 'El nombre solo puede tener letras y espacios, sin números.',
            'precio.required' => 'El precio es obligatorio.',
            'precio.numeric' => 'El precio debe ser un número.',
            'precio.min' => 'El precio mínimo es $1.',
            'precio.max' => 'El precio máximo es $9,999.',
            'categoria.required' => 'Elige una categoría.',
            'categoria.in' => 'La categoría no es válida.',
            'descripcion.max' => 'La descripción puede tener máximo 255 caracteres.',
            'imagen.image' => 'El archivo debe ser una imagen.',
            'imagen.mimes' => 'La imagen debe ser JPG, PNG o WEBP.',
            'imagen.max' => 'La imagen pesa demasiado, el máximo es 2 MB.',
            'imagen.uploaded' => 'No se pudo subir la imagen. Revisa que pese menos de 2 MB.',
        ];
    }

    private function guardarImagen(Request $request): ?string
    {
        if (!$request->hasFile('imagen')) {
            return null;
        }

        $archivo = $request->file('imagen');
        $nombre = uniqid('prod_') . '.' . $archivo->extension();
        $archivo->move(public_path('img/productos'), $nombre);

        return 'img/productos/' . $nombre;
    }

    private function borrarImagen(?string $ruta): void
    {
        if ($ruta && file_exists(public_path($ruta))) {
            @unlink(public_path($ruta));
        }
    }

    public function index(): View
    {
        // Solo mostramos en la página los productos activos (1)
        $productos = Producto::where('activo', 1)->latest()->get();

        return view('admin.productos.index', compact('productos'));
    }

    public function store(Request $request): RedirectResponse
    {
        $datos = $request->validate($this->reglas(), $this->mensajes());

        unset($datos['imagen']);
        $datos['imagen'] = $this->guardarImagen($request);
        $datos['activo'] = 1; // Se crea activo por defecto en la BD

        Producto::create($datos);

        return redirect()->route('admin.productos.index')
            ->with('ok', 'Producto agregado al menú.');
    }

    public function edit(Producto $producto): View
    {
        return view('admin.productos.edit', compact('producto'));
    }

    public function update(Request $request, Producto $producto): RedirectResponse
    {
        $datos = $request->validate($this->reglas(), $this->mensajes());

        unset($datos['imagen']);

        if ($request->hasFile('imagen')) {
            $this->borrarImagen($producto->imagen);
            $datos['imagen'] = $this->guardarImagen($request);
        }

        $producto->update($datos);

        return redirect()->route('admin.productos.index')
            ->with('ok', 'Producto actualizado.');
    }

    public function destroy(Producto $producto): RedirectResponse
    {
        // Borrado lógico: desaparece de la página pero se queda en la BD marcado con 0
        $producto->update(['activo' => 0]);

        return redirect()->route('admin.productos.index')
            ->with('ok', 'Producto eliminado.');
    }
}
