<?php

namespace App\Support;

class Seguridad
{
    // Patrones típicos de inyección SQL
    private const PATRONES = [
        '/[\'"]\s*(or|and)\s+[\'"\w]+\s*(=|like)\s*[\'"\w]+/i', // ' OR '1'='1
        '/\bor\s+\d+\s*=\s*\d+/i',                               // OR 1=1
        '/\bunion\s+(all\s+)?select\b/i',                        // UNION SELECT
        '/;\s*(select|insert|update|delete|drop|truncate|alter)\b/i', // ; DROP TABLE
        '/\b(drop|truncate)\s+(table|database)\b/i',             // DROP TABLE
        '/[\'";]\s*--/',                                         // '-- (comentario SQL)
        '/\/\*.*?\*\//s',                                        // /* comentario */
        '/\b(sleep|benchmark)\s*\(/i',                           // ataques por tiempo
    ];

    // Revisa un texto. Devuelve true si parece una inyección SQL.
    public static function esInyeccion(string $texto): bool
    {
        foreach (self::PATRONES as $patron) {
            if (preg_match($patron, $texto) === 1) {
                return true;
            }
        }

        return false;
    }

    // Revisa todos los campos de un formulario.
    // Devuelve el nombre del primer campo sospechoso, o null si todo está limpio.
    public static function buscarInyeccion(array $datos, string $prefijo = ''): ?string
    {
        foreach ($datos as $nombre => $valor) {
            $campo = $prefijo . $nombre;

            if (is_array($valor)) {
                $hallado = self::buscarInyeccion($valor, $campo . '.');

                if ($hallado !== null) {
                    return $hallado;
                }
            } elseif (is_string($valor) && self::esInyeccion($valor)) {
                return $campo;
            }
        }

        return null;
    }
}