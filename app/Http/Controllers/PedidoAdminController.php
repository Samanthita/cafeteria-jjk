<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PedidoAdminController extends Controller
{
    private const ESTADOS = ['pendiente', 'preparando', 'entregado', 'cancelado'];

    public function index(): View
    {
        $pedidos = Pedido::with(['user', 'detalles'])->latest()->get();
        $estados = self::ESTADOS;

        return view('admin.pedidos.index', compact('pedidos', 'estados'));
    }

    public function actualizar(Request $request, Pedido $pedido): RedirectResponse
    {
        $request->validate([
            'estado' => ['required', Rule::in(self::ESTADOS)],
        ], [
            'estado.required' => 'Elige un estado.',
            'estado.in' => 'Ese estado no es válido.',
        ]);

        $pedido->update(['estado' => $request->estado]);

        return back()->with('ok', 'Pedido #' . $pedido->id . ' actualizado a ' . $request->estado . '.');
    }
}