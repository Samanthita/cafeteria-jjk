<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Producto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CarritoController extends Controller
{
    private function cantidadValida(Request $request): int
    {
        $request->validate([
            'cantidad' => ['nullable', 'integer', 'min:1', 'max:10'],
        ], [
            'cantidad.integer' => 'La cantidad debe ser un número entero.',
            'cantidad.min' => 'La cantidad mínima es 1.',
            'cantidad.max' => 'Puedes pedir máximo 10 piezas por producto.',
        ]);

        return (int) $request->input('cantidad', 1);
    }

    // Arma el carrito con los precios de la BASE DE DATOS
    private function armarCarrito(): array
    {
        $carrito = session('carrito', []);
        $productos = Producto::whereIn('id', array_keys($carrito))->get();

        $items = [];
        $total = 0;

        foreach ($productos as $p) {
            $cantidad = $carrito[$p->id];
            $subtotal = $p->precio * $cantidad;
            $total += $subtotal;

            $items[] = [
                'producto' => $p,
                'cantidad' => $cantidad,
                'subtotal' => $subtotal,
            ];
        }

        return [$items, $total];
    }

    public function index(): View
    {
        [$items, $total] = $this->armarCarrito();

        return view('carrito', compact('items', 'total'));
    }

    public function agregar(Request $request, Producto $producto): RedirectResponse
    {
        if (!$producto->activo) {
            return back()->with('error', 'Este producto no está disponible.');
        }

        $cantidad = $this->cantidadValida($request);

        $carrito = session('carrito', []);
        $nueva = ($carrito[$producto->id] ?? 0) + $cantidad;
        $carrito[$producto->id] = min($nueva, 10);

        session(['carrito' => $carrito]);

        return back()->with('ok', $producto->nombre . ' se agregó al carrito.');
    }

    public function actualizar(Request $request, Producto $producto): RedirectResponse
    {
        $cantidad = $this->cantidadValida($request);

        $carrito = session('carrito', []);

        if (isset($carrito[$producto->id])) {
            $carrito[$producto->id] = $cantidad;
            session(['carrito' => $carrito]);
        }

        return redirect()->route('carrito.index')->with('ok', 'Cantidad actualizada.');
    }

    public function quitar(Producto $producto): RedirectResponse
    {
        $carrito = session('carrito', []);
        unset($carrito[$producto->id]);
        session(['carrito' => $carrito]);

        return redirect()->route('carrito.index')->with('ok', 'Producto quitado del carrito.');
    }

    public function vaciar(): RedirectResponse
    {
        session()->forget('carrito');

        return redirect()->route('carrito.index')->with('ok', 'Carrito vaciado.');
    }

    public function confirmar(): RedirectResponse
    {
        [$items, $total] = $this->armarCarrito();

        if (count($items) === 0) {
            return redirect()->route('cafeteria')->with('error', 'Tu carrito está vacío.');
        }

        // Si algo falla a la mitad, no se guarda nada
        DB::transaction(function () use ($items, $total) {
            $pedido = Pedido::create([
                'user_id' => auth()->id(),
                'total' => $total,
                'estado' => 'pendiente',
            ]);

            foreach ($items as $item) {
                $pedido->detalles()->create([
                    'producto_id' => $item['producto']->id,
                    'nombre' => $item['producto']->nombre,
                    'precio' => $item['producto']->precio,
                    'cantidad' => $item['cantidad'],
                ]);
            }
        });

        session()->forget('carrito');

        return redirect()->route('pedidos')->with('ok', 'Pedido confirmado. ¡Gracias por tu compra!');
    }

    public function pedidos(): View
    {
        // Solo los pedidos de la persona que tiene la sesión abierta
        $pedidos = Pedido::with('detalles')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('pedidos', compact('pedidos'));
    }
}