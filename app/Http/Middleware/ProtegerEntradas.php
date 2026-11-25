<?php

namespace App\Http\Middleware;

use App\Support\Seguridad;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class ProtegerEntradas
{
    // Estos campos no se revisan: las contraseñas pueden llevar cualquier símbolo
    // y se guardan con hash, nunca viajan dentro de una consulta SQL.
    private const EXCLUIDOS = ['password', 'password_confirmation', 'current_password', '_token', '_method'];

    public function handle(Request $request, Closure $next): Response
    {
        // Solo revisamos las peticiones que envían datos
        if (in_array($request->method(), ['POST', 'PUT', 'PATCH', 'DELETE'])) {
            $campo = Seguridad::buscarInyeccion($request->except(self::EXCLUIDOS));

            if ($campo !== null) {
                // Dejamos evidencia en storage/logs/laravel.log
                Log::warning('Intento de SQLi bloqueado', [
                    'ip' => $request->ip(),
                    'ruta' => $request->path(),
                    'campo' => $campo,
                    'usuario' => optional($request->user())->email,
                ]);

                return redirect()->back()->withErrors([
                    'seguridad' => 'Entrada no permitida: se detectó un posible intento de inyección SQL en el campo "' . $campo . '".',
                ]);
            }
        }

        return $next($request);
    }
}